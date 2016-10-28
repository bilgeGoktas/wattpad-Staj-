<?php
session_start();
$link = mysqli_connect("localhost", "root", "", "wattpad");

if (!$link) {
	echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit( "Bağlantı sağlanamadı." );
}
$link->set_charset("utf8");
?>