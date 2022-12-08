<?php
include('server.php');

error_reporting(0);
$data = $_GET['rn'];
$query = "SELECT * FROM `branch` WHERE `branch`.`branch_ID`='$data'";
$result = mysqli_query($db, $query);
$toDelete = mysqli_fetch_assoc($result);
$query = "DELETE FROM `customer` WHERE `customer`.`acc_ID`='$toDelete[acc_ID]'";
$result = mysqli_query($db, $query);

if (!$result) {
    echo "Could not delete the data";
} else {
    header('location: admin.php');
}
