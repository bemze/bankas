<?php
//funkcija turi grazinti array
function readData(): array
{
    //jei nera failo, bus pirmas patikrinimas
    if (!file_exists(DIR . 'data.json')) {
        $data = json_encode([]);
        file_put_contents(DIR . 'data.json', $data);
    }

    $data = file_get_contents(DIR . 'data.json');
    return json_decode($data, 1);
}

//funkcija iraso duomenis
function writeData(array $data): void
{
    $data = json_encode($data);
    file_put_contents(DIR . 'data.json', $data);
}



//sukuria faila, kuriame saugomi indexai, kurie 
// niekada nesikartos, jei istrinsim faila nr2, tai naujas failas bus nr 3

function getNextId(): int
{
    if (!file_exists(DIR . 'indexes.json')) { // pirmas kartas
        $index = json_encode(['id' => 1]);
        file_put_contents(DIR . 'indexes.json', $index);
    }
    $index = file_get_contents(DIR . 'indexes.json');
    $index = json_decode($index, 1);
    $id = (int) $index['id'];
    $index['id'] = $id + 1;
    $index = json_encode($index);
    file_put_contents(DIR . 'indexes.json', $index);
    return $id;
}

// surasti pagal ID
function getId(int $id): ?array
{
    foreach (readData() as $user) {
        if ($user['id'] == $id) {
            return $user;
        }
    }
    return null;
}

// delete user
function deleteUser(int $id): void
{
    $users = readData();
    foreach ($users as $key => $user) {
        if ($user['id'] == $id) {
            unset($users[$key]);
            writeData($users);
            return;
        }
    }
}
function papildyti(int $id, int $count): void
{
    $users = readData(); // visai visi
    $user = getID($id);
    if (!$user) {
        return;
    }
    $user['saskaitos_likutis'] += $count;
    deleteUser($id);
    $users = readData(); // visi be istrinto
    $users[] = $user;
    writeData($users);
}
function nurasyti(int $id, int $count): void
{


    $user = getUser($id);
    if (!$user) {
        return;
    }

    $saskaitos_likutis = $user['saskaitos_likutis'];

    $likutis_atemus = $saskaitos_likutis - $count;

    if ($likutis_atemus < 0) {
        $_SESSION['messages']['success'][] = "Saskaita negali būti minusinė";
        header('Location: ' . URL . 'saskaitos.php');
        die;
    } elseif ($count == 0 || $saskaitos_likutis == 0) {

        $_SESSION['messages']['success'][] = "Sąskaita su 0 negaminama";
        header('Location: ' . URL . 'saskaitos.php');
        die;
    } else {
        $user['saskaitos_likutis'] -= $count;

        deleteUser($id);
        $users = readData(); // visi be istrinto
        $users[] = $user;
        writeData($users);
    }
}




function function_alert($message)
{


    echo "<script>alert('$message');</script>";
}

function generateAccountNumber(): string
{
    $bankCode = 88000;
    $randNumber = '';
    for ($i = 0; $i < 10; $i++) {
        $rand = (string) rand(0, 9);
        $randNumber .= $rand;
    }
    $acountNumber = "LT01" . $bankCode . $randNumber;
    return $acountNumber;
}



function create($name, $surname): void
{
    $users = readData();
    $id = getNextId();
    // $ak = 
    $user = [
        'id' => getNextId(),
        'vardas' => $name,
        'pavarde' => $surname,
        'saskaitosNr' => generateAccountNumber(),
        'saskaitos_likutis' => '0',
        'ask' => asmensKodas()
    ];
   
    // 2d array, jo sekantis index'as musu sukurtas useris
    $users[] = $user;
    writeData($users);
    $_SESSION['status'] = 'Operacija atlikta sėkmingai!';
}


function asmensKodas()
{
    $randKodas = '';
    for ($i = 0; $i < 9; $i++) {
        $rand = rand(0,9);
        $randKodas .= $rand;
    }
    $asmKodas = "3" . $randKodas;

    $users = readData();
 
    foreach ($users as $user) {
        if ($user['ask'] == $asmKodas) {
            $_SESSION['messages']['error'][] = "Toks kodas jau yra";
            return asmensKodas();
        } 
    }
    return $asmKodas;
}

function valideID($asmensKodas)   //kur valduoti?
{
    $users = readData();
    foreach ($users as $user) {
        if ($user['ask'] == $asmensKodas) {
            $_SESSION['status'] = 'Ivyko klaida! Bandykite dar karta.';
            return;
        } else {
            echo $asmensKodas . " tokio kodo duonbazėje nerasta";
        }
    }
}



function getUser(int $id): ?array
{
    $users = readData();
    foreach ($users as $user) {
        if ($user['id'] == $id) {
            return $user;
        }
    }
    return null;
}
