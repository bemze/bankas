<?php

require __DIR__ . '/bootstrap.php';
// POST scenarijus
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $id = $_GET['id'] ?? 0;

  $id = (int) $id;

  $nurasyti = $_POST['nurasyti'] ?? 0;

  $nurasyti = (int) $nurasyti;
  nurasyti($id, $nurasyti); // redaguoja
  
  
  $_SESSION['messages']['success'][] = "Saskaita ".$id." sumažinta";
  header('Location: saskaitos.php');
  die;
}
//GET scenarijus
if ($_SERVER['REQUEST_METHOD'] == 'GET') {

  $id = $_GET['id'] ?? 0;
  $id = (int) $id;
  $user = getId($id);
  if (!$user ) {
    header('Location: saskaitos.php');
    function_alert("Nėra tokio vartotojo");
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
  <title>Sąskaitos nurašymas</title>
</head>
<?= $img_pig ?>
<style>
  table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
  }

  td,
  th,
  tr {
    border: 1px solid #000;
    text-align: left;
    padding: 8px;
  }

  tr:nth-child(even) {
    background-color: #dddddd;
  }
</style>

<body style="<?= $color ?>">
  <div class="topnav">
    <a class="active" href="saskaitos.php">Sąskaitos</a>
    <br>
    <a href="naujaSaskaita.php">Nauja sąskaita</a>
    <br>
    <a href="papildyti.php">Pridėti pinigėlių</a>
    <br>


  </div>
  <h3>Nurašyti nuo sąskaitos: </h3>


  <table>
    <tr>
      <th>NR</th>
      <th>Vardas Pavardė</th>
      <th> Sąskaitos nr</th>
      <th>Sąskaitos likutis</th>
      <th>Kiek nurašyti</th>
    </tr>

    <?php
    foreach (readData() as $user) { ?>
      <tr>
        <td> <?= $user['id'] ?> </td>
        <td><?= $user['vardas'] ?> <?= $user['pavarde'] ?></td>
        <td>
          <?= $user['saskaitosNr'] ?>
        </td>
        <td><?= $user['saskaitos_likutis'] ?> EUR</td>
        <td>
          <form action="<?= URL ?>nuskaiciuoti.php?id=<?= $user['id'] ?>" method="post">


            <input type="text" value="<?= $user['saskaitos_likutis'] ?>" name="nurasyti">
            <button type="submit">Nurašyti</button>
          </form>

      </tr>
    <?php }  ?>
  </table>
  <h4>
    <a href="index.php">Pradinis puslapis</a>
  </h4>
  <img src="pig.png" alt="kiauliukas">
</body>

</html>