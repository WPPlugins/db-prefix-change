<?php
define("PLUGIN_SLUG", "cd_prefix");
define("PLUGIN_TEXT", "Change DB Prefix");
define("PLUGIN_SLUG", "Change-DB-Prefix");
define("PLUGIN_IMAGE", "database.png");
define("PLUGIN_PAGE_SLUG", "change_db_prefix");
define('INCLUDE_PATH' , "includes/");
define('ASSETS_PATH' , "assets/");
define('CLASSES_PATH' , "classes/");
define('IMAGES_PATH' , ASSETS_PATH."images/");
define('CSS_PATH' , ASSETS_PATH."css/");
define('JS_PATH' , ASSETS_PATH."js/");
define('TEMPLATES_PATH' ,"templates/");
define('THEME_PATH' ,'/theme/templates/');
define('PLUGIN_VERSION','1');
define("PLUGIN_FORM", "cd_prefix_form");
define('TAB_CHANGE_PREFIX','ChangeDBPrefix');
define('ALERT_MSG','<b>Before execute this plugin:</b>
					Make sure your <em>wp-config.php</em> file must be <strong>writable</strong>. And check the database must have <strong>ALTER</strong> rights.');
define('RESTRICT_MSG','<b>Allowed characters:</b> all latin alphanumeric as well as the <strong>_</strong> (underscore).');
/* Frontend */
?>