<?php
require_once '../Database.php';
require_once '../Controllers/user_controller.php';
require_once '../Entities/authorization_class.php';

$database = new Database();
$db = $database->getConnection();

$auth = new Auth($db);

// Регистрация
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['form_type'] == 'register_form') {
    $auth->register($_POST['email'], $_POST['password']);
}

// Авторизация
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['form_type'] == 'login_form') {
    $auth->login($_POST['email'], $_POST['password']);
}

?>