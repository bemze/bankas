<?php

require __DIR__ . '/bootstrap.php';

// include_once('saskaitosKurimas.php');
//POST scenarijus

// foreach(readData() as $users){
//     $likutis =$users['saskaitos_likutis'];





if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'] ?? 0;
    $id = (int) $id;
    $likutis = getUser($id);


    if ($likutis['saskaitos_likutis'] == 0) {

        deleteUser($id);
    //    $_SESSION['status'] = "Saskaita ".$id." panaikinta";
        $_SESSION['messages']['success'][] = "Saskaita ".$id." panaikinta";
        // function_alert('sąskaita istrinta');

        //be redirekto, reloudas tures post kuris buvo isetintas
        header('Location: ' . URL . 'saskaitos.php');
        die;
        // trina
    } else {
        $_SESSION['messages']['error'][] = "Saskaitos ".$id." trinti  negalima";
     //   function_alert('sąskaita, kurioje yra lėšų -  netrinama');
        // header('Location: ' . URL);
        // die;
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

<body style="<?= $color ?>" ;>
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

    <table>
        <tr>
            <th>NR</th>
            <th>Vardas Pavardė</th>
            <th>Asmens kodas</th>
            <th>Sąskaitos nr</th>
            <th>Sąskaitos likutis</th>
            <th>Ką daryti</th>


        </tr>
        <?php
        // sortinimas
        //po redirekt, kada puslapis nukreipia

        // $_SESSION['status']!="" patikra, kuri sutaupo resursus, nes jei bus tuscia sesija, kuri visada isetinta, PC eina per visus ifus, siuo atveju, neis

        if (isset($_SESSION['status']) || $_SESSION['status']!="") {
            if (strpos($_SESSION['status'],"panaikinta")) {
                echo "<h3 style='color:blue; margin-left: 100px'; >".$_SESSION['status']."</h3>";
            } 

            if ($_SESSION['status'] == "Saskaita sukurta") {
                echo "<h3 style='color:green; margin-left: 100px'; >Sąskaita sėkmingai sukurta</h3>";
            } 

            if ($_SESSION['status'] == "Sėkmingai papildyta sąskaita") {
                echo "<h2 style='color:blue; margin-left: 200px'; >Sėkmingai papildyta sąskaita</h2>";
            } 

            if ($_SESSION['status'] == "Sėkmingai nurašyta nuo sąskaitos") {
                echo "<h4 style='color:red; margin-left: 200px'; >Sėkmingai nurašyta nuo sąskaitos</h4>";
            }

            $_SESSION['status'] = "";
        }  

        $clients = readData();
        usort($clients, function ($a, $b) {
            return $a['pavarde'] <=> $b['pavarde'];
        });
        foreach ($clients as $user) {  ?>

            <!-- nuo -->
            <tr>
                <td> <?= $user['id'] ?> </td>
                <td><?= $user['vardas'] ?> <?= $user['pavarde'] ?></td>
                <td><?= $user['ask'] ?> </td>
                <td>
                    <?= $user['saskaitosNr'] ?>
                </td>
                <td><?= $user['saskaitos_likutis'] ?> EUR</td>
                <td>
                    <a class="btn btn-outline-success" href="<?= URL ?>papildyti.php?id=<?= $user['id'] ?>">Papildyti</a>
                    <a class="btn btn-outline-success" href="<?= URL ?>nuskaiciuoti.php?id=<?= $user['id'] ?>">Nurašyti</a>
                    <form action="" method="post">
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