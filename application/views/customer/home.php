<?php
/**
 * Created by PhpStorm.
 * User: sanathls
 * Date: 14/05/20
 * Time: 12:19 PM
 */


require_once __DIR__."/../../models/Login.php";
require_once __DIR__."/../../models/Items.php";
require_once __DIR__."/../../models/Transaction.php";
session_start();
if(isset($_SESSION['email']) && isset($_SESSION['role']))
{
    $c_email = $_SESSION['email'];
    $objLogin = new Login();
    $objItems = new Items();

    $result1 = $objLogin->getLoginDetails($c_email);
    if($result1)
    {
        $row1 = $result1->fetch_assoc();
        $c_name = $row1['l_name'];
        $l_id = $row1['l_id'];
    }
    else
        header('Location: ../login.php');

    $result = $objItems->getItems();

    $objTransaction = new Transaction();

    $result2 = $objTransaction->getMessage($l_id);

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

    <title>Customer - Dashboard</title>

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

    <a class="navbar-brand mr-1" href="home.php">Customer Dashboard</a>


<div class="offset-8 ">
    <ul class="navbar-nav ml-auto ml-md-0">
        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>
                <span class="badge badge-danger"><?php if($result2) echo $result2->num_rows;?></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="alertsDropdown">
                <?php

                    if($result2)
                    {

                        while ($row = $result2->fetch_assoc())
                        {
                            $date = date_parse($row['t_timestamp']);
                            $dd = $date['day']; $mm = $date['month']; $yy = $date['year'];
                            $hh = $date['hour']; $mi = $date['minute'];
                            $time = $dd+1 ."/".$mm."/".$yy." at ".$hh.":".$mi;
                            echo "Your Item ".$objItems->getItemName($row['item_id'])." will be picked up by ".$time." keep things ready";
                            if($result2->num_rows > 1)echo '<div class="dropdown-divider"></div>';
                        }
                    }
                    ?>
            </div>
        </li>
    </ul>
</div>
    <div class="offset-1">
    <a href="../../controllers/LogoutController.php" >
        <button class="btn-primary" >Logout</button></a>
    </div>

    <!--logout button here-->

</nav>



<div align="center" style="font-size: xx-large">
    Welcome <?php echo $c_name;?> !!!
</div>
<br><br>
<div class="accordion" >
    <form  action="../../controllers/AddTransaction.php" method="post">
    <div class="offset-3 col-sm-6 border" align="center">
        Plesae Select Items
        <select name="item" class="list-group" required>
            <?php
            if($result)
            {
                while ($row = $result->fetch_assoc())
                    echo ' <option class="list-group-item" value="'.$row['i_id'].'">'.$row['i_name'].'</option>';
            }
            else
                echo '<option class="list-group-item" value="0">---NIL---</option>';
            ?>

        </select>
        <br>
        Please Select Location
        <br>
        <div id="mapid" style="width: 600px; height: 400px;"></div>
        <input type="text" id="latitude" name="latitude" value="12.972442" hidden/>
        <input type="text" id="longitude" name="longitude" value="77.580643" hidden/>
        <script>
            var inputLat = document.getElementById("latitude");
            var inputLng = document.getElementById('longitude');
            var tileLayer = new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                'attribution': 'Map data © <a href="http://openstreetmap.org">OpenStreetMap</a> contributors'
            });

            var map = new L.Map('mapid', {
                'center': [0,0],
                'zoom': 3,
                'layers': [tileLayer]
            });
            map.setView([12.972442, 77.580643],13);

            var marker;

            map.on('click', function (e) {
                if (marker) {
                    map.removeLayer(marker);
                }
                marker = new L.Marker(e.latlng).addTo(map);
                inputLat.value = e.latlng.lat;
                inputLng.value = e.latlng.lng;
            });

        </script>
        <br>
<!--        <input id="address" type="text" /><br/>-->

        <button type="submit" class="btn btn-primary" name="submit" value="<?php echo $l_id;?>">Submit</button>
    </div>
    </form>
</div>


<script src="../../../assets/sb-admin/vendor/jquery/jquery.min.js"></script>
<script src="../../../assets/sb-admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<script src="../../../assets/sb-admin/js/sb-admin.min.js"></script>


</body>

</html>

