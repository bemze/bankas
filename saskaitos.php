<?php
// session_start();
require __DIR__ . '/bootstrap.php';


_d(__DIR__);

// include_once('saskaitosKurimas.php');
//POST scenarijus

// foreach(readData() as $users){
//     $likutis =$users['saskaitos_likutis'];
   


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'] ?? 0;
    $likutis =$_POST['saskaitos_likutis'] ?? 0;
    $id = (int) $id;
    if ( $likutis == 0 ) {
       //jei saskaita 0 - trinam, kitu atveju, ne
        deleteUser($id); // trina
    } else {
        function_alert('sąskaita, kurioje yra lėšų -  netrinama');
        
    }
} 


// }



usort(readData(), function ($a, $b) {
    return $a['pavarde'] <=> $b['pavarde'];
});
    
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./public/css/app.css">
    <title>Sąskaitų sąrašas</title>
</head>
<?= $img_pig ?>
<?= $table_borders ?>
<style>
    body {
       display: inline-block;
       padding: 20px;
    }

</style>
<body style="<?= $color ?>"; >
    <div class="topnav">
        <a class="active" href="saskaitos.php">Sąskaitos</a>
        <br>
        <a href="naujaSaskaita.php">Nauja sąskaita</a>
        <br>
        <!-- <a href="papildyti.php">Pridėti pinigėlių</a>
        <br>
        <a href="nuskaiciuoti.php">Nuskaičiuoti pinigėlius</a>
        <br> -->

    </div>



    <h3>Sąskaitų sąrašas: </h3>

    <table  >
        <tr>
            <th>NR</th>
            <th>Vardas Pavardė</th>
            <th>Sąskaitos nr</th>
            <th>Sąskaitos likutis</th>
            <th>Ką daryti</th>
           

        </tr>
        <?php
        // sortinimas
$clients = readData();
usort($clients, function ($a, $b) {
    return $b['id'] <=> $a['id'];
});
        foreach ($clients as $user) {  ?>

            <!-- nuo -->
            <tr>
                <td> <?= $user['id'] ?> </td>
                <td><?= $user['vardas'] ?> <?= $user['pavarde'] ?></td>
                <td>
                    <?= $user['saskaitosNr'] ?>
                </td>
                <td><?= $user['saskaitos_likutis'] ?> EUR</td>
                <td >
                <a class="btn btn-outline-success" href="<?= URL ?>papildyti.php?id=<?= $user['id'] ?>">Papildyti</a>
                <a class="btn btn-outline-success" href="<?= URL ?>nuskaiciuoti.php?id=<?= $user['id'] ?>">Nurašyti</a>
                    <form action="" method="post" >
                        <input type="hidden" name="id" value="<?= $user['id'] ?>">
                      
                        <button type="submit" class="btn btn-danger">Istrinti</button>
                    </form>
                </td>


            </tr>
            <!-- iki -->
        <?php }  ?>
    </table>
    <h4>
        <a href="index.php">Pradinis puslapis</a>
    </h4>
</body>

</html>
