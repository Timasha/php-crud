<?php
// Подключение необходимых файлов
include_once '../database.php';
include_once '../Entities/table_class.php';

if (empty($table_name) || empty($id)) {
    echo "Ошибка: Не указаны имя таблицы или идентификатор записи.";
    exit;
}

try {
    // Подключаемся к базе данных
    $database = new Database();
    $db = $database->getConnection();

    // Создаем экземпляр универсального класса
    $universal = new Universe_class($db, $table_name);

    // Выполняем удаление записи
    if ($universal->delete($id)) {
        // Перенаправляем на страницу с таблицей после успешного удаления
        header("Location: ../Routing/universe_route.php?table=" . urlencode($table_name) . "&action=read");
        exit;
    } else {
        echo "Ошибка: Не удалось удалить запись.";
    }
} catch (Exception $e) {
    echo "Ошибка: " . $e->getMessage();
}
?>

?>