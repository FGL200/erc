<?php

// DO NOT MAKE CHANGES IN THIS FILE

require_once "main.php";
require_once "config.php";
require_once "database.php";

if (!isset($config)) ERC_Error("Config is not defined.");
if (!isset($database)) ERC_Error("Database is not defined");

if ($database['port'] === '') unset($database['port']);
if ($database['socket'] === '') unset($database['socket']);

define("ERC_CONFIG", $config);
define("ERC_DB", $database);

unset($config);
unset($database);

class ERC_Database
{
    private static function connect()
    {
        if (!isset(ERC_DB['host'])) {
            ERC_Error("ERC is not defined correctly.");
            return false;
        }
        if (!isset(ERC_DB['username'])) {
            ERC_Error("ERC is not defined correctly.");
            return false;
        }
        if (!isset(ERC_DB['password'])) {
            ERC_Error("ERC is not defined correctly.");
            return false;
        }
        if (!isset(ERC_DB['database'])) {
            ERC_Error("ERC is not defined correctly.");
            return false;
        }

        return new mysqli(
            ERC_DB['host'],
            ERC_DB['username'],
            ERC_DB['password'],
            ERC_DB['database'],
            isset(ERC_DB['port']) ? ERC_DB['port'] : null,
            isset(ERC_DB['socket']) ? ERC_DB['socket'] : null
        );
    }

    private static function perform(String $query)
    {
        $con = ERC_Database::connect();
        if (!$con) ERC_Error("Failed to connect ot database.");

        $result = $con->query($query);
        if ($result === TRUE) {
            $id = isset($con->insert_id) ? $con->insert_id : 0;
            $con->close();
            return [["result" => $result, "id" => $id]];
        }

        $con->close();
        return $result;
    }

    public static function query(String $query)
    {
        $result = ERC_Database::perform($query);
        if (gettype($result) === gettype([])) return $result;
        $ret = [];
        while ($row = $result->fetch_assoc()) {
            $k = array_keys($row);
            $r = [];
            foreach ($k as $col) {
                $r[$col] = $row[$col];
            }
            array_push($ret, $r);
        }
        return $ret;
    }
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
    return isset(ERC_CONFIG['start_page']) ? ERC_CONFIG['start_page'] : '';
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
    include_once "../view/" . $view . ".php";
}
