<?php

require_once(dirname(__FILE__) . '/../common/includes/Problems.class.php');

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

    return true;
}

function judge() {
    $request_data = get_request_data();
    if(!is_valid_request($request_data)) {
        http_response_code(400);
    }

    $result = (new Problems())->verify_flag($request_data->problemNo, $request_data->flag);
    if(!$result) {
        http_response_code(400);
    }
}

judge();

?>
