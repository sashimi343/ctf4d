<?php

require('./flags.php');

function get_request_data() {
    $json_string = file_get_contents('php://input');
    $request_data = json_decode($json_string); 

    return $request_data;
}

function is_valid_request($request_data) {
    if(!isset($request_data->flag) || !is_string($request_data->flag)) {
        return false;
    }

    if(!isset($request_data->problemNo) || !is_numeric($request_data->problemNo)) {
        return false;
    }

    if(!array_key_exists($request_data->problemNo, FLAGS)) {
        return false;
    }

    return true;
}

function judge() {
    $request_data = get_request_data();
    if(!is_valid_request($request_data)) {
        http_response_code(400);
    }

    $correctFlag = 'FLAG{' . FLAGS[$request_data->problemNo] . '}';
    if($request_data->flag !== $correctFlag) {
        http_response_code(400);
    }
}

judge();

?>
