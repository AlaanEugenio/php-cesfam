<?php
$titulo = "Hola ";
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $titulo ?></title>

    <!-- CDN de Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>

<body class="bg-gray-100 font-sans">

    <!-- Cuadro de búsqueda de nombre sin márgenes ni separación -->
    <div class="flex justify-center items-center mb-4">
        <div class="bg-white p-6 rounded-lg shadow-lg w-1/2 mb-0 mt-0"> <!-- Sin márgenes ni separación -->
            <h3 class="text-xl font-semibold mb-2">Buscar Paciente</h3>
            <div class="flex items-center">
                <input type="text" id="nombre" class="border p-3 rounded-l-lg w-full text-lg" placeholder="Escribe el nombre del paciente">
                <button id="buscar" class="bg-green-500 text-white p-3 rounded-r-lg ml-2 hover:bg-green-600 transition">Buscar</button>
            </div>
        </div>
    </div>

    <!-- Cuadro de la tabla de registros sin márgenes ni separación -->
    <div class="flex justify-center items-center">
        <div class="bg-white p-6 rounded-lg shadow-lg w-1/2 mb-0 mt-0"> <!-- Sin márgenes ni separación -->
            <h3 class="text-xl font-semibold mb-2">Registros de Pacientes</h3>
            <table class="w-full table-auto">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="py-2 px-4 text-left">#</th>
                        <th class="py-2 px-4 text-left">Nombre</th>
                        <th class="py-2 px-4 text-left">Hora</th>
                        <th class="py-2 px-4 text-left">Acciones</th>
                    </tr>
                </thead>
                <tbody id="tabla-registros">
                    <!-- Las filas de la tabla de pacientes se agregarán dinámicamente aquí -->
                </tbody>
            </table>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            let contador = 1;

            $('#buscar').click(function() {
                var nombre = $('#nombre').val();
                var hora = new Date().toLocaleTimeString();

                if (nombre !== '') {
                    // Crear una nueva fila para la tabla de pacientes
                    var nuevaFila = `
                        <tr>
                            <td class="py-2 px-4">${contador}</td>
                            <td class="py-2 px-4">${nombre}</td>
                            <td class="py-2 px-4">${hora}</td>
                            <td class="py-2 px-4">Acción</td>
                        </tr>
                    `;
                    // Agregar la nueva fila a la tabla
                    $('#tabla-registros').append(nuevaFila);

                    // Incrementar el contador para la siguiente fila
                    contador++;

                    // Limpiar el campo de texto
                    $('#nombre').val('');
                } else {
                    alert('Por favor, ingresa un nombre.');
                }
            });
        });
    </script>

</body>

</html>