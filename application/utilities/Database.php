<?php
/**
 * Copyright (c) 2020.  Sanath L S
 */

/**
 * Created by PhpStorm.
 * User: sanathls
 * Date: 05/05/20
 * Time: 4:37 PM
 */

class Database
{
    public function open_connection()
    {
        $host="localhost";
        $user="root";
        $pass="";
        $database="ewaste";
        return mysqli_connect($host,$user,$pass,$database);
    }

    public function close_connection()
    {
        return null;
    }
}