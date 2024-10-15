<?php
include_once '../database.php';
include_once '../Entities/table_class.php';

// Подключаем базу данных
$database = new Database();
$db = $database->getConnection();

// Получаем имя таблицы и ID записи из GET-параметров
$table_name = isset($_GET['table']) ? $_GET['table'] : '';
$id = isset($_GET['id']) ? $_GET['id'] : '';

// Если таблица или ID не указаны, выводим ошибку
if (empty($table_name) || empty($id)) {
    die("Table name and record ID are required.");
}

// Создаем экземпляр универсального класса
$universal = new Universe_class($db, $table_name);
$column_id = $universal->getPrimaryKey();

// Если форма была отправлена (POST-запрос), обрабатываем данные для обновления
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = $_POST;
    unset($data['table']); // Убираем параметр table из POST данных
    unset($data[$column_id]);    // Убираем параметр id из POST данных

    // Пытаемся обновить запись
    if ($universal->update($id, $data)) {
        header("Location: ../Routing/universe_route.php?table=".$table_name."&action=read");
        exit;
    } else {
        $error = "Error updating record.";
    }
}

// Получаем информацию о колонках таблицы (название и тип)
$columns = $universal->get_column_info();

// Получаем текущие данные записи для предзаполнения формы
$stmt = $universal->getById($id);
$record = $stmt->fetch(PDO::FETCH_ASSOC);

// Подключаем представление (шаблон) для редактирования записи
include '../Front/update_table.php';
?>