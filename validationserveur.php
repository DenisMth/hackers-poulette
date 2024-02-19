<?php 

   
    if (!empty($nom['nom']) && strlen($nom['nom']) >= 2 && strlen($nom['nom']) <= 255) {
        echo $nom['nom'];
    } else {
        echo "Nom invalide";
    }

    if (!empty($prenom['prenom']) && strlen($prenom['prenom']) >= 2 && strlen($prenom['prenom']) <= 255) {
    echo !empty($prenom['prenom']) ? $prenom['prenom'] : "Prénom invalide"; 
    }
   
    echo !empty($email['email']) ? $email['email'] : "Email invalide"; 

    if (!empty($photo_profil['photo_profil'])) {
        echo '<img src="'.$photo_profil['photo_profil'].'" alt="Photo de profil" style="max-width: 100px;">';
    } else {
        echo "Photo de profil invalide/manquante";
    }

    echo !empty($description['description']) ? $description['description'] : "Description invalide"; 

 
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
        }
    }
}

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
?>