<?php
$table = isset($_GET['table']) ? $_GET['table'] : '';
$action = isset($_GET['action']) ? $_GET['action'] : 'view';
$id = isset($_GET['id']) ? $_GET['id'] : '';

$tables = array('managers', 'delivery_company', 'pizza_types', 'pizza_masters', 'pizza_delivery_boys', 'users');

if (in_array($table, $tables)){
    if ($action == 'read'){
        $table_name = $table;
        include '../Controllers/controller_read.php';
    }
    if ($action == 'create'){
        $table_name = $table;
        include '../Controllers/controller_create.php';
    }
    if($action == 'update'){
        $table_name = $table;   
        $id_table = $id;
        include '../Controllers/controller_edit.php';
    }
    if($action=='delete'){
        $table_name = $table;   
        $id_table = $id;
        include '..//Controllers/controller_delete.php';
    }
}else{
    echo "Неправильное название таблицы.";
    exit;
}
?>