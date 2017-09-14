<?php
include("config.php");
include("functions.php");

$buttonPressed = isset($_POST["admin-button"]) ? htmlentities($_POST["admin-button"]) : null;

$nextstudent = null;

if ($buttonPressed != null) {
    $data = getJSONFile("/db/students_in_queue.json");
    // echo "afsdfasf"; die();
    $nextstudent = array_shift($data);

    if ($nextstudent != null) {
        writeJSON($data, "/db/students_in_queue.json");
        $_SESSION["nextstudent"] = "Nu kommer: " . $nextstudent["name"] . " med uppgift " .  $nextstudent["exercise"] . ". Det är " . count($data) . " studenter kvar i kön.";
        addHelpedStudent($nextstudent);
        // addPlaceToJson();
    } else {
        $_SESSION["nextstudent"] = "Slut på kön";
    }
}

header("Location: ../admin.php");
