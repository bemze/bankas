<?php
require __DIR__ . '/bootstrap.php';
    include ('color.php');
    //POST scenarijus
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // jei nera vardo - tada jis 0
    $user = $_POST['fname'] ?? 0;
    $user = (array) $user;
    
    $userCode = uniqid($user['ask']); // neaiskumas
    _d($userCode);
    create2($user); // sukuria
    function_alert("Sekmingai sukurta saskaita"); // neaiskumas
    header('Location: '.URL.'saskaitos.php');
    die;

}




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./public/css/app.css">
    <title>Nauja sąskaita</title>
</head>
<?= $img_pig ?>
<body style="<?= $color ?>">
<div class="topnav">
        <a class="active" href="saskaitos.php">Sąskaitos</a>
        <br>
        
        <a href="papildyti.php">Pridėti pinigėlių</a>
        <br>
        <a href="nuskaiciuoti.php">Nuskaičiuoti pinigėlius</a>
        <br>
        
    </div>
<h3>Nauja Sąskaita: </h3>

<form action="./saskaitosKurimas.php" method="POST">
    <!-- <input type="number" name="id" reguire placeholder="id" > -->
    <input type="text" name="fname" reguire placeholder="Vardas" required pattern="[A-Za-z]{3}">
    <input type="text" placeholder="Pavarde" name ='surname' required pattern="[A-Za-z]{3}">
    
    <input type="number" placeholder="Sąskaitos balansas" name ='balance' >
    <input type="number" placeholder="Asmens kodas" name ='asmkodas' required>
    <button type="submit" class="btn btn-outline-primary">confirm</button>
   
    </form>
</body> 

<h4>
<a href="index.php">Pradinis puslapis</a>
</h4>
</html>