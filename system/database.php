<?php

if ($database['port'] === '') unset($database['port']);
if ($database['socket'] === '') unset($database['socket']);

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