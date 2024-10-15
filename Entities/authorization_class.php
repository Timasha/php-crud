<?php
class Auth {
    private $db;
    private $user;

    public function __construct($db) {
        $this->db = $db;
        $this->user = new User($this->db);
    }

    public function register($username, $password) {
        $this->user->login = $username;
        $this->user->salt_password = $password;

        try {
            if ($this->user->register()) {
                echo "Регистрация прошла успешно!";
                header('Location: http://localhost/php-crud/Front/login.html');
            } else {
                echo "Ошибка регистрации.";
            }
        }catch (Exception $e) {
            echo "Ошибка: " . $e->getMessage();
        }
    }

    public function login($username, $password) {
        $this->user->login = $username;
        $this->user->salt_password = $password;

        if ($this->user->login()) {
            session_start();
            $_SESSION['user_id'] = $this->user->id;
            echo "Авторизация успешна!";
            header('Location: http://localhost/php-crud/Routing/universe_route.php?table=pizza_delivery_boys&action=read');
        } 
        else 
        {
            echo "Неверные данные для авторизации.";
        }
    }
}
?>