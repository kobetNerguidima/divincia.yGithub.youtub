<?php
$servername="locahost";
$username="root";
$passsword=""
$dbname="estm"
// Connexion à la base
conn = new mysqli("localhost", "utilisateur", "motdepasse", "estm");

// Vérifie la connexion
if (conn->connect_error) {
  die("Connexion échouée: " . conn->connect_error);


// Récupère les données du formulairenom = _POST['nom'];email = _POST['email'];

// Insertion des donnéessql = "INSERT INTO utilisateurs (nom, email) VALUES ('nom', 'email')";
conn->query(sql);

$conn->close();
?>