<?php
require "vendor/autoload.php";
require 'classes/autoload.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['data'])) {
        $data = $_POST['data'];
        $db->deleteEntry($data);
    }
    if (isset($_POST['ini']) && isset($_POST['kmStart']) && isset($_POST['kmStop'])) {
        $ini = $_POST['ini'];
        $kmStart = $_POST['kmStart'];
        $kmStop = $_POST['kmStop'];
        $samledetal = $kmStop-$kmStart;
        $db->sendsDataToSql($ini, $kmStart, $kmStop, $samledetal);
    }
}
require 'views/header.php';
?>