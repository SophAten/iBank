<?php
session_start();
require_once("include_page.php");

$db = new DataBaseActions();
$approve = $_GET['approve'];
echo "approve = ".$_GET['approve'];
echo "check = ".$_GET['check'];

if($approve===true){
    echo "approved";
    $db->approveCheck($_GET['check']);
} else {
    echo "denied";
    $db->denyCheck($_GET['check']);
}

header("location:admin_center.php");
die();