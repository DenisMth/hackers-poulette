<?php
// Chemin du répertoire 'uploads'
$uploadsDirectory = '/uploads';

// Vérifier si le répertoire n'existe pas déjà
if (!file_exists($uploadsDirectory)) {
    // Créer le répertoire 'uploads'
    if (!mkdir($uploadsDirectory, 0777, true)) {
        // Si la création du répertoire échoue, afficher un message d'erreur
        die("Erreur lors de la création du répertoire 'uploads'");
    }
    echo "Répertoire 'uploads' créé avec succès";
} else {
    echo "Le répertoire 'uploads' existe déjà";
}
?>