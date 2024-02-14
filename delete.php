<?php
if (isset($_GET['delete'])) {
    $supprimer = $_GET['delete'];
    $sql_delete = "DELETE FROM users WHERE id = :id";
    $stmt_delete = $pdo->prepare($sql_delete);
    $stmt_delete->execute(array(':id' => $supprimer));
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit; 
}
?>