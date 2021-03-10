<?php
session_start();
if(!isset($_SESSION["messages"])){
    $_SESSION["messages"]["success"]=[];
    $_SESSION["messages"]["error"]=[];
}

define('URL', 'http://localhost/projektai/nd/webMechanika/bankas/'); // <--- konstanta
define('DIR', __DIR__.'/');
require DIR. 'functions.php';
include('color.php');
include('skaiciavimai.php');

//cia tikrinam success_message ir error_message masyvus.
foreach($_SESSION['messages']['success'] as $msg){
    echo "<h2 style='color:green; margin-left: 100px';>$msg</h2>";  
}
$_SESSION['messages']['success'] = [];

foreach($_SESSION['messages']['error'] as $msg){
    echo "<h2 style='color:red; margin-left: 100px';>$msg</h2>"; 
}
$_SESSION['messages']['error'] = [];
// _d($_SESSION, 'SESIJA--->');