<?php

/**
 * @package WPMVC
 */

namespace WPMVC;

function __MAIN__() {
    defined("WPMVC_THEME_NAMESPACE") or define("WPMVC_THEME_NAMESPACE", "WPMVC");
    defined("WPMVC_THEME_DIRECTORY") or define("WPMVC_THEME_DIRECTORY", get_template_directory());
    // ADD AUTOLOADER
    require_once WPMVC_THEME_DIRECTORY . "/autoloader.php";
}

__MAIN__();
