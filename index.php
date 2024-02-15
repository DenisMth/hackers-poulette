<?php
include_once 'upload.php';

$pdo = new PDO('mysql:host=localhost;dbname=formulaire', 'root', '4sgardLOCI');

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
                // Vérifier la taille du fichier
                if ($fileSize <= 2 * 1024 * 1024) {
                    // emplacement de stockage
                    $fileDestination = 'uploads/' . $fileName;
                    move_uploaded_file($fileTmpName, $fileDestination);

                    //  requête 
                    $sql = "INSERT INTO users (nom, prenom, email, photo_profil, description) VALUES (:nom, :prenom, :email, :photo_profil, :description)";
                    $stmt = $pdo->prepare($sql);

                    // Exécuter requête
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


?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    
</head>
<body class="bg-white">
    <div class="container mx-auto p-8 max-w-screen-md bg-gray-100 rounded-3xl shadow-md mt-9 border-solid border-2 border-sky-500">
        <h2 class="font-serif text-5xl font-bold mb-4 text-center text-gray-800 ">Formulaire</h2>

        <form action="" method="post" enctype="multipart/form-data">
    <div class=" flex flex-row space-x-16 ">
            <div class="mb-4">
                <label for="nom" class=" font-serif italic block text-lg font-medium  text-gray-800" >Nom:</label>
                <input type="text" name="nom" id="nom" class="shadow-md w-80 rounded border border-gray-300 p-2" required minlength="2" maxlength="255">
            </div>

            <div class="mb-4">
                <label for="prenom" class="font-serif italic block text-lg font-medium text-gray-800">Prénom:</label>
                <input type="text" name="prenom" id="prenom" class="shadow-md w-80 rounded border border-gray-300 p-2" required minlength="2" maxlength="255">
            </div>
     </div>
            <div class="mb-4">
                <label for="email" class="font-serif italic block text-lg font-medium  text-gray-800">Adresse email:</label>
                <input type="email" name="email" id="email" class="shadow-md w-full  rounded border border-gray-300 p-2" required minlength="2" maxlength="255">
            </div>

            <div class="mb-4">
                <label for="photo_profil" class="font-serif italic block text-lg font-medium text-gray-800">Photo de profil:</label>
                <input type="file" name="photo_profil" id="photo_profil" class=" font-serif rounded border shadow-md w-42 bg-white" accept="image/jpeg, image/png, image/gif">
            </div>

            <div class="mb-4">
                <label for="description" class="font-serif italic block text-lg font-medium text-gray-800">Ma description:</label>
                <textarea name="description" id="description" class="shadow-md w-full rounded border border-gray-300 p-2" required minlength="2" maxlength="1000"></textarea>
            </div>
           <div class="flex justify-center">
            <button type="submit" name="button" class=" font-serif w-40 bg-gray-900 text-white px-4 py-2 rounded hover:bg-gray-500 ">Soumettre</button>
</div>
        </form>
</div>
</body>
</html>
