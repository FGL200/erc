<?php

/** 
 * Folder name of your project
 * Delete this line if files for website are saved inside the htdocs
*/
defined("PROJECT") OR define("PROJECT", "erc");


/**
 * BASE PATH OF YOUR WEBSITE
 */
defined("BASE_PATH") OR define("BASE_PATH", $_SERVER['DOCUMENT_ROOT']);


/**
 * Include ERC
 */
require_once defined("PROJECT") ? 
    BASE_PATH."/".PROJECT."/system/erc.php" :
    BASE_PATH."/system/erc.php";


/**
 * Include project database
 */
require_once defined("PROJECT") ? 
    BASE_PATH."/".PROJECT."/config/database.php" :
    BASE_PATH."/config/database.php";


/**
 * Validate if code have run as intended
 */
if (!isset($database)) ERC_Error("Database is not defined");


/**
 * Include system database
 */
require_once defined("PROJECT") ? 
    BASE_PATH."/".PROJECT."/system/database.php" :
    BASE_PATH."/system/database.php";


/**
 * Include Configs
 */
require_once defined("PROJECT") ? 
    BASE_PATH."/".PROJECT."/config/config.php" :
    BASE_PATH."/config/config.php";

/**
 * Validate if code have run as intended
 */
if (!isset($config)) ERC_Error("Config is not defined.");

/**
 * Include Routes
 */
require_once defined("PROJECT") ? 
    BASE_PATH."/".PROJECT."/config/routes.php" :
    BASE_PATH."/config/routes.php";

/**
 * Validate if code have run as intended
 */
if (!isset($route)) ERC_Error("Route is not defined.");


/**
 * Include Constants
 */
require_once defined("PROJECT") ? 
    BASE_PATH."/".PROJECT."/config/constants.php" :
    BASE_PATH."/config/constants.php";



unset($config);
unset($database);
unset($route);