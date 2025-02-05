<?php 
include 'cnx.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'] ?? '';

    $sql = "SELECT l.ID, l.Nombre_usuario, l.fecha, l.llamada_uno AS hora, 
                   u.Piso, u.Box 
            FROM Llamadas l
            JOIN Ubicacion u ON l.id_ubicacion = u.ID
            WHERE l.Nombre_usuario LIKE :nombre";

    $stmt = $bd->prepare($sql);
    $stmt->execute(['nombre' => "%$nombre%"]);

    if ($stmt->rowCount() > 0) {
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr class='border border-gray-300'>
                    <td class='py-2 px-3'>{$row['Nombre_usuario']}</td>
                    <td class='py-2 px-3'>{$row['fecha']}</td>
                    <td class='py-2 px-3'>{$row['hora']}</td>
                    <td id='hora-{$row['ID']}' class='py-2 px-3'></td>
                    <td class='py-2 px-3'>{$row['Piso']}</td>
                    <td class='py-2 px-3'>{$row['Box']}</td>
                    <td id='estado-{$row['ID']}' class='py-2 px-3'>Pendiente</td>
                    <td class='py-2 px-3'>
                        <button class='llamar-btn bg-green-500 text-white px-2 py-1 rounded hover:bg-green-600 transition' data-id='{$row['ID']}'>Llamar</button>
                        <button class='repetir-btn bg-blue-500 text-white px-2 py-1 rounded hover:bg-blue-600 transition' data-id='{$row['ID']}'>Repetir</button>
                        <button class='no-se-presento-btn bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600 transition' data-id='{$row['ID']}'>No se presentó</button>
                    </td>
                </tr>";
        }
    }
}
?>
