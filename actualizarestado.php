<?php
include 'cnx.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'] ?? '';
    $estado = $_POST['estado'] ?? '';

    // Validar que el estado sea uno de los permitidos
    $estadosPermitidos = ['Llamando', 'Repetir llamado', 'No se presentó'];

    if (!in_array($estado, $estadosPermitidos)) {
        echo 'error';
        exit;
    }

    $sql = "UPDATE Llamadas SET estado = :estado WHERE ID = :id";
    $stmt = $bd->prepare($sql);

    if ($stmt->execute(['estado' => $estado, 'id' => $id])) {
        echo 'ok';
    } else {
        echo 'error';
    }
}
?>
