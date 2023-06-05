<?php
require "vendor/autoload.php";
require 'classes/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
$db = new DB();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['data'])) {
        $data = $_POST['data'];
        $db->deleteEntry($data);
    }
    if (isset($_POST['ini']) && isset($_POST['kmStart']) && isset($_POST['kmStop'])) {
        $ini = $_POST['ini'];
        $kmStart = $_POST['kmStart'];
        $kmStop = $_POST['kmStop'];
        $samledetal = $kmStop - $kmStart;
        if($db->sendsDataToSql($ini, $kmStart, $kmStop, $samledetal)){
            header("Location: features.php");
            exit();
        }

    }
}
require 'views/header.php';
?>