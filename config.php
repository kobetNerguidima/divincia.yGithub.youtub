<?php
// config.php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root'); // Votre nom d'utilisateur MySQL
define('DB_PASSWORD', ''); // Votre mot de passe MySQL
define('DB_NAME', 'gestion_etudiant'); // Le nom de votre base de données

// Tenter de se connecter à la base de données MySQL
$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Erreur de connexion à la base de données : " . $conn->connect_error);
}
?>