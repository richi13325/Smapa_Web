<?php

$server="localhost";
$user="root";
$pass="";
$db="bluespring";

$conexion=new mysqli($server,$user,$pass,$db,"3307");

if ($conexion->connect_errno){
    die("conexion fallida". $conexion->connect_errno);
} else{
    echo "conectado";
}

?>