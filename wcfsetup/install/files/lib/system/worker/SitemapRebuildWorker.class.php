<?php
namespace wcf\system\worker;
use wcf\data\object\type\ObjectTypeCache;
use wcf\data\DatabaseObjectList;
use wcf\data\ILinkableObject;
use wcf\system\exception\ImplementationException;
use wcf\system\io\File;
use wcf\system\Regex;
use wcf\system\request\LinkHandler;
use wcf\system\WCF;
use wcf\util\FileUtil;

/**
 * Worker implementation for rebuilding all sitemaps.
 *
 * @author	Joshua Ruesweg
 * @copyright	2001-2017 WoltLab GmbH
 * @license	GNU Lesser General Public License <http://opensource.org/licenses/lgpl-license.php>
 * @package	WoltLabSuite\Core\System\Worker
 * @since	3.1
 */
class SitemapRebuildWorker extends AbstractWorker {
	/**
	 * The limit of objects in one sitemap file.
	 */
	const SITEMAP_OBJECT_LIMIT = 50000;
	
	/**
	 * @inheritDoc
	 */
	public $limit = 250;
	
	/**
	 * All object types for the site maps.
	 * @var array<ObjectType>
	 */
	public $sitemapObjects = null;
	
	/**
	 * The current worker data.
	 * @var array<mixed>
	 */
	public $workerData = [];
	
	/**
	 * The current temporary file as File object.
	 * @var File
	 */
	public $file = null;
	
	/**
	 * @inheritDoc
	 */
	protected function countObjects() {
		if ($this->count === null) {
			// reset count
			$this->count = 0;
			
			// read sitemaps
			$sitemapObjects = ObjectTypeCache::getInstance()->getObjectTypes('com.woltlab.wcf.sitemap.object');
			foreach ($sitemapObjects as $sitemapObject) {
				if ($sitemapObject->enabled === null || $sitemapObject->enabled) {
					$this->sitemapObjects[] = $sitemapObject;
					
					$processor = $sitemapObject->getProcessor();
					
					$list = $processor->getObjectList();
					
					if (!($list instanceof DatabaseObjectList)) {
						throw new \InvalidArgumentException("Class '" . get_class($list) . "' is not an instance of " . DatabaseObjectList::class);
					}
					
					if (SITEMAP_INDEX_TIME_FRAME > 0 && $processor->getLastModifiedColumn() !== null) {
						$list->getConditionBuilder()->add($processor->getLastModifiedColumn() . " > ?", [
							TIME_NOW - SITEMAP_INDEX_TIME_FRAME * 86400 // one day (60 * 60 * 24)
						]);
					}
					
					// modify count, because we handle only one sitemap object per call
					$this->count += max(1, ceil($list->countObjects() / $this->limit)) * $this->limit;
				}
			}
		}
	}
	
	/**
	 * @inheritDoc
	 */
	public function execute() {
		$this->getWorkerData();
		
		if (!isset($this->sitemapObjects[$this->workerData['sitemap']])) {
			$this->workerData['finished'] = true;
			$this->storeWorkerData();
		}
		
		// check whether we should rebuild it
		if (!isset($this->parameters['forceRebuild']) || !$this->parameters['forceRebuild'] && !$this->workerData['finished']) {
			$this->checkCache();
		}
		
		if ($this->workerData['finished']) {
			return;
		}
		
		$this->openFile();
		
		$sitemapObject = $this->sitemapObjects[$this->workerData['sitemap']]->getProcessor();
		$sitemapLoopCount = $this->workerData['sitemapLoopCount'];
		
		$objectList = $sitemapObject->getObjectList();
		
		if (SITEMAP_INDEX_TIME_FRAME > 0 && $sitemapObject->getLastModifiedColumn() !== null) {
			$objectList->getConditionBuilder()->add($sitemapObject->getLastModifiedColumn() . " > ?", [
				TIME_NOW - SITEMAP_INDEX_TIME_FRAME * 86400 // one day (60 * 60 * 24)
			]);
		}
		
		$objectList->sqlLimit = $this->limit;
		$objectList->sqlOffset = $this->limit * $sitemapLoopCount;
		$objectList->readObjects();
		
		foreach ($objectList->getObjects() as $object) {
			if (!($object instanceof ILinkableObject)) {
				throw new ImplementationException(get_class($object), ILinkableObject::class);
			}
			
			$link = $object->getLink();
			$lastModifiedTime = ($sitemapObject->getLastModifiedColumn() === null) ? null : date('c', $object->{$sitemapObject->getLastModifiedColumn()});
			
			if ($sitemapObject->canView($object)) {
				$this->file->write(WCF::getTPL()->fetch('sitemapEntry', 'wcf', [
					// strip session links
					'link' => Regex::compile('(?<=\?|&)([st]=[a-f0-9]{40}|at=\d+-[a-f0-9]{40})')->replace($link, ''),
					'lastModifiedTime' => $lastModifiedTime,
					'priority' => $this->sitemapObjects[$this->workerData['sitemap']]->priority,
					'changeFreq' => $this->sitemapObjects[$this->workerData['sitemap']]->changeFreq
				]));
				
				$this->workerData['dataCount']++;
			}
		}
		
		if ($this->workerData['dataCount'] + $this->limit > self::SITEMAP_OBJECT_LIMIT) {
			$this->finishSitemap($this->sitemapObjects[$this->workerData['sitemap']]->objectType . '_' . $this->workerData['sitemapLoopCount'] . '.xml');
			
			$this->generateTmpFile();
			
			$this->workerData['dataCount'] = 0;
		}
		
		// finish sitemap
		if (count($objectList) < $this->limit) {
			if ($this->workerData['dataCount'] > 0) {
				$this->finishSitemap($this->sitemapObjects[$this->workerData['sitemap']]->objectType . '.xml');
			}
			
			// increment data
			$this->workerData['dataCount'] = 0;
			$this->workerData['sitemapLoopCount'] = -1;
			$this->workerData['sitemap']++;
			
			if (count($this->sitemapObjects) <= $this->workerData['sitemap']) {
				$this->writeIndexFile();
			} else {
				$this->generateTmpFile();
			}
		}
		
		$this->workerData['sitemapLoopCount']++;
		$this->storeWorkerData();
		$this->closeFile();
	}
	
	/**
	 * Checks if the sitemap have to be rebuilded. If not, this method marks the sitemap as builded.
	 */
	protected function checkCache() {
		$object = (isset($this->sitemapObjects[$this->workerData['sitemap']])) ? $this->sitemapObjects[$this->workerData['sitemap']] : false;
		while ($object && file_exists(self::getSitemapPath() . $object->objectType . '.xml') && filectime(self::getSitemapPath() . $object->objectType . '.xml') > TIME_NOW - (($object->rebuildTime !== null) ? $object->rebuildTime : 60 * 60 * 24 * 7)) {
			$files = @glob(self::getSitemapPath() . $object->objectType . '*');
			if (is_array($files)) {
				foreach ($files as $filename) {
					$this->workerData['sitemaps'][] = self::getSitemapURL() . basename($filename);
				}
			}
			
			$this->workerData['sitemap']++;
			
			if (!isset($this->sitemapObjects[$this->workerData['sitemap']])) {
				$this->writeIndexFile();
				
				// if we musn't refresh any data, we set loopCount to one
				// so that we no init a new $workerData session
				if ($this->loopCount == 0) {
					$this->loopCount = 1;
				}
				$this->storeWorkerData();
			} else {
				$object = $this->sitemapObjects[$this->workerData['sitemap']];
			}
		}
	}
	
	/**
	 * Writes the sitemap.xml index file and links all sitemaps.
	 */
	protected function writeIndexFile() {
		if (file_exists(self::getSitemapPath() . 'sitemap.xml')) {
			unlink(self::getSitemapPath() . 'sitemap.xml');
		}
		
		touch(self::getSitemapPath() . 'sitemap.xml');
		
		FileUtil::makeWritable(self::getSitemapPath() . 'sitemap.xml');
		
		$sitemapIndex = new File(self::getSitemapPath() . 'sitemap.xml', 'w');
		$sitemapIndex->write(WCF::getTPL()->fetch('sitemapIndex', 'wcf', [
			'sitemaps' => $this->workerData['sitemaps']
		]));
		$sitemapIndex->close();
		
		$this->workerData['finished'] = true;
	}
	
	/**
	 * Generates a new temporary file and appends the sitemap start.
	 */
	protected function generateTmpFile() {
		$this->closeFile();
		
		$this->workerData['tmpFile'] = FileUtil::getTemporaryFilename('sitemap_' . $this->workerData['sitemap'] . '_');
		
		$this->openFile();
		
		$this->file->write(WCF::getTPL()->fetch('sitemapStart'));
	}
	
	/**
	 * Open the current temporary file.
	 */
	protected function openFile() {
		if (!file_exists($this->workerData['tmpFile'])) {
			touch($this->workerData['tmpFile']);
		}
		
		$this->file = new File($this->workerData['tmpFile'], 'a');
	}
	
	/**
	 * Closes the current temporary file, iff a File is opened. 
	 */
	protected function closeFile() {
		if ($this->file instanceof File) {
			$this->file->close();
		}
	}
	
	/**
	 * Writes the current temporary file in a finished sitemap file. The param
	 * $filename defines the sitemap filename.
	 *
	 * @param	string $filename
	 */
	protected function finishSitemap($filename) {
		$this->file->write(WCF::getTPL()->fetch('sitemapEnd'));
		
		if (file_exists(self::getSitemapPath() . $filename)) {
			unlink(self::getSitemapPath() . $filename);
		}
		
		rename($this->workerData['tmpFile'], self::getSitemapPath() . $filename);
		
		// try to unlink the tmp file 
		@unlink($this->workerData['tmpFile']);
		
		// add sitemap to the successfully builded sitemaps
		$this->workerData['sitemaps'][] = self::getSitemapURL() . $filename;
	}
	
	/**
	 * Stores the current worker data in a session.
	 */
	protected function storeWorkerData() {
		WCF::getSession()->register('sitemapRebuildWorkerData', $this->workerData);
	}
	
	/**
	 * Fetches the current worker data and set the default values, if isn't any data stored.
	 */
	protected function getWorkerData() {
		$this->workerData = WCF::getSession()->getVar('sitemapRebuildWorkerData');
		
		if ($this->loopCount == 0) {
			$this->workerData = [
				'sitemap' => 0,
				'sitemapLoopCount' => 0,
				'dataCount' => 0,
				'tmpFile' => '',
				'sitemaps' => [],
				'finished' => false
			];
			
			$this->generateTmpFile();
		}
	}
	
	/**
	 * @inheritDoc
	 */
	public function validate() {
		WCF::getSession()->checkPermissions(['admin.management.canRebuildData']);
	}
	
	/**
	 * @inheritDoc
	 */
	public function getProceedURL() {
		return LinkHandler::getInstance()->getLink('SitemapList', [
			'isACP' => true
		]);
	}
	
	/**
	 * Returns the relative sitemap folder path.
	 *
	 * @return 	string
	 */
	public static function getSitemapPath() {
		return WCF_DIR . 'sitemaps/';
	}
	
	/**
	 * Returns the full sitemap folder path.
	 * 
	 * @return 	string
	 */
	public static function getSitemapURL() {
		return WCF::getPath() . 'sitemaps/';
	}
}