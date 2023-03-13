<?php
session_start();
require_once("include_page.php");
//error_reporting(E_ALL ^ E_WARNING);
$db = new DataBaseActions();

if($_POST){
    if ($_POST["name"] and $_POST["password"]) { //check if the fields are empty
        $name = $_POST["name"];
        $password = $_POST["password"];

        //check if the user is Admin:
        if($name == "admin" and $password == "admin"){
            header("location: admin_center.php");
            die();
        }

        $ssn = $db->login($name, $password);
        if ($ssn == null) {
            $login_result = 2;
            header("location:login.php?login=$name"."&status=$login_result");
            die();
        } else {
            $currentUser = $db->getUser($ssn);
            $_SESSION['user'] = serialize($currentUser);

        }
    } else die();

    header("location: Admin.php");
}
if ($_GET){
    $db->dropTheDb();
    $name = "";
    header("location:login.php?login=$name"."&status=3");
}



//die();
//each user can have multiple banking accounts that can be accessed with $db->getBankingAccounts("user id"); array
?>