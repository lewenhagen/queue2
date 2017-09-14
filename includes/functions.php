<?php

function getPath($whichFile)
{
    $path = null;

    switch ($whichFile) {
        case "que":
            $path = "/db/students_in_queue.json";
            break;
        case "helped":
            $path = "/db/helped_students.json";
            break;
        default:
            die("Some error in get string.");
            break;
    }
    return $path;
}



function getJSONFile($whichFile)
{
    $path = getPath($whichFile);

    $queue = file_get_contents($_SERVER["DOCUMENT_ROOT"] . "$path", true);
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



function checkForDuplicates($data, $what, $lookFor)
{
    return in_array($lookFor, array_column($data, $what));
}



function addToJSON($data, $name, $exercise)
{
    $data[] = array(
        "place" => count($data) + 1,
        "name" => $name,
        "exercise" => $exercise,
        "time" => strval(date("H:i:s"))
    );

    writeJSON($data, "que");
}



function writeJSON($data, $whichFile)
{
    $path = getPath($whichFile);

    $result = json_encode($data);

    if (file_put_contents($_SERVER["DOCUMENT_ROOT"] . "$path", $result) === false){
        die('unable to write queue');
    }
    unset($result);
}



function printQueue()
{
    $data = getJSONFile("que");
    $html = "";
    $counter = 1;

    foreach ($data as $item) {
        $html .= "<tr><td>" . $counter . "</td>";
        $html .= "<td>" . $item["name"] . "</td>";
        $html .= "<td>" . $item["exercise"] . "</td>";
        $html .= "<td>" . $item["time"] . "</td></tr>";
        $counter++;
    }
    return $html;
}



function printHelpedQueue()
{
    $data = getJSONFile("helped");
    $html = "";
    $counter = 1;

    foreach ($data as $item) {
        $html .= "<tr><td>" . $counter . "</td>";
        $html .= "<td>" . $item["name"] . "</td>";
        $html .= "<td>" . $item["exercise"] . "</td>";
        $html .= "<td>" . $item["time"] . "</td></tr>";
        $counter++;
    }
    return $html;
}



function addHelpedStudent($thestud)
{
    $data = getJSONFile("helped");

    array_unshift($data, array(
        "name" => $thestud["name"],
        "exercise" => $thestud["exercise"],
        "time" => $thestud["time"]
    ));

    writeJSON($data, "helped");
}



function getQueueNumber($data, $key, $lookFor)
{
    $counter = 1;
    foreach ($data as $item) {
        if ($item[$key] == $lookFor) {
            break;
        }
        $counter++;
    }
    return $counter;
}



function addDuplicateToJSON($data, $name, $where)
{
    $counter = 1;
    foreach ($data as &$item) {
        if ($counter == $where) {
            $item["name"] .= ", $name";
        }
        $counter++;
    }
    writeJSON($data, "que");
}



function nowHelping()
{
    $data = getJSONFile("helped");
    $message = $data != false ? "Välkommen fram: " . $data[0]["name"] : "";
    return $message;
}



function putBackHelped()
{
    $helped = getJSONFile("helped");
    $queued = getJSONFile("que");

    if ($helped) {
        $transferMe = array_shift($helped);
        array_unshift($queued, $transferMe);
        $_SESSION["nextstudent"] = "Du skickade tillbaka " . $transferMe["name"] . " till kön.";
    } else {
        $_SESSION["nextstudent"] = "Finns ingen kvar att skicka tillbaka.";
    }


    writeJSON($helped, "helped");
    writeJSON($queued, "que");
}



function clear($clearWhat)
{
    $helped = getJSONFile("helped");
    $queued = getJSONFile("que");

    switch($clearWhat) {
        case "helped":
            unset($helped);
            $helped = array();
            break;
        case "queue":
            unset($queued);
            $queued = array();
            break;
        case "all":
            unset($helped);
            unset($queued);
            $helped = array();
            $queued = array();
            break;
        default:
            break;

    }

    writeJSON($helped, "helped");
    writeJSON($queued, "que");
}
