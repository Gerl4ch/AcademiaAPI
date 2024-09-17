<?php
// Conectar ao banco de dados
$servername = "localhost";
$username = "etecia";
$password = "123456";
$dbname = "bdAppPersonal";

$mysql = new mysqli($servername, $username, $password, $dbname);

if ($mysql->connect_errno) {
    echo "connect failed " . $mysql->connect_errno;
    exit();
}