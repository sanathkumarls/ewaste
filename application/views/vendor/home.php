<?php
/**
 * Created by PhpStorm.
 * User: sanathls
 * Date: 14/05/20
 * Time: 12:19 PM
 */

require_once __DIR__."/../../models/Login.php";
require_once __DIR__."/../../models/Transaction.php";
require_once __DIR__."/../../models/Items.php";

session_start();
if(isset($_SESSION['email']) && isset($_SESSION['role']))
{
    $v_email = $_SESSION['email'];
    $objLogin = new Login();

    $result1 = $objLogin->getLoginDetails($v_email);
    if($result1)
    {
        $row1 = $result1->fetch_assoc();
        $v_name = $row1['l_name'];
    }
    else
        header('Location: ../login.php');

    $objItem = new Items();
    $objTrans = new Transaction();
    $result2 = $objTrans->getPending();

}
else
{
    header('Location: ../login.php');
}

?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Vendor - Dashboard</title>

    <!-- Bootstrap core CSS-->
    <link href="../../../assets/sb-admin/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="../../../assets/sb-admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">


    <!-- Custom styles for this template-->
    <link href="../../../assets/sb-admin/css/sb-admin.css" rel="stylesheet">

</head>

<body id="page-top">

<nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="home.php">Vendor Dashboard</a>

<div class="offset-9">
    <a href="../../controllers/LogoutController.php" >
        <button class="btn-primary" >Logout</button></a>
</div>
    <!--logout button here-->

</nav>

<div align="center" style="font-size: xx-large">
    Welcome <?php echo $v_name;?> !!!
</div>
<br><br>
<div class="accordion">
    <table class="table-bordered" width="100%" cellspacing="10px" border="10px" cellpadding="10%" align="center">
        <thead class="font-weight-bold">
        <tr>
            <td>Sl No.</td>
            <td>Customer Name</td>
            <td>Item</td>
            <td>Time</td>
            <td>Action</td>
        </tr>
        </thead>

        <?php

        if($result2)
        {
            $i =1;
            while($row = $result2->fetch_assoc())
            {
                echo "<tr>
            <td>".$i."</td>
            <td>".$objLogin->getCustomerName($row['t_submit_by_id'])."</td>
            <td>".$objItem->getItemName($row['item_id'])."</td>
            <td>".$row['t_timestamp']."</td>
            <td><form method='post' action='view.php'><input type='text' name='t_id' value='".$row['t_id']."' hidden><button class='btn-success' type='submit' name='view' value='view'>View</button></form></td>
        </tr>";
                $i++;
            }
        }
        else
            echo "</table> <div align='center' style='font-size: large' class='font-weight-bold'> No Records Found...</div>"

        ?>

    </table>
</div>




</body>

</html>

