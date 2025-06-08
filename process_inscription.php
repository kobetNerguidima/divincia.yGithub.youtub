<?php
// process_inscription.php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer et nettoyer les données du formulaire
    $cne = $conn->real_escape_string($_POST['cne']);
    $nom = $conn->real_escape_string($_POST['nom']);
    $prenom = $conn->real_escape_string($_POST['prenom']);
    $date_naissance = $conn->real_escape_string($_POST['date_naissance']);
    $email = $conn->real_escape_string($_POST['email']);
    $telephone = $conn->real_escape_string($_POST['telephone']);
    $adresse = $conn->real_escape_string($_POST['adresse']);
    $date_inscription = $conn->real_escape_string($_POST['date_inscription']);
    $groupe_id = (int)$_POST['groupe_id'];
    $sous_groupe_id = isset($_POST['sous_groupe_id']) && $_POST['sous_groupe_id'] != '' ? (int)$_POST['sous_groupe_id'] : NULL;
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hacher le mot de passe

    // Préparer la requête SQL pour l'insertion
    $sql = "INSERT INTO etudiant (cne, nom_etudiant, prenom_etudiant, date_naissance, email_etudiant, telephone_etudiant, adresse_etudiant, date_inscription, id_groupe, id_sous_groupe, password)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Erreur de préparation de la requête : " . $conn->error);
    }

    // Binder les paramètres
    // 'sssssssssis' -> string (cne), string (nom), string (prenom), etc.
    $stmt->bind_param("sssssssssis", $cne, $nom, $prenom, $date_naissance, $email, $telephone, $adresse, $date_inscription, $groupe_id, $sous_groupe_id, $password);

    // Exécuter la requête
    if ($stmt->execute()) {
        echo "Nouvel étudiant inscrit avec succès !";
        // Rediriger vers une page de succès ou la liste des étudiants
        header("Location: liste_etudiants.php?success=1");
        exit();
    } else {
        // Gérer les erreurs (ex: CNE ou email déjà existant)
        if ($conn->errno == 1062) { // Code d'erreur pour entrée dupliquée
            echo "Erreur : Le CNE ou l'adresse email est déjà utilisé.";
        } else {
            echo "Erreur lors de l'inscription : " . $stmt->error;
        }
    }

    $stmt->close();
    $conn->close();
} else {
    // Si la page est accédée directement sans méthode POST
    header("Location: inscription_etudiant.php");
    exit();
}
?>