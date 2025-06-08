<?php
// get_data.php
include 'config.php';
header('Content-Type: application/json');

$type = $_GET['type'] ?? '';
$data = [];

switch ($type) {
    case 'niveau':
        $filiere_id = (int)($_GET['filiere_id'] ?? 0);
        if ($filiere_id) {
            $stmt = $conn->prepare("SELECT id_niveau as id, nom_niveau as name FROM niveau WHERE id_filiere = ?");
            $stmt->bind_param("i", $filiere_id);
            $stmt->execute();
            $result = $stmt->get_result();
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            $stmt->close();
        }
        break;
    case 'groupe':
        $niveau_id = (int)($_GET['niveau_id'] ?? 0);
        if ($niveau_id) {
            $stmt = $conn->prepare("SELECT id_groupe as id, nom_groupe as name FROM groupe WHERE id_niveau = ?");
            $stmt->bind_param("i", $niveau_id);
            $stmt->execute();
            $result = $stmt->get_result();
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            $stmt->close();
        }
        break;
    case 'sous_groupe':
        $groupe_id = (int)($_GET['groupe_id'] ?? 0);
        if ($groupe_id) {
            $stmt = $conn->prepare("SELECT id_sous_groupe as id, nom_sous_groupe as name FROM sous_groupe WHERE id_groupe = ?");
            $stmt->bind_param("i", $groupe_id);
            $stmt->execute();
            $result = $stmt->get_result();
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            $stmt->close();
        }
        break;
    // Ajoutez d'autres cas si vous avez besoin de récupérer d'autres types de données
}

echo json_encode($data);
$conn->close();
?>