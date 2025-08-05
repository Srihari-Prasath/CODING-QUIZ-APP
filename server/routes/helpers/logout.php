<?php


require_once '../../helpers/logoutController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    handleLogout();
} else {
    http_response_code(405);
    echo json_encode(["error" => "Only POST method allowed"]);
}
