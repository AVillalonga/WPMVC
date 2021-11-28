<?php

/**
 * @package WPMVC
 */

namespace WPMVC;

// WPMVC CONFIGURATION

defined("WPMVC_THEME_NAMESPACE") or define("WPMVC_THEME_NAMESPACE", "WPMVC");
defined("WPMVC_THEME_DIRECTORY") or define("WPMVC_THEME_DIRECTORY", get_template_directory());

// AUTOLOADER
require_once WPMVC_THEME_DIRECTORY . "/autoloader.php";