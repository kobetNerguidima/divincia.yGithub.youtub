<?php
// generer_attestation.php
// Assurez-vous d'avoir téléchargé et inclus la bibliothèque FPDF (ou TCPDF)
require('fpdf/fpdf.php'); // Chemin vers votre fichier fpdf.php

include 'config.php';

if (isset($_GET['id_etudiant'])) {
    $id_etudiant = (int)$_GET['id_etudiant'];

    // Récupérer les informations de l'étudiant et de son groupe/filière
    $sql = "SELECT e.cne, e.nom_etudiant, e.prenom_etudiant, e.date_naissance, e.date_inscription,
                   g.nom_groupe, n.nom_niveau, f.nom_filiere
            FROM etudiant e
            JOIN groupe g ON e.id_groupe = g.id_groupe
            JOIN niveau n ON g.id_niveau = n.id_niveau
            JOIN filiere f ON n.id_filiere = f.id_filiere
            WHERE e.id_etudiant = ?";

    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Erreur de préparation de la requête : " . $conn->error);
    }
    $stmt->bind_param("i", $id_etudiant);
    $stmt->execute();
    $result = $stmt->get_result();
    $etudiant = $result->fetch_assoc();

    if ($etudiant) {
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);

        // En-tête de l'attestation
        $pdf->Cell(0, 10, 'Attestation d\'Inscription', 0, 1, 'C');
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(0, 10, 'Année Universitaire : ' . date('Y') . '/' . (date('Y') + 1), 0, 1, 'C');
        $pdf->Ln(20);

        // Informations de l'étudiant
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0, 10, 'Informations de l\'Etudiant :', 0, 1, 'L');
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(0, 10, utf8_decode('Nom Complet : ' . $etudiant['nom_etudiant'] . ' ' . $etudiant['prenom_etudiant']), 0, 1, 'L');
        $pdf->Cell(0, 10, 'CNE : ' . $etudiant['cne'], 0, 1, 'L');
        $pdf->Cell(0, 10, 'Date de Naissance : ' . date('d/m/Y', strtotime($etudiant['date_naissance'])), 0, 1, 'L');
        $pdf->Cell(0, 10, utf8_decode('Filière : ' . $etudiant['nom_filiere']), 0, 1, 'L');
        $pdf->Cell(0, 10, 'Niveau : ' . utf8_decode($etudiant['nom_niveau']), 0, 1, 'L');
        $pdf->Cell(0, 10, 'Groupe : ' . $etudiant['nom_groupe'], 0, 1, 'L');
        $pdf->Cell(0, 10, utf8_decode('Date d\'inscription : ' . date('d/m/Y', strtotime($etudiant['date_inscription']))), 0, 1, 'L');
        $pdf->Ln(20);

        // Déclaration
        $pdf->MultiCell(0, 10, utf8_decode('Le Directeur soussigné atteste que l\'étudiant(e) ' . $etudiant['prenom_etudiant'] . ' ' . $etudiant['nom_etudiant'] . ' (CNE : ' . $etudiant['cne'] . ') est régulièrement inscrit(e) dans l\'établissement en ' . $etudiant['nom_niveau'] . ' de la filière ' . $etudiant['nom_filiere'] . ' pour l\'année universitaire ' . date('Y') . '/' . (date('Y') + 1) . '.'), 0, 'J');
        $pdf->Ln(20);

        // Pied de page
        $pdf->Cell(0, 10, utf8_decode('Fait à Meknès, le ' . date('d/m/Y')), 0, 1, 'R');
        $pdf->Ln(10);
        $pdf->Cell(0, 10, 'Signature du Directeur', 0, 1, 'R');

        $pdf->Output('I', 'Attestation_Inscription_' . $etudiant['cne'] . '.pdf'); // 'I' pour afficher dans le navigateur
    } else {
        echo "Étudiant non trouvé.";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "ID de l'étudiant non spécifié.";
}
?>