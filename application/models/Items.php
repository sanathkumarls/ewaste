<?php
/**
 * Created by PhpStorm.
 * User: sanathls
 * Date: 21/05/20
 * Time: 4:06 PM
 */

require_once __DIR__."/../utilities/Database.php";

class Items
{
    function getItems()
    {
        $db = new Database();
        $con = $db->open_connection();
        $query = "select * from items";
        $result = $con->query($query);
        if($result->num_rows > 0)
            return $result;
        return false;
    }

    function getItemName($i_id)
    {
        $db = new Database();
        $con = $db->open_connection();
        $query = "select * from items where `i_id` = '$i_id'";
        $result = $con->query($query);
        if($result->num_rows > 0)
        {
            $row = $result->fetch_assoc();
            return $row['i_name'];
        }
        return '';
    }
}