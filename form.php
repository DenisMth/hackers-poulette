<?php
include_once 'upload.php';
?>
<?php
$pdo = new PDO('mysql:host=localhost;dbname=formulaire', 'root', '');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Vérifier si tous les champs 
    if (isset($_POST['nom'], $_POST['prenom'], $_POST['email'], $_FILES['photo_profil'], $_POST['description'])) {
        // Récupérer les valeurs 
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $email = $_POST['email'];
        $description = $_POST['description'];
        
        // Gérer le fichier envoyé
        $file = $_FILES['photo_profil'];
        $fileName = $file['name'];
        $fileTmpName = $file['tmp_name'];
        $fileSize = $file['size'];
        $fileError = $file['error'];

        // Vérifier si aucun problème n'est survenu 
        if ($fileError === 0) {
            // Vérifier si le fichier est une image
            $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
            $allowedExtensions = array('jpg', 'jpeg', 'png', 'gif');
            if (in_array($fileExt, $allowedExtensions)) {
                // Vérifier la taille du fichier (max 2MB)
                if ($fileSize <= 2 * 1024 * 1024) {
                    // Déplacer le fichier téléchargé vers un emplacement de stockage
                    $fileDestination = 'uploads/' . $fileName;
                    move_uploaded_file($fileTmpName, $fileDestination);

                    // Préparer la requête 
                    $sql = "INSERT INTO users (nom, prenom, email, photo_profil, description) VALUES (:nom, :prenom, :email, :photo_profil, :description)";
                    $stmt = $pdo->prepare($sql);

                    // Exécuter la requête
                    $stmt->execute(array(
                        ':nom' => $nom,
                        ':prenom' => $prenom,
                        ':email' => $email,
                        ':photo_profil' => $fileDestination,
                        ':description' => $description
                    ));

                    if ($stmt->rowCount() > 0) {
                        echo '<script>alert("Inscription réussie !");</script>';
                    } else {
                        echo '<script>alert("Une erreur s\'est produite lors de l\'inscription. Veuillez réessayer.");</script>';
                    }
                } else {
                    echo '<script>alert("Le fichier est trop volumineux. Veuillez choisir un fichier de moins de 2MB.");</script>';
                }
            } else {
                echo '<script>alert("Ce type de fichier n\'est pas autorisé. Veuillez choisir une image.");</script>';
            }
        } else {
            echo '<script>alert("Une erreur s\'est produite lors du téléchargement du fichier.");</script>';
        }
    } else {
        echo '<script>alert("Veuillez remplir tous les champs du formulaire.");</script>';
    }
}

if (isset($_GET['delete'])) {
    $supprimer = $_GET['delete'];
    $sql_delete = "DELETE FROM users WHERE id = :id";
    $stmt_delete = $pdo->prepare($sql_delete);
    $stmt_delete->execute(array(':id' => $supprimer));
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit; // Ajout de exit pour arrêter l'exécution
}

// Récupérer les données 
$sql = 'SELECT * FROM users';
$req = $pdo->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Inscription</title>
    <link rel="stylesheet" href="css/basics.css" media="screen" title="no title" charset="utf-8">
</head>
<body>
<h2>Liste des utilisateurs</h2>

<table border="1">
    <thead>
    <tr>
        <th>ID</th>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Email</th>
        <th>Photo de profil</th>
        <th>Description</th>
    </tr>
    </thead>
    <tbody>
    <?php while($row = $req->fetch()) {?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['nom']; ?></td>
            <td><?php echo $row['prenom']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><img src="<?php echo $row['photo_profil']; ?>" alt="Photo de profil" style="max-width: 100px;"></td>
            <td><?php echo $row['description']; ?></td>
            <td><a href="?delete=<?php echo $row['id']; ?>">Supprimer</a></td>
        </tr>
    <?php } ?>
    </tbody>
</table>

<h1>Inscription</h1>
<form action="" method="post" enctype="multipart/form-data">
    <div>
        <label for="nom">Nom</label>
        <input type="text" name="nom" id="nom" required minlength="2" maxlength="255">
    </div>

    <div>
        <label for="prenom">Prénom</label>
        <input type="text" name="prenom" id="prenom" required minlength="2" maxlength="255">
    </div>

    <div>
        <label for="email">Adresse email</label>
        <input type="email" name="email" id="email" required minlength="2" maxlength="255">
    </div>

    <div>
        <label for="photo_profil">Photo de profil</label>
        <input type="file" name="photo_profil" id="photo_profil" accept="image/jpeg, image/png, image/gif">
    </div>

    <div>
        <label for="description">Description</label>
        <textarea name="description" id="description" required minlength="2" maxlength="1000"></textarea>
    </div>

    <button type="submit" name="button">Soumettre</button>
</form>
</body>
</html>