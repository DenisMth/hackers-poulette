# Formulaire d'inscription en php

Ce projet est un formulaire d'inscription réalisé en PHP avec une vérification côté serveur(php) et côté client(JavaScript). Il permet aux utilisateurs de s'inscrire en fournissant leur nom, prénom, adresse e-mail, photo de profil et une brève description.

Fonctionnalités:
Validation côté serveur: Les données sont validées côté serveur pour s'assurer de leur intégrité et sécurité.
Validation côté client: Une validation côté client est mise en place pour améliorer l'expérience utilisateur et réduire les erreurs de saisie.
Téléchargement de fichiers: Les utilisateurs peuvent télécharger leur photo de profil, avec des restrictions sur le type et la taille du fichier.
Stockage des données: Les informations des utilisateurs sont stockées dans une base de données MySQL après validation.
Captcha: Un captcha est utilisé pour empêcher les soumissions automatisées par des bots, renforçant ainsi la sécurité du formulaire d'inscription.

Configuration requise:
Serveur web (Apache, Nginx, etc.)
PHP 5.6 ou version ultérieure
MySQL 5.6 ou version ultérieure

Installation:
Clonez le dépôt Git ou téléchargez les fichiers du projet dans le répertoire de votre serveur web.
Créez une base de données MySQL nommée "formulaire" (ou choisissez un nom différent et mettez à jour le fichier upload.php).
Importez le schéma de la base de données à partir du fichier schema.sql dans votre base de données.
Assurez-vous que le répertoire uploads a les permissions nécessaires pour que PHP puisse y écrire.
Configurez les informations de connexion à la base de données dans les fichiers index.php et dashboard.php.
Lancez votre serveur web et accédez au formulaire via votre navigateur.

Utilisation:
Accédez au formulaire via votre navigateur.
Remplissez les champs requis (nom, prénom, adresse e-mail, photo de profil, description).
Cliquez sur le bouton "Soumettre" pour envoyer le formulaire.
Les données seront validées côté serveur et côté client.
Si toutes les validations sont réussies, les données seront enregistrées dans la base de données et un message de succès s'affichera.
Vous pouvez accéder au tableau de bord pour voir les inscriptions enregistrées et effectuer des actions supplémentaires si nécessaire.

Développeurs:
[Winona Dehaut](https://github.com/winonadht)
[Denis Mathieu](https://github.com/DenisMth)


