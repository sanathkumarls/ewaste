<?php
/**
 * Created by PhpStorm.
 * User: sanathls
 * Date: 21/05/20
 * Time: 5:53 PM
 */

require_once __DIR__."/../models/Transaction.php";

if(isset($_POST['pickup']))
{
    $t_id = $_POST['pickup'];
    $objPick = new PickUp();
    $objPick->changeStatus($t_id);
}

class PickUp
{
    function changeStatus($t_id)
    {
        $objTrans = new Transaction();
        $objTrans->changeStatus($t_id);
        echo "<script>
                        alert('Pick Up Success');
                       window.location.href='../views/vendor/home.php';
                </script>";
    }
}