<?php

use SilverStripe\Admin\CMSMenu;
use SilverStripe\View\Parsers\ShortcodeParser;
use SilverStripe\Assets\File;


/**
 * - CMS_DIR: Path relative to webroot, e.g. "cms"
 * - CMS_PATH: Absolute filepath, e.g. "/var/www/my-webroot/cms"
 */
define('CMS_PATH', realpath(__DIR__));
if(strpos(CMS_PATH, BASE_PATH) === 0) {
	define('CMS_DIR', trim(substr(CMS_PATH, strlen(BASE_PATH)), '/'));
} else {
	throw new Exception("Path error: CMS_PATH " . CMS_PATH . " not within BASE_PATH " . BASE_PATH);
}

/**
 * Register the default internal shortcodes.
 */
ShortcodeParser::get('default')->register(
	'sitetree_link',
	array('SilverStripe\\CMS\\Model\\SiteTree', 'link_shortcode_handler')
);

// TODO Remove once we can configure CMSMenu through static, nested configuration files
CMSMenu::remove_menu_class('SilverStripe\\CMS\\Controllers\\CMSMain');
CMSMenu::remove_menu_class('SilverStripe\\CMS\\Controllers\\CMSPageEditController');
CMSMenu::remove_menu_class('SilverStripe\\CMS\\Controllers\\CMSPageSettingsController');
CMSMenu::remove_menu_class('SilverStripe\\CMS\\Controllers\\CMSPageHistoryController');
CMSMenu::remove_menu_class('SilverStripe\\CMS\\Controllers\\CMSPageAddController');
