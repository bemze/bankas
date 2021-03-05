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


function create2($post){
  // $json_array =  json_decode(file_get_contents('data.json'), 1);
  $json_array =  readData();

  //issitrauki json masyva.
  //sugeneruoji nauja duomenu masyvuka
  $nauja_saskaita = [
    'id' => getNextId(),
    'vardas' => $post["fname"],
    'pavarde' => $post["surname"],
    'saskaitosNr' => $post["account"],
    'saskaitos_likutis' => $post["balance"],
    'ask' => $post["asmkodas"]

  ];
  //papildai masyva nauju masyvuku
  $json_array[] = $nauja_saskaita;
  writeData( $json_array);
  // $stringas = json_encode($json_array);
  //issaugai naujus duomenis su put_content
  // file_put_contents('data.json', $stringas);
}