<?php
session_start();

define('URL', 'http://localhost/projektai/nd/webMechanika/bankas/'); // <--- konstanta
define('DIR', __DIR__.'/');
require DIR. 'functions.php';
include('color.php');
include('skaiciavimai.php');

_d($_SESSION, 'SESIJA--->');