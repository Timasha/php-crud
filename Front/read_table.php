<?php 
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.html');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Table Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <style>
        .container_2 {
            display: flex;
            justify-content: center;
            margin-top: 50px;
            width: 45.5%;
        }
        .container {
            display: flex;
            justify-content: center;
            margin-top: 50px;
        }
        table {
            width: 80%;
        }
        .table thead {
            background-color: #469597;
            color: white; 
        }
    </style>
</head>
<body>
    <div class="dropdown-container">
        <form method="GET" action="">
        <input type="hidden" name="action" value="read">
            <select name="table" class="form-control" onchange="this.form.submit()">
                <?php foreach ($tables as $table): ?>
                    <option value="<?php echo htmlspecialchars($table); ?>" <?php if ($table_name === $table) echo 'selected'; ?>>
                        <?php echo htmlspecialchars($table); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </form>
    </div>

    <div class="container">
        <table class="table table-striped-columns table-hover table-bordered">
            <thead>
                <tr>
                    <?php foreach ($columns as $column): ?>
                        <th scope="col"><?php echo htmlspecialchars($column); ?></th>
                    <?php endforeach; ?>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($data_result)) {
                    foreach ($data_result as $row) {
                        echo "<tr>";
                        foreach ($columns as $column) {
                            $is_foreign_key = false;
                            foreach ($primaryKey as $key) {
                                if ($key['column_name'] == $column && $key['referenced_table_name'] != null) {
                                    $referenced_table = $key['referenced_table_name'];
                                    $referenced_value = htmlspecialchars($row[$column]);
                                    echo "<td><a href='universe_route.php?action=read&table=$referenced_table'>$referenced_value</a></td>";
                                    $is_foreign_key = true;
                                    break;
                                }
                            }
                            if (!$is_foreign_key) {
                                echo "<td>" . htmlspecialchars($row[$column]) . "</td>";
                            }
                        }
                        echo "<td class='action-buttons'>
                        <a href='../Routing/universe_route.php?table=" . urlencode($table_name) . "&action=update&id=" . urlencode($row[$column_id]) . "' class='btn btn-warning'>Edit</a>
                        <a href='../Routing/universe_route.php?table=" . urlencode($table_name) . "&action=delete&id=" . urlencode($row[$column_id]) . "' class='btn btn-danger'>Delete</a>
                      </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='" . (count($columns) + 1) . "'>No records found.</td></tr>";
                }
                ?>                   
            </tbody>
            <a href="../Routing/universe_route.php?table=<?php echo urlencode($table_name); ?>&action=create" class="btn btn-success">Add New</a>
        </table>
        <br><br>
    </div>

    <!-- Подключение Bootstrap JS и зависимости -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>
