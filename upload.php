<?php
// Chemin 'uploads'
$uploadsDirectory = __DIR__ . '/uploads';

if (!file_exists($uploadsDirectory)) {
    // Créer le répertoire uploads
    if (!mkdir($uploadsDirectory, 0777, true)) {
        
        die("Erreur lors de la création du répertoire 'uploads'");
    }
    echo "Répertoire 'uploads' créé avec succès";
} 
?>