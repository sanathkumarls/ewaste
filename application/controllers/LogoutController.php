<?php
/**
 * Created by PhpStorm.
 * User: sanathls
 * Date: 07/05/20
 * Time: 1:52 PM
 */

class LogoutController
{
    function logout()
    {
        session_start();
        session_destroy();
        echo "<script>
                        alert('Logout Successful');
                       window.location.href='../views/login.php';
                </script>";
    }
}

$objLogout = new LogoutController();
$objLogout->logout();