<?php
/**
 * Created by PhpStorm.
 * User: sanathls
 * Date: 14/05/20
 * Time: 11:59 AM
 */

require_once __DIR__."/../utilities/Database.php";

class Login
{
    function canLogin($email,$password)
    {
        $db = new Database();
        $con = $db->open_connection();
        $query = "select * from login where `l_email`='$email' and `l_password`='$password'";
        $result = $con->query($query);
        if($result->num_rows > 0)
            return $result;
        return false;
    }

    function getLoginDetails($email)
    {
        $db = new Database();
        $con = $db->open_connection();
        $query = "select * from login where `l_email`='$email'";
        $result = $con->query($query);
        if($result->num_rows > 0)
            return $result;
        return false;
    }

    function getCustomerName($l_id)
    {
        $db = new Database();
        $con = $db->open_connection();
        $query = "select * from login where `l_id`='$l_id'";
        $result = $con->query($query);
        if($result->num_rows > 0)
        {
            $row = $result->fetch_assoc();
            return $row['l_name'];
        }
        return '';
    }
}