<?php
/**
 * Created by PhpStorm.
 * User: sanathls
 * Date: 21/05/20
 * Time: 4:24 PM
 */

require_once __DIR__."/../models/Transaction.php";

if(isset($_POST['submit']) && isset($_POST['item']) && isset($_POST['latitude']) && isset($_POST['longitude']))
{
    $l_id = $_POST['submit'];
    $i_id = $_POST['item'];
    $lat = $_POST['latitude'];
    $lon = $_POST['longitude'];

    $objTran = new AddTransaction();
    $objTran->add($l_id,$i_id,$lat,$lon);

}
else
    header('Location: ../views/customer/home.php');


class AddTransaction
{
    function add($l_id,$i_id,$lat,$lon)
    {
        $objTransaction = new Transaction();
        $objTransaction->createTransaction($l_id,$i_id,$lat,$lon);
        echo "<script>
                        alert('Request Submitted Successfully');
                       window.location.href='../views/customer/home.php';
                </script>";
    }
}