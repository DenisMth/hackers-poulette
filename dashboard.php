<?php

$pdo = new PDO('mysql:host=localhost;dbname=formulaire', 'root', '');


$sql = 'SELECT * FROM users';
$req = $pdo->query($sql);
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-white">
    <div class=" mx-auto p-12 w-1/2 bg-gray-100 rounded-3xl shadow-md mt-9 border-solid border-2 border-sky-500">
        <h2 class="font-serif text-5xl font-bold mb-4 text-center text-gray-800 ">Tableau de bord</h2>
        <?php include 'tableau.php'; ?>
    </div>
</body>
</html>