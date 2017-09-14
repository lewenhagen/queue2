<?php


function getJSONFile($path)
{
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


/**
 * checkForDuplicates
 * Checks if student already in queue.
 * params: $what
**/
function checkForDuplicates($data, $what, $lookFor) {
    // $data = getJSONFile();
    return in_array($lookFor, array_column($data, $what));
}



function addPlaceToJson() {
    $data = getJSONFile("/db/students_in_queue.json");
    $counter = 1;
    foreach ($data as $item) {
        $item["place"] = $counter;
        $counter++;
    }
    writeJSON($data, "../db/students_in_queue.json");
}



function addToJSON($data, $name, $exercise) {
    $data[] = array(
        "place" => count($data) + 1,
        "name" => $name,
        "exercise" => $exercise,
        "time" => strval(date("H:i:s"))
    );
    // echo "data after\n";
    // var_dump ($data);

    // $result = json_encode($data);
    //
    // if (file_put_contents('../db/students_in_queue.json', $result) === false){
    //     die('unable to write queue');
    // }
    // unset($result);
    writeJSON($data, "/db/students_in_queue.json");
}



function writeJSON($data, $path) {
    $result = json_encode($data);
    // echo $_SERVER["DOCUMENT_ROOT"] . "$path";
    // die();
    if (file_put_contents($_SERVER["DOCUMENT_ROOT"] . "$path", $result) === false){
        die('unable to write queue');
    }
    unset($result);
}



function printQueue()
{
    $data = getJSONFile("/db/students_in_queue.json");
    $html = "";

    foreach ($data as $item) {
        $html .= "<tr><td>" . $item["place"] . "</td>";
        $html .= "<td>" . $item["name"] . "</td>";
        $html .= "<td>" . $item["exercise"] . "</td>";
        $html .= "<td>" . $item["time"] . "</td></tr>";
    }
    return $html;
}


function addHelpedStudent($thestud)
{
    $data = getJSONFile("/db/helped_students.json");
    // echo "ja";
    // die();
    array_unshift($data, array(
        "place" => count($data) + 1,
        "name" => $thestud["name"],
        "exercise" => $thestud["exercise"],
        "time" => $thestud["time"]
    ));

    writeJSON($data, "/db/helped_students.json");
}
