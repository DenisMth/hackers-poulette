<?php
 include_once 'upload.php';
 include_once 'delete.php';

$sql = 'SELECT * FROM users';
$req = $pdo->query($sql);
?>

<table class="w-full mx-auto border-collapse border border-gray-400 font-serif  text-gray-800 bg-white flex-col justify-center ">
    <thead>
        <tr>
            <th class="p-2 border border-gray-400">ID</th>
            <th class="p-2 border border-gray-400">Nom</th>
            <th class="p-2 border border-gray-400">Prénom</th>
            <th class="p-2 border border-gray-400">Email</th>
            <th class="p-2 border border-gray-400">Photo de profil</th>
            <th class="p-2 border border-gray-400">Description</th>
            <th class="p-2 border border-gray-400">Actions</th>
        </tr>
    </thead>
    <tbody >
    <?php while($row = $req->fetch()) {?>
        <tr>
            <td class="p-2 border border-gray-400"><?php echo $row['id']; ?></td>
            <td class="p-2 border border-gray-400"><?php echo $row['nom']; ?></td>
            <td class="p-2 border border-gray-400"><?php echo $row['prenom']; ?></td>
            <td class="p-2 border border-gray-400"><?php echo $row['email']; ?></td>
            <td class="p-2 border border-gray-400"><img src="<?php echo $row['photo_profil']; ?>" alt="Photo de profil" style="max-width: 100px;"></td>
            <td class="p-2 border border-gray-400"><?php echo $row['description']; ?></td>
            <td class="p-2 border border-gray-400"><a href="?delete=<?php echo $row['id']; ?>">Supprimer</a></td>
        </tr>
    <?php } ?>
    </tbody>
</table>
