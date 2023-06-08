<?php
require "bootstrap.php";

$table = new Table();
$lists = $db->getDataToSql();
if($db->getDataToSql()){
    $table->createTable($lists);
    echo $table->getTable();
}else{
echo '<p style="text-align:center;">Data Kommer Snart</p>';}
?>
