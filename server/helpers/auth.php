<?php

session_start();
$ROLE_LEVELS = [
    'student' => 1,
    'faculty' => 2,
    'hod' => 3,
    'vice_principal' => 4,
    'principal' => 5
];

function require_role(array $allowed_roles = []) {
    if (!isset($_SESSION['roll_no'], $_SESSION['role'])) {
        http_response_code(401);
        echo json_encode(["error" => "Unauthorized - not logged in"]);
        exit;
    }
    if (!in_array($_SESSION['role'], $allowed_roles, true)) {
        http_response_code(403);
        echo json_encode(["error" => "Forbidden - insufficient role"]);
        exit;
    }
}

function require_minimum_role(string $min_role) {
    global $ROLE_LEVELS;
    if (!isset($_SESSION['roll_no'], $_SESSION['role'])) {
        http_response_code(401);
        echo json_encode(["error" => "Unauthorized - not logged in"]);
        exit;
    }
    $user_role = $_SESSION['role'];
    $user_level = $ROLE_LEVELS[$user_role] ?? 0;
    $min_level = $ROLE_LEVELS[$min_role] ?? PHP_INT_MAX;
    if ($user_level < $min_level) {
        http_response_code(403);
        echo json_encode(["error" => "Forbidden - insufficient privilege"]);
        exit;
    }
}

function current_role(): ?string {
    return $_SESSION['role'] ?? null;
}

function current_roll_no(): ?string {
    return $_SESSION['roll_no'] ?? null;
}

function has_role(array $roles): bool {
    if (!isset($_SESSION['role'])) return false;
    return in_array($_SESSION['role'], $roles, true);
}

function has_minimum_role(string $min_role): bool {
    global $ROLE_LEVELS;
    if (!isset($_SESSION['role'])) return false;
    $user_level = $ROLE_LEVELS[$_SESSION['role']] ?? 0;
    $min_level = $ROLE_LEVELS[$min_role] ?? PHP_INT_MAX;
    return $user_level >= $min_level;
}
