<?php
session_start();
require_once("include_page.php");
$db = new DataBaseActions();

if($_GET){
    if($_GET['status']==1){
        $email = $_GET['email'];
        $pin = $_GET['pin'];
        echo $db->atmLogin($email, $pin);
    }
    if($_GET['status']==2){
        $accountNumber = $_GET['number'];
        echo $db->getAccount($accountNumber)->getBalance();
    }
    if($_GET['status']==3){
        $accountNumber = $_GET['number'];
        $amount = $_GET['withdraw_amount'];
        echo $db->withdraw($accountNumber, $amount);
    }
}


