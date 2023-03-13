<?php
session_start();
require_once("include_page.php");
$currentUser = unserialize($_SESSION['user']);
$ssn = $currentUser->getSSN();
$db = new DataBaseActions();

$attempt_result = true;
if ($ssn == null) {
    $attempt_result = false;
    header("location:openAccount.php?sessionAccess=$attempt_result");
    die();
}

if(!($_POST["accountname"]&&$_POST["account_type"])){
    $attempt_result = false;
    header("location:openAccount.php?opening=$attempt_result");
    die();
}

$name = $_POST["accountname"];
$deposit = $_POST["deposit"];



if ($_POST["account_type"] == "Credit Account"){
    $account_type = BankAccount::$ACCOUNT_TYPE_CREDIT;
    $db->addAccount($name,$ssn,$deposit,$account_type);
} else if ($_POST["account_type"] == "Debit Account"){
    $account_type = BankAccount::$ACCOUNT_TYPE_DEBIT;
    $db->addAccount($name,$ssn,$deposit,$account_type);
} else if ($_POST["account_type"] == "Goal Account"){
    $account_type = BankAccount::$ACCOUNT_TYPE_GOAL;
    $db->addGoal($name,$ssn,$deposit,$account_type);
} else {
    $account_type = $_POST["account_type"];
    echo "sad";
}

echo $attempt_result;
header("location:Admin.php");
die();

