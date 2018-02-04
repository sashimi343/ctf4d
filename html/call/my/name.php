<?php

$my_name = 'Mitsuha';

function respond_ng($message) {
    $response_data = array(
        'status' => 'NG',
        'message' => $message
    );

    respond($response_data);
}

function respond_ok() {
    $response_data = array(
        'status' => 'OK',
        'message' => 'Exactly! You are API master!',
        'flag' => '/REST/ful/API?'
    );

    respond($response_data);
}

function respond($response_data) {
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    echo json_encode($response_data);

    exit();
}

// Request method is not POST
if($_SERVER['REQUEST_METHOD'] !== 'POST') {
    respond_ng('You should use the XXXX method instead of ' . $_SERVER['REQUEST_METHOD'] .' method when you send sensitive data.');
}

// Request method is POST, but Content-Type is not 'application/json'
if($_SERVER['CONTENT_TYPE'] !== 'application/json') {
    // Request does not contain 'name'
    if(!isset($_POST['name'])) {
        respond_ng("Please call my 'name', Mr. Taki.");
    }

    // Requested (called) name is wrong
    if($_POST['name'] !== $my_name) {
        respond_ng("My name is '$my_name', Mr. Taki.");
    }

    // Requested (called) name is correct, but Content-Type is not 'application/json'
    respond_ng('Almost OK. You should call my name in XXXX format, not form data.');
}

// Request data exists, and Content-Type is 'application/json'
$request_raw_data = file_get_contents('php://input');
$request_json = json_decode($request_raw_data);

// JSON format is invalid
if($request_json === null) {
    respond_ng('Request data is invalid. Please send correct JSON data.');
}

// Requested does not contain 'name'
if(!isset($request_json->name)) {
    respond_ng("Please call my 'name', Mr. Taki.");
}

// Requested (called) name is wrong
if($request_json->name !== $my_name) {
    respond_ng("My name is '$my_name', Mr. Taki.");
}

respond_ok();

?>
