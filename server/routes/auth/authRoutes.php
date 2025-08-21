<?php


$route = $_GET['route'] ?? '';

switch ($route) {

    case 'register':
        if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
            require_once '../../controllers/auth/updatePassword.php';
            exit;
        }
        break; 


          case 'register-student':
        if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
            require_once '../../controllers/auth/student/studentRegister.php';
            exit;
        }
        break;

    case 'login':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            require_once __DIR__ . '/../../controllers/auth/loginController.php';
            exit;
        }
        break;


    case 'get-user-by-roll':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            require_once '../../controllers/auth/getUserByRollController.php';
        }
        break; 

          case 'get-user-by-roll-student':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            require_once '../../controllers/auth/student/getUserByRollController.php';
        }
        break; 

         case 'get-user-by-roll-login':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            require_once '../../controllers/auth/getuserbylogin.php';
        }
        break;


    case 'forgot_password':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            require_once __DIR__ . '/../../controllers/auth/forgot_password.php';
            exit;
        }
        break;

    case 'reset_password':

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            require_once __DIR__ . '/../../controllers/auth/reset_password.php';
            exit;
        }
        break;
        require_once __DIR__ . '/../../controllers/auth/reset_password.php';
        exit;

    case 'verify_otp':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            require_once __DIR__ . '/../../controllers/auth/verify_otp.php';
            exit;
        }
        break;



    default:
        http_response_code(404);
        echo json_encode(["error" => "Route not found"]);
        break;
}
