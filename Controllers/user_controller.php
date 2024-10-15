<?php
class User {
    private $conn;
    private $table_name = "users";

    public $id;
    public $login;
    public $salt_password;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Регистрация пользователя
    public function register() {
        $query = "INSERT INTO " . $this->table_name . " (login, salt_password) VALUES (:login,:salt_password)";
        $stmt = $this->conn->prepare($query);

        // Хешируем пароль
        $this->salt_password = password_hash($this->salt_password, PASSWORD_DEFAULT);

        // Связываем параметры
        $stmt->bindParam(':login', $this->login);
        $stmt->bindParam(':salt_password', $this->salt_password);

        if ($stmt->execute()) {

        echo 'D1';
            return true;
        }

        return false;
    }

    // Авторизация пользователя
    public function login() {
        $query = "SELECT id, salt_password FROM " . $this->table_name . " WHERE login = :login";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':login', $this->login);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Проверяем пароль
        if ($user && password_verify($this->salt_password, $user['salt_password'])) {
            $this->id = $user['id'];
            return true;
        }
        return false;
    }
}
?>