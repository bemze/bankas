<?php
//funkcija turi grazinti array
function readData() : array 
{
    //jei nera failo, bus pirmas patikrinimas
    if(!file_exists(DIR.'data.json')) {
    $data = json_encode([]);
    file_put_contents(DIR.'data.json', $data);
}

$data = file_get_contents(DIR.'data.json');
return json_decode($data, 1);
}

//funkcija iraso duomenis
function writeData(array $data) : void
{
    $data = json_encode($data);
    file_put_contents(DIR.'data.json', $data);
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

function getNextId() : int
{
    if (!file_exists(DIR.'indexes.json')) {// pirmas kartas
        $index = json_encode(['id'=>1]);
        file_put_contents(DIR.'indexes.json', $index);
    }
    $index = file_get_contents(DIR.'indexes.json');
    $index = json_decode($index, 1);
    $id = (int) $index['id'];
    $index['id'] = $id + 1;
    $index = json_encode($index);
    file_put_contents(DIR.'indexes.json', $index);
    return $id;
}

// surasti pagal ID
function getId(int $id) : ?array
{
    foreach(readData() as $user) {
        if ($user['id'] == $id) {
            return $user;
        }
    }
    return null;
}

// delete user
function deleteUser(int $id) : void
{
    $users = readData();
    foreach($users as $key => $user) {
        if ($user['id'] == $id) {
            unset($users[$key]);
            writeData($users);
            return;
        }
    }
}
function update(int $id, int $count) : void
{
    $users = readData();// visai visi
    $user = getID($id);
    if(!$user) {
        return;
    }
    $user['saskaitos_likutis'] += $count;
    deleteUser($id);
    $users = readData(); // visi be istrinto
    $users[] = $user; 
    writeData($users);
}