<?php 
require __DIR__.'/bootstrap.php';

// POST scenarijus
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_GET['id'] ?? 0;
 
    $id = (int) $id;
    
    $papildymas = $_POST['papildyti'] ?? 0;
  
    $papildymas = (int) $papildymas;
    papildyti($id, $papildymas);
    function_alert("Sekmingai papildyta"); // redaguoja
    header('Location: saskaitos.php');
    die; 
   

}
//GET scenarijus
if ($_SERVER['REQUEST_METHOD'] == 'GET') {

  $id = $_GET['id'] ?? 0;
  $id = (int) $id;
  $user = getId($id);
  if(!$user) {
      header('Location: '.URL);
      die;
  }

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Papildymas</title>
</head>
<body style="<?= $color ?>"; >
    <h1>Papildyti sąskaitą: </h1>
   

    <form action="<?= URL ?>papildyti.php?id=<?= $user['id'] ?>" method="post">

    Sąskaitos savininkas <?= $user['vardas']. " ".$user['pavarde'] ?> : likutis: <?= $user['saskaitos_likutis']. " EUR" ?> <input type="text" placeholder="Kiek papildyti" name="papildyti">
    <button type="submit">Update</button>
    </form>

    <a href="<?= URL ?>saskaitos.php">Sąskaitos</a>
    <a href="<?= URL ?>">Pradinis</a>

</body>
</html>


