<?php
include_once '../database.php';
include_once '../Entities/table_class.php';

$table_name = isset($_GET['table']) ? $_GET['table'] : '';

if (empty($table_name)) {
    die("Table name is required.");
}

$database = new Database();
$db = $database->getConnection();

// Создаем экземпляр универсального класса
$universal = new Universe_class($db, $table_name);
$column_id = $universal->getPrimaryKey();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = $_POST;

    // Удаляем из данных поле table, т.к. оно нам не нужно для вставки
    unset($data['table']);

    // Пытаемся создать новую запись
    if ($universal->create($data)) {
        // Если создание прошло успешно, перенаправляем на страницу просмотра записей
        header("Location: http://localhost/php-crud/Routing/universe_route.php?table=".$table_name."&action=read");
        exit;
    } else {
        // В случае ошибки создаем сообщение
        $error = "Error creating record";
    }
}

// Получаем список полей таблицы
$columns = $universal->get_column_info();

include_once '../Front/create_table.php';
?>