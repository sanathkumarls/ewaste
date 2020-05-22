<?php
/**
 * Created by PhpStorm.
 * User: sanathls
 * Date: 21/05/20
 * Time: 4:28 PM
 */

require_once __DIR__."/../utilities/Database.php";

class Transaction
{
    function createTransaction($l_id,$i_id,$lat,$lon)
    {
        $db = new Database();
        $con = $db->open_connection();
        $query = "insert into transaction values (null,'$l_id','$i_id','$lat','$lon',0,CURRENT_TIMESTAMP )";
        return $con->query($query);
    }

    function getMessage($l_id)
    {
        $db = new Database();
        $con = $db->open_connection();
        $query = "select * from transaction where `t_submit_by_id`='$l_id' and `t_status` = 1";
        $result = $con->query($query);
        if($result->num_rows > 0)
            return $result;
        return false;
    }

    function getPending()
    {
        $db = new Database();
        $con = $db->open_connection();
        $query = "select * from transaction where `t_status` = 0";
        $result = $con->query($query);
        if($result->num_rows > 0)
            return $result;
        return false;
    }

    public function getTransaction($t_id)
    {
        $db = new Database();
        $con = $db->open_connection();
        $query = "select * from transaction where `t_id` = '$t_id'";
        $result = $con->query($query);
        if($result->num_rows > 0)
            return $result;
        return false;
    }

    function changeStatus($t_id)
    {
        $db = new Database();
        $con = $db->open_connection();
        $query = "update transaction set `t_status` = 1 where `t_id` = '$t_id'";
        return $con->query($query);
    }
}