<?php
require __DIR__ . '/bootstrap.php';
include('color.php');
//POST scenarijus
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $name = (string) $_POST['vardas'] ?? 0;
    $surname = (string) $_POST['pavarde'] ?? 0;
    
  
    $userNameLength = strlen($_POST['vardas']);
    $userSurNameLength = strlen($_POST['pavarde']);
    
    if (isset($_POST['vardas']) || isset($_POST['pavarde'] ) ) {
        if (($userNameLength < 3) || ($userSurNameLength < 3)) {
            function_alert("Per trumpas vardas arba pavardė");
   
    } else {
    create($name, $surname); // sukuria
    $_SESSION['status'] = "Saskaita sukurta";
    header('Location: '.URL.'saskaitos.php');
    // function_alert("Sekmingai sukurta saskaita"); 
    die;
    }
}

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
    
    <form action="" method="post">
    
   Vardas: <input type="text" name="vardas">
   Pavarde: <input type="text" name="pavarde">
   Asm. Kodas: <input type="number" name="ask">
   <button type="submit" name="btn" class="btn btn-outline-primary">confirm</button>
    </form> 
   
     
</body>

<h4>
    <a href="index.php">Pradinis puslapis</a>
</h4>

</html>