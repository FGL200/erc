<?php

/**
 * Display an error message and stop the program
 * @param String $error error message
 */
function ERC_Error(String $error){
    echo '  <div style="padding: .5rem; border: 1px solid rgba(0,0,0,0.3); border-radius: 5px;">
                <b>Error:</b> <span style="color: red;">'.$error.'</span>
            </div>';
    exit;
}

/**
 * GET THE BASE USRL OF THE PROJECT.
 * To change properties, look for config/config.php
 * @param String $url url of the next page
 */
function base_url(String $url = ''): string
{
    if (ERC_CONFIG['base_url'][strlen(ERC_CONFIG['base_url']) - 1] !== '/')  $url = "/" . $url;
    return isset(ERC_CONFIG['base_url']) ? ERC_CONFIG['base_url'] . "$url" : '';
}

/**
 * GET THE DEFAULT STARTING PAGE OF THE PROJECT.
 * To change properties, look for config/config.php
 */
function start_page(): string
{
    return isset(ERC_ROUTE['default']) ? ERC_ROUTE['default'] : '';
}

/**
 * USE ONLY ON CONTROLLER.
 * Prepare the view page located on view folder
 * @param String $view the view to load located on view folder
 * @param array $var variables passed in view
 */
function load_view(String $view, $var = []): void
{
    extract($var);
    unset($var);
    require_once defined("PROJECT") ? 
        BASE_PATH."/".PROJECT."/view/{$view}.php" :
        BASE_PATH."/view/{$view}.php";
}


// function redirect(String $url){
    
    
// }

function ERC_controller($controller){
    require_once defined("PROJECT") ?
        BASE_PATH."/".PROJECT."/controller/{$controller}.php" :
        BASE_PATH."/controller/{$controller}.php";
}

function ERC_clear() {
    echo '<script>
        document.querySelector("body").innerHTML = "";
    </script>';
}