<?php
include_once '../database.php';
include_once '../Entities/table_class.php';

$table_name; 
$database = new Database();
$db = $database->getConnection();

$universal = new Universe_class($db, $table_name);  
$columns = $universal->get_column_name(); 
$stmt = $universal->getAll();  
$data_result = $stmt->fetchAll(PDO::FETCH_ASSOC);

$query = $db->query("SHOW TABLES");
$tables = $query->fetchAll(PDO::FETCH_COLUMN);

$primaryKey = $universal->getAllprimaryKeyColumns();

$column_id = $universal->getPrimaryKey();
include '../Front/read_table.php';
?>
