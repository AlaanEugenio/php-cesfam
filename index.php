<?php
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['rut'])) {
    header("Location: index.html"); // Redirigir a la página de inicio de sesión
    exit();
}

$titulo = "Buscar Paciente";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $titulo ?></title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>
<body class="bg-gray-100 font-sans p-4">

    <div class="max-w-4xl mx-auto">
        <!-- Cuadro de búsqueda -->
        <div class="bg-white p-6 rounded-lg shadow-lg mb-6">
            <h3 class="text-xl font-semibold mb-2">Buscar Usuario</h3>
            <div class="flex items-center">
                <input type="text" id="nombre" class="border p-3 rounded-l-lg w-full text-lg" placeholder="Escribe el nombre del paciente">
                <button id="buscar" class="bg-green-500 text-white p-3 rounded-r-lg ml-2 hover:bg-green-600 transition">Buscar</button>
            </div>
        </div>

        <!-- Tabla de registros -->
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h3 class="text-xl font-semibold mb-2">Registros de Ubicación</h3>
            <div class="overflow-x-auto">
                <table class="w-full table-auto border border-gray-300 text-sm">
                    <thead class="bg-gray-200 text-gray-700">
                        <tr class="text-center">
                            <th class="py-2 px-3 border border-gray-300 w-1/6">Nombre</th>
                            <th class="py-2 px-3 border border-gray-300 w-1/12">Fecha</th>
                            <th class="py-2 px-3 border border-gray-300 w-1/12">Hora</th>
                            <th class="py-2 px-3 border border-gray-300 w-1/12">Hora 2° Llamado</th>
                            <th class="py-2 px-3 border border-gray-300 w-1/12">Piso</th>
                            <th class="py-2 px-3 border border-gray-300 w-1/12">Box</th>
                            <th class="py-2 px-3 border border-gray-300 w-1/6">Estado</th>
                            <th class="py-2 px-3 border border-gray-300 w-1/6">Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="tabla-registros" class="text-center">
                        <!-- Los datos se llenan con AJAX -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#buscar').click(function() {
                var nombre = $('#nombre').val().trim();
                if (nombre === '') {
                    alert('Por favor, ingresa un nombre.');
                    return;
                }

                $.ajax({
                    url: 'buscar.php',
                    type: 'POST',
                    data: { nombre: nombre },
                    success: function(response) {
                        $('#tabla-registros').html(response);
                    },
                    error: function() {
                        alert('Error al obtener los datos.');
                    }
                });
            });

            // Llamar
            $(document).on('click', '.llamar-btn', function() {
                var id = $(this).data('id');
                $('#estado-' + id).text('Llamando');
            });

            // Repetir llamada
            $(document).on('click', '.repetir-btn', function() {
                var id = $(this).data('id');
                var horaActual = new Date().toLocaleTimeString();
                $('#hora-' + id).text(horaActual);
                $('#estado-' + id).text('Repitiendo llamada');
            });

            // No se presentó
            $(document).on('click', '.no-se-presento-btn', function() {
                var id = $(this).data('id');
                $('#estado-' + id).text('No se presentó');
            });
        });
    </script>

</body>
</html>
