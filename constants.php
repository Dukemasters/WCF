<?php
/**
 * Defines constants for autocompletion in IDEs. This file is not meant to be actively used anywhere! 
 * 
 * @author	Matthias Schmidt
 * @copyright	2001-2017 WoltLab GmbH
 * @license	GNU Lesser General Public License <http://opensource.org/licenses/lgpl-license.php>
 * @package	WoltLabSuite\Core
 */

// automatically defined constants/constants defined with classes
define('MASTER_PASSWORD', '');
define('PACKAGE_ID', 1);
define('PACKAGE_NAME', '');
define('RELATIVE_WCF_DIR', '');
define('TMP_DIR', '');
define('WCF_N', 1);
define('WCF_OPTION_INC_PHP_SUCCESS', true);
define('SID_ARG_1ST', '');
define('SID_ARG_2ND', '');
define('SID_ARG_2ND_NOT_ENCODED', '');
define('SID', '');
define('SID_INPUT_TAG', '');
define('SECURITY_TOKEN', '');
define('SECURITY_TOKEN_INPUT_TAG', '');

// option constants
define('LAST_UPDATE_TIME', 0);
define('WCF_UUID', 'bd096261-15f4-5dc1-9767-01ce08d7c80b');
define('WOLTLAB_BRANDING', 1);
define('MODULE_MASTER_PASSWORD', 0);
define('VISITOR_USE_TINY_BUILD', 0);
define('ENABLE_DEBUG_MODE', 1);
define('ENABLE_BENCHMARK', 0);
define('LOG_IP_ADDRESS', 1);
define('ENABLE_WOLTLAB_NEWS', 1);
define('MODULE_SYSTEM_RECAPTCHA', 1);
define('MODULE_COOKIE_POLICY_PAGE', 1);
define('MODULE_ATTACHMENT', 1);
define('MODULE_SMILEY', 1);
define('MODULE_GRAVATAR', 1);
define('MODULE_USERS_ONLINE', 1);
define('MODULE_USER_RANK', 1);
define('MODULE_USER_SIGNATURE', 1);
define('MODULE_MEMBERS_LIST', 1);
define('MODULE_TEAM_PAGE', 1);
define('MODULE_LIKE', 1);
define('MODULE_USER_PROFILE_WALL', 1);
define('MODULE_TAGGING', 1);
define('MODULE_POLL', 1);
define('MODULE_WCF_AD', 0);
define('PAGE_TITLE', 'WoltLab Suite');
define('PAGE_DESCRIPTION', '');
define('META_KEYWORDS', '');
define('META_DESCRIPTION', '');
define('SHOW_VERSION_NUMBER', 1);
define('EXTERNAL_LINK_REL_NOFOLLOW', 1);
define('EXTERNAL_LINK_TARGET_BLANK', 0);
define('FOOTER_CODE', '');
define('URL_LEGACY_MODE', 0);
define('URL_OMIT_INDEX_PHP', 0);
define('URL_TITLE_COMPONENT_REPLACEMENT', '');
define('OFFLINE', 0);
define('OFFLINE_MESSAGE', '');
define('OFFLINE_MESSAGE_ALLOW_HTML', 0);
define('IMAGE_ADAPTER_TYPE', 'gd');
define('SEARCH_ENGINE', 'mysql');
define('EXCEPTION_PRIVACY', 'public');
define('COOKIE_PREFIX', 'wcf21_');
define('HTTP_SEND_X_FRAME_OPTIONS', 1);
define('HTTP_ENABLE_GZIP', 1);
define('PACKAGE_SERVER_AUTH_CODE', '');
define('PROXY_SERVER_HTTP', '');
define('SESSION_TIMEOUT', 1800);
define('USER_ONLINE_TIMEOUT', 900);
define('SESSION_VALIDATE_IP_ADDRESS', 0);
define('SESSION_VALIDATE_USER_AGENT', 1);
define('SESSION_ENABLE_VIRTUALIZATION', 1);
define('ENABLE_USER_AUTHENTICATION_FAILURE', 1);
define('USER_AUTHENTICATION_FAILURE_TIMEOUT', 7200);
define('USER_AUTHENTICATION_FAILURE_IP_CAPTCHA', 3);
define('USER_AUTHENTICATION_FAILURE_IP_BLOCK', 10);
define('USER_AUTHENTICATION_FAILURE_USER_CAPTCHA', 3);
define('USER_AUTHENTICATION_FAILURE_EXPIRATION', 30);
define('SIGNATURE_SECRET', '');
define('BLACKLIST_IP_ADDRESSES', '');
define('BLACKLIST_USER_AGENTS', '');
define('BLACKLIST_HOSTNAMES', '');
define('CAPTCHA_TYPE', 'com.woltlab.wcf.recaptcha');
define('REGISTER_USE_CAPTCHA', 1);
define('LOST_PASSWORD_USE_CAPTCHA', 1);
define('PROFILE_MAIL_USE_CAPTCHA', 1);
define('SEARCH_USE_CAPTCHA', 1);
define('RECAPTCHA_PUBLICKEY', '');
define('RECAPTCHA_PRIVATEKEY', '');
define('TIMEZONE', 'Europe/London');
define('GOOGLE_MAPS_ZOOM', '13');
define('GOOGLE_MAPS_TYPE', 'hybrid');
define('GOOGLE_MAPS_ENABLE_SCALE_CONTROL', 0);
define('GOOGLE_MAPS_ENABLE_DRAGGING', 1);
define('GOOGLE_MAPS_ENABLE_SCROLL_WHEEL_ZOOM', 0);
define('GOOGLE_MAPS_ENABLE_DOUBLE_CLICK_ZOOM', 1);
define('GOOGLE_MAPS_DEFAULT_LATITUDE', '52.517');
define('GOOGLE_MAPS_DEFAULT_LONGITUDE', '13.4');
define('GOOGLE_MAPS_ACCESS_USER_LOCATION', 1);
define('MAIL_FROM_NAME', '');
define('MAIL_FROM_ADDRESS', '');
define('MAIL_ADMIN_ADDRESS', '');
define('MAIL_SIGNATURE', '');
define('MAIL_SEND_METHOD', 'php');
define('MAIL_SMTP_HOST', '');
define('MAIL_SMTP_PORT', 25);
define('MAIL_SMTP_STARTTLS', 'may');
define('MAIL_SMTP_USER', '');
define('MAIL_SMTP_PASSWORD', '');
define('MAIL_USE_F_PARAM', 1);
define('CACHE_SOURCE_TYPE', 'disk');
define('CACHE_SOURCE_MEMCACHED_HOST', '');
define('CACHE_SOURCE_REDIS_HOST', '');
define('AVAILABLE_PAYMENT_METHODS', '');
define('PAYPAL_EMAIL_ADDRESS', '');
define('MODULE_PAID_SUBSCRIPTION', 0);
define('PAID_SUBSCRIPTION_ENABLE_TOS_CONFIRMATION', 0);
define('PAID_SUBSCRIPTION_TOS_URL', '');
define('ATTACHMENT_STORAGE', '');
define('ATTACHMENT_ENABLE_THUMBNAILS', 1);
define('ATTACHMENT_RETAIN_DIMENSIONS', 0);
define('ATTACHMENT_THUMBNAIL_HEIGHT', 210);
define('ATTACHMENT_THUMBNAIL_WIDTH', 280);
define('MODULE_EDIT_HISTORY', 1);
define('EDIT_HISTORY_EXPIRATION', 90);
define('ENABLE_SHARE_BUTTONS', 1);
define('SHARE_BUTTONS_PROVIDERS', '');
define('MODULE_IMAGE_PROXY', 0);
define('IMAGE_PROXY_EXPIRATION', 14);
define('ENABLE_CENSORSHIP', 0);
define('CENSORED_WORDS', '');
define('REGISTER_ENABLE_PASSWORD_SECURITY_CHECK', 0);
define('REGISTER_PASSWORD_MIN_LENGTH', 8);
define('REGISTER_PASSWORD_MUST_CONTAIN_LOWER_CASE', 1);
define('REGISTER_PASSWORD_MUST_CONTAIN_UPPER_CASE', 1);
define('REGISTER_PASSWORD_MUST_CONTAIN_DIGIT', 1);
define('REGISTER_PASSWORD_MUST_CONTAIN_SPECIAL_CHAR', 1);
define('REGISTER_FORBIDDEN_USERNAMES', '');
define('REGISTER_FORBIDDEN_EMAILS', '');
define('REGISTER_ALLOWED_EMAILS', '');
define('REGISTER_DISABLED', 0);
define('REGISTER_ENABLE_DISCLAIMER', 1);
define('REGISTER_ADMIN_NOTIFICATION', 0);
define('REGISTER_ACTIVATION_METHOD', '1');
define('REGISTER_USERNAME_MIN_LENGTH', 3);
define('REGISTER_USERNAME_MAX_LENGTH', 25);
define('REGISTER_USERNAME_FORCE_ASCII', 1);
define('REGISTER_MIN_USER_AGE', 0);
define('GITHUB_PUBLIC_KEY', '');
define('GITHUB_PRIVATE_KEY', '');
define('TWITTER_PUBLIC_KEY', '');
define('TWITTER_PRIVATE_KEY', '');
define('FACEBOOK_PUBLIC_KEY', '');
define('FACEBOOK_PRIVATE_KEY', '');
define('GOOGLE_PUBLIC_KEY', '');
define('GOOGLE_PRIVATE_KEY', '');
define('GRAVATAR_DEFAULT_TYPE', '404');
define('SIGNATURE_MAX_IMAGE_HEIGHT', 150);
define('USER_TITLE_MAX_LENGTH', 25);
define('USER_FORBIDDEN_TITLES', '');
define('PROFILE_SHOW_OLD_USERNAME', 182);
define('PROFILE_ENABLE_VISITORS', 1);
define('MEMBERS_LIST_USERS_PER_PAGE', 30);
define('MEMBERS_LIST_DEFAULT_SORT_FIELD', 'username');
define('MEMBERS_LIST_DEFAULT_SORT_ORDER', 'DESC');
define('USERS_ONLINE_SHOW_GUESTS', 1);
define('USERS_ONLINE_SHOW_ROBOTS', 1);
define('USERS_ONLINE_DEFAULT_SORT_FIELD', 'lastActivityTime');
define('USERS_ONLINE_DEFAULT_SORT_ORDER', 'DESC');
define('USERS_ONLINE_PAGE_REFRESH', 0);
define('USERS_ONLINE_RECORD_NO_GUESTS', 1);
define('USERS_ONLINE_ENABLE_LEGEND', 1);
define('USERS_ONLINE_RECORD', 1);
define('USERS_ONLINE_RECORD_TIME', 0);
define('USER_CLEANUP_NOTIFICATION_LIFETIME', 14);
define('USER_CLEANUP_ACTIVITY_EVENT_LIFETIME', 60);
define('USER_CLEANUP_PROFILE_VISITOR_LIFETIME', 60);
define('LIKE_ALLOW_FOR_OWN_CONTENT', 1);
define('LIKE_ENABLE_DISLIKE', 1);
define('LIKE_SHOW_SUMMARY', 1);
define('MESSAGE_SIDEBAR_ENABLE_ONLINE_STATUS', 1);
define('MESSAGE_SIDEBAR_ENABLE_LIKES_RECEIVED', 1);
define('MESSAGE_SIDEBAR_ENABLE_ACTIVITY_POINTS', 0);
define('MESSAGE_SIDEBAR_ENABLE_USER_ONLINE_MARKING', 1);
define('MESSAGE_SIDEBAR_USER_OPTIONS', '');
define('TAGGING_MAX_TAG_LENGTH', 30);
define('MESSAGE_MAX_QUOTE_DEPTH', 1);
define('SEARCH_RESULTS_PER_PAGE', 20);
define('SEARCH_DEFAULT_SORT_FIELD', 'time');
define('SEARCH_DEFAULT_SORT_ORDER', 'DESC');
define('POLL_MAX_OPTIONS', 20);
define('MEDIA_SMALL_THUMBNAIL_WIDTH', 280);
define('MEDIA_SMALL_THUMBNAIL_HEIGHT', 210);
define('MEDIA_SMALL_THUMBNAIL_RETAIN_DIMENSIONS', 1);
define('MEDIA_MEDIUM_THUMBNAIL_WIDTH', 560);
define('MEDIA_MEDIUM_THUMBNAIL_HEIGHT', 420);
define('MEDIA_MEDIUM_THUMBNAIL_RETAIN_DIMENSIONS', 1);
define('MEDIA_LARGE_THUMBNAIL_WIDTH', 1200);
define('MEDIA_LARGE_THUMBNAIL_HEIGHT', 900);
define('MEDIA_LARGE_THUMBNAIL_RETAIN_DIMENSIONS', 1);
define('MODULE_ARTICLE', 1);
define('ARTICLE_SHOW_ABOUT_AUTHOR', 1);
define('ARTICLE_ENABLE_COMMENTS_DEFAULT_VALUE', 1);
define('ARTICLE_ENABLE_LIKE', 1);
define('ARTICLES_PER_PAGE', 1);
define('ARTICLE_RELATED_ARTICLES', 1);
define('ARTICLE_RELATED_ARTICLES_MATCH_THRESHOLD', 1);
define('SHOW_UPDATE_NOTICE_FRONTEND', 1);
define('LANGUAGE_USE_INFORMAL_VARIANT', 0);
define('SHOW_STYLE_CHANGER', 0);
define('ARTICLE_SORT_ORDER', 'DESC');
define('USE_PAGE_TITLE_ON_LANDING_PAGE', 1);
define('OG_IMAGE', '');
define('HEAD_CODE', '');
define('AVATAR_DEFAULT_TYPE', 'initials');
define('ARTICLE_ENABLE_VISIT_TRACKING', 1);
define('ENABLE_AD_ROTATION', 1);
define('ENABLE_POLLING', 1);
define('ENABLE_DESKTOP_NOTIFICATIONS', 1);
define('FB_SHARE_APP_ID', '');
define('MODULE_CONTACT_FORM', 0);
