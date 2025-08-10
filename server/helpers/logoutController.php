<?php

function handleLogout() {
    session_start();

    $_SESSION = [];
    error_log("Session before logout: " . print_r($_SESSION, true));


    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(
            session_name(),
            '',
            time() - 42000,
            $params["path"],
            $params["domain"],
            $params["secure"],
            $params["httponly"]
        );
    }

    session_destroy();

    echo json_encode(["message" => "Logged out successfully"]);
}
