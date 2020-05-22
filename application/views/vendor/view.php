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

    if(isset($_POST['view']) && isset($_POST['t_id']))
    {
        $t_id = $_POST['t_id'];
        $result = $objTrans->getTransaction($t_id);
        if($result)
        {
            $row = $result->fetch_assoc();
            $c_name = $objLogin->getCustomerName($row['t_submit_by_id']);
            $item = $objItem->getItemName($row['item_id']);
            $lat = $row['t_latitude'];
            $lon = $row['t_longitude'];
        }
    }
    else
        header('Location: home.php');




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


    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
          integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
          crossorigin=""/>
    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
            integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
            crossorigin=""></script>
    <style>
        #mapid { height: 180px; }
    </style>

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
    <form action="../../controllers/PickUp.php" method="post">
<div class="offset-3 col-6 border " align="center">

    Name : <?php echo $c_name;?><br>
    Item : <?php echo $item;?>
    <br> <br>
    <div id="mapid" style="width: 600px; height: 400px;"></div>
    <script>
        var tileLayer = new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            'attribution': 'Map data © <a href="http://openstreetmap.org">OpenStreetMap</a> contributors'
        });

        var map = new L.Map('mapid', {
            'center': [0,0],
            'zoom': 3,
            'layers': [tileLayer]
        });
        map.setView([<?php echo $lat;?>, <?php echo $lon;?>],13);

        var marker = new L.Marker([<?php echo $lat;?>, <?php echo $lon;?>]).addTo(map);;


    </script>
    <br>
    <button type="submit" name="pickup" value="<?php echo $t_id;?>" class="btn-primary">Pick UP</button>

</div>
    </form>

</div>


</body>

</html>

