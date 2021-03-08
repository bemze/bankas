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


// function create(int $account) : void
// {
//     $data = readData();
//     $id = getNextId();
//     $balansas = [
//       'id' => $id,
//       'vardas' => $_POST["fname"],
//       'pavarde' => $_POST["surname"],
//       'saskaitosNr' => $_POST["account"],
//       'saskaitos_likutis' => $account,
//       'ask' => $_POST["asmkodas"]

//     ];
//     $new_balanse[]=$balansas;
//     writeData($new_balanse);
// }




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
    $users = readData(); // visai visi
    $user = getID($id);
    if (!$user) {
        return;
    
  
    }else{
        $user['saskaitos_likutis'] -= $count;
    }
    deleteUser($id);
    $users = readData(); // visi be istrinto
    $users[] = $user;
    writeData($users);
}

function function_alert($message)
{

    // Display the alert box  
    echo "<script>alert('$message');</script>";
}

function generateAccountNumber() : string 
{
    $bankCode = 88000;
    $randNumber = '';
for ($i=0; $i <10 ; $i++) { 
    $rand = (string) rand(0,9);
    $randNumber .= $rand;
}
    $acountNumber = "LT01".$bankCode.$randNumber;
    return $acountNumber;
}

function create2($post)
{
    // $json_array =  json_decode(file_get_contents('data.json'), 1);
    $json_array =  readData();

    //issitrauki json masyva.
    //sugeneruoji nauja duomenu masyvuka
    $nauja_saskaita = [
        'id' => getNextId(),
        'vardas' => $post["fname"],
        'pavarde' => $post["surname"],
        'saskaitosNr' => generateAccountNumber(),
        'saskaitos_likutis' => $post["balance"],
        'ask' => $post["asmkodas"]

    ];
    //papildai masyva nauju masyvuku
    $json_array[] = $nauja_saskaita;
    writeData($json_array);
    // $stringas = json_encode($json_array);
    //issaugai naujus duomenis su put_content
    // file_put_contents('data.json', $stringas);
}

function asmensKodas () : string
{
    $randKodas = '';
    for ($i=0; $i <11 ; $i++) { 
        
    }
    $asmKodas = "3";
    return $asmKodas;
}