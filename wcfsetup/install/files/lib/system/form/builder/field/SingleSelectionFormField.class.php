<?php
namespace wcf\system\form\builder\field;
use wcf\system\form\builder\field\validation\FormFieldValidationError;

/**
 * Implementation of a form field for selecting a single value.
 * 
 * @author	Matthias Schmidt
 * @copyright	2001-2019 WoltLab GmbH
 * @license	GNU Lesser General Public License <http://opensource.org/licenses/lgpl-license.php>
 * @package	WoltLabSuite\Core\System\Form\Builder\Field
 * @since	5.2
 */
class SingleSelectionFormField extends AbstractFormField implements IImmutableFormField, IFilterableSelectionFormField, INullableFormField {
	use TImmutableFormField;
	use TFilterableSelectionFormField;
	use TNullableFormField;
	
	/**
	 * @inheritDoc
	 */
	protected $templateName = '__singleSelectionFormField';
	
	/**
	 * @inheritDoc
	 */
	public function getSaveValue() {
		if (empty($this->getValue()) && isset($this->getOptions()[$this->getValue()]) && $this instanceof INullableFormField && $this->isNullable()) {
			return null;
		}
		
		return parent::getSaveValue();
	}
	
	/**
	 * @inheritDoc
	 */
	public function readValue() {
		if ($this->getDocument()->hasRequestData($this->getPrefixedId())) {
			$value = $this->getDocument()->getRequestData($this->getPrefixedId());
			
			if (is_string($value)) {
				$this->__value = $value;
			}
		}
		
		return $this;
	}
	
	/**
	 * @inheritDoc
	 */
	public function validate() {
		if (!isset($this->getOptions()[$this->getValue()])) {
			$this->addValidationError(new FormFieldValidationError(
				'invalidValue',
				'wcf.global.form.error.noValidSelection'
			));
		}
		
		parent::validate();
	}
	
	/**
	 * @inheritDoc
	 */
	public function value($value) {
		// ignore `null` as value which can be passed either for nullable
		// fields or as value if no options are available
		if ($value === null) {
			return $this;
		}
		
		if (!isset($this->getOptions()[$value])) {
			throw new \InvalidArgumentException("Unknown value '{$value}'");
		}
		
		return parent::value($value);
	}
}