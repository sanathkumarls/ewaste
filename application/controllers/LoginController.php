<?php
/**
 * Created by PhpStorm.
 * User: sanathls
 * Date: 05/05/20
 * Time: 5:57 PM
 */

require_once __DIR__."/../models/Login.php";
require_once __DIR__."/../utilities/Constants.php";
session_start();

if(isset($_POST['submit']))
{
    $objLoginController = new LoginController();
    $objLoginController->getUserInput();
}

class LoginController
{
    public function getUserInput()
    {
        $email = $_POST['email'];
        $password = $_POST['password'];
        //print_r($name);
        //print_r($password);
        if($email != null && $password != null)
            $this->checkLogin($email,$password);
        else
            echo "<script>
                        alert('Please Enter Useremail And Password');
                       window.location.href='../views/login.php';
                </script>";
    }
    public function checkLogin($email,$password)
    {
        $objLogin = new Login();
        $result = $objLogin->canLogin($email,$password);
        if($result)
        {
            $row = $result->fetch_assoc();
            $_SESSION['email'] = $email;
            $role = $row['l_role'];
            $_SESSION['role'] = $role;
            if($role == Constants::roleVendor)
                echo '<script>window.location.href="../views/vendor/home.php"</script>';
            else
                echo '<script>window.location.href="../views/customer/home.php"</script>';
        }
        else
        {
            echo '<script>alert("Incorrect Username Or Password"); window.location.href="../views/login.php"</script>';
        }
    }
}