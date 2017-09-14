<?php
include("config.php");
include("functions.php");

$buttonPressed = isset($_POST["admin-button"]) ? htmlentities($_POST["admin-button"]) : null;

$nextstudent = null;

if ($buttonPressed != null) {
    if ($buttonPressed == "next") {
        $data = getJSONFile("que");

        $nextstudent = array_shift($data);

        if ($nextstudent != null) {
            writeJSON($data, "que");
            $_SESSION["nextstudent"] = "Nu kommer: " . $nextstudent["name"] . " med uppgift " .  $nextstudent["exercise"] . ". Det är " . count($data) . " student(er) kvar i kön.";
            addHelpedStudent($nextstudent);
        } else {
            $_SESSION["nextstudent"] = "Slut på kön";
        }
    } elseif ($buttonPressed == "prev") {
        putBackHelped();
    }

}

header("Location: ../admin.php");
