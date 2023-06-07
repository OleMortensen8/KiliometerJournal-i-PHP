<?php
$data = array(
    'labels' => array('January', 'February', 'March', 'April', 'May'),
    'data' => array(12, 19, 3, 5, 2, 3),
);
header('Content-Type: application/json');
echo json_encode($data);
?>
