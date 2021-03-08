<?php
session_start();
define('DIR', __DIR__ . '/');
require DIR . 'functions.php';

// _d(create(20));


if (isset($_POST["fname"])) {
  create2($_POST);
}
header('location:saskaitos.php');
die;


