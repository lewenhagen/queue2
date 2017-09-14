<?php
include("config.php");
include("functions.php");

$name = isset($_POST["name"]) ? htmlentities($_POST["name"]) : "";
$exercise = isset($_POST["exercise"]) ? htmlentities($_POST["exercise"]) : "";

$data = getJSONFile("/db/students_in_queue.json");

if ($name === "" || $exercise === "") {
    $_SESSION["flash"] = "Nu glömde du något...";
    header("Location: ../index.php");
    exit;
}



if (!checkForDuplicates($data, "name", $name)) {
    addToJSON($data, $name, $exercise);
    $_SESSION["flash"] = "Välkommen $name. Du började köa: " . strval(date("H:i:s")) . ". Du har plats " . (count($data) + 1) . " i kön.";
} else {
    $_SESSION["flash"] = "Det finns redan en: $name. Välj annat namn.";
}

header("Location: ../index.php");
exit;
