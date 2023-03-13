<?php
require_once("include_page.php");


if($_POST&&
    $_POST["first_name"] && $_POST["last_name"]
    && $_POST["password"] && $_POST["ssn"]
    && $_POST["email"]
    && $_POST["password"] ==$_POST["password_confirm"]) { //check if the fields are empty
    $firstname = $_POST["first_name"];
    $lastname = $_POST["last_name"];
    $password = $_POST["password"];
    $ssn = $_POST["ssn"];
    $email = $_POST["email"];
    $pin = $_POST["pin"];
    $confirm_password = $_POST["password_confirm"];
    $false = false;
    $db = new DataBaseActions();

    //check if user with such ssn already exists:

    echo "checking ssn";
    if (!$db->ssnIsUnique($ssn)){
        $login_result = "ssn";
        header("location:register.php?failure=$login_result"."&firstname=$firstname"."&lastname=$lastname"."&ssn=$false"."&email=$email"."&pin=$pin");
        die();
    }


    //check if user with such email already exists:
    echo "checking email";
    if (!$db->emailIsUnique($email)){
        $login_result = "email";
        header("location:register.php?failure=$login_result"."&firstname=$firstname"."&lastname=$lastname"."&ssn=$ssn"."&email=$false"."&pin=$pin");
        die();
    }

    //check if password is repeated correctly
    if($password != $confirm_password){
        $login_result = "pw";
        header("location:register.php?failure=$login_result"."&firstname=$firstname"."&lastname=$lastname"."&ssn=$ssn"."&email=$email"."&pin=$pin");
        die();
    }


    //add user to the db
    echo "trying to add user";
    $db->addUser($firstname, $lastname, $password, $ssn, $email, $pin);
    if ($ssn == null) {
        $attempt_result = "db";
        echo "fail";
        header("location:register.php?failure=$attempt_result");
        die();
    }
    echo "user added";

    header("location:login.php?login=$email"."&status=1");
    die();

}

