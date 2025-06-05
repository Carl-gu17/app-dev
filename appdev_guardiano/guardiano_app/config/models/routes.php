<?php

header("Access-Control-Allow-Origin: *");

include_once("./models/get.php");
include_once("./models/post.php");
include_once("./config/database.php");

$db = new Connection();
$pdo = $db->connect();
$get = new Get($pdo);
$post = new Post($pdo);

// Check if 'request' is set in the request
$request = isset($_REQUEST['request']) ? explode("/", $_REQUEST['request']) : [];

$request_method = $_SERVER["REQUEST_METHOD"];

switch ($request_method) {
    case "GET":
        switch ($request[0]) {
            case 'getemployees':
                echo json_encode($get->getemployee());
                break;
            case 'getaccounts':
                echo json_encode($get->getAccounts());
                break;
            case 'getdtr':
                echo json_encode($get->getDtr());
                break;
            default:
                echo json_encode(["error" => "Invalid endpoint."]);
                break;
        }
        break;

    case "POST":
        $data = json_decode(file_get_contents("php://input"));

        // Check if JSON decoding was successful
        if (json_last_error() !== JSON_ERROR_NONE) {
            echo json_encode(["error" => "Invalid JSON input."]);
            break;
        }

        switch ($request[0]) {
            case 'addemployees':
                echo json_encode($post->addEmployee($data));
                break;
            case 'editemployees':
                echo json_encode($post->editEmployee($data));
                break;
            case 'deleteemployees':
                echo json_encode($post->deleteEmployee($data));
                break;
            default:
                echo json_encode(["error" => "Invalid endpoint."]);
                break;
        }
        break;

    default:
        echo json_encode(["error" => "Invalid Method"]);
        break;
}

$pdo = null; // Close the PDO connection
