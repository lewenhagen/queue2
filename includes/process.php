<?php
include("config.php");
$name = isset($_POST["name"]) ? htmlentities($_POST["name"]) : "";
$exercise = isset($_POST["exercise"]) ? htmlentities($_POST["exercise"]) : "";

if ($name === "" || $exercise === "") {
    $_SESSION["flash"] = "Du måste skriva namn och uppgift.";
    // session_destroy();
    header("Location: ../index.php");
    exit;
}

function getJSONFile() {
    $queue = file_get_contents('../db/students_in_queue.json', true);
    if ($queue === false) {
        die('unable to read queue');
    }
    $data = json_decode($queue,true);
    if ($data === NULL) {
        die('Unable to decode');
    }
    unset($queue);

    return $data;
}



function checkForDuplicates($what, $lookFor) {
    $data = getJSONFile();
    return in_array($lookFor, array_column($data, $what));
}



function addToJSON($name, $exercise) {
    $data = getJSONFile();
    // echo "data before\n";
    // var_dump ($data);
    //you need to add new data as next index of data.
    $data[] = array(
        'name' => $name,
        'exercise' => $exercise,
        'time' => strval(date("H:i:s"))
    );
    // echo "data after\n";
    // var_dump ($data);

    $result = json_encode($data);
    // var_dump($result);
    if (file_put_contents('../db/students_in_queue.json', $result) === false){
        die('unable to write queue');
    }
    unset($result);
}

if (!checkForDuplicates("name", $name)) {
    addToJSON($name, $exercise);
    $_SESSION["flash"] = "Välkommen $name. Du började köa: " . strval(date("H:i:s"));
} else {
    $_SESSION["flash"] = "Det finns redan en: $name. Välj annat namn.";
}

header("Location: ../index.php");
