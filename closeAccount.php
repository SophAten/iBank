<?php
session_start();
require_once("include_page.php");

$db = new DataBaseActions();

$number = $_GET['number'];

$adminTasks = $db->getAdminTasks();
$concerns = false;
$i=0;
while($i<count($adminTasks)){
    if ($adminTasks[$i]->getCausedBy()==$number){
        $concerns = true;
    }
    $i++;
}
$db->getAccount($number)->getBalance();

if ($concerns){
    $true = true;
    header("location:Admin.php?c=$true");
    die();
} else if ($db->getAccount($number)->getBalance()==0){
    $db->closeAccount($number);
    header("location:Admin.php");
    die();
} else {
    $false = false;
    header("location:Admin.php?c=$false");
    die();
}

