<?php
require_once("include_page.php");

$db = new DataBaseActions();
$db->dropTheDb();

header("location:login.php?login=0&status=3");
die();