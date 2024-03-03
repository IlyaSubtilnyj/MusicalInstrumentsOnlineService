<?php

namespace App\DatabaseHelper;

class DatabaseHelper
{
    /**
     * Current database platform
     */
    public function getdbplat() 
    {
        $url = $_ENV['DATABASE_URL'];
        if (preg_match('/^(.*):\/\//', $url, $matches)) {
            $beforeColonSlashSlash = $matches[1];
            return $beforeColonSlashSlash;
        } else {
            return "No database configuration found.";
        }
    }   
}