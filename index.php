<?php
    require __DIR__.'/bootstrap.php';
    include ('color.php');

    
  

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Bankas</title>
</head>
<style>
    div {
        display: inline-block;
        text-align: center;
        width: 50%;
        margin: 50px;
    }
    h1 {
        text-align: center;
    }

</style>
<?= $img_pig ?>

<body style="<?= $color ?>">
<h1>PARŠIUKO BANKAS</h1>
    <div class="topnav">
        <a class="active" href="saskaitos.php">Sąskaitos</a>
        <hr>
        <a href="naujaSaskaita.php">Nauja sąskaita</a>
        <hr>
        <a href="papildyti.php">Pridėti pinigėlių</a>
        <hr>
        <a href="nuskaiciuoti.php">Nuskaičiuoti pinigėlius</a>
        <hr>
        
    </div>
    <img src="pig.png" alt="kiauliukas">
    

    <!-- <a href="saskaitos.php">Sąskaitų sąrašas</a>
    <a href="naujaSaskaita.php">Nauja sąskaita</a>
 -->



</body>

</html>