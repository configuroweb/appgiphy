<!DOCTYPE html>
<html lang="es">
<!-- Establece el idioma del documento, importante para la accesibilidad y el SEO. -->

<head>
    <meta charset="UTF-8">
    <!-- Define la codificación de caracteres para el contenido. -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Asegura una visualización adecuada y una experiencia de usuario óptima en dispositivos móviles. -->
    <title>GIFs de Giphy</title>
    <!-- Título de la página, se muestra en la pestaña del navegador. -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@1/css/pico.min.css">
    <!-- Incluye Pico CSS, un framework CSS minimalista, para estilos básicos. -->
    <link rel="stylesheet" href="style.css">
    <!-- Enlace a la hoja de estilos personalizada para estilos específicos de la página. -->
    <link rel="shortcut icon" href="./faviconconfiguroweb.png" type="image/x-icon">
    <!-- Favicon personalizado para la pestaña del navegador. -->
</head>

<body>
    <!-- Inicio del cuerpo del documento. -->

    <!-- Script PHP para verificar si se ha realizado una búsqueda. -->
    <?php $searchPerformed = isset($_GET['search']) && !empty($_GET['search']); ?>

    <main class="container">
        <!-- Contenedor principal para el contenido de la página. -->
        <h1>Buscador de GIFs en Giphy</h1>
        <!-- Título principal de la página. -->

        <!-- Formulario de búsqueda para enviar términos de búsqueda mediante GET. -->
        <form action="" method="GET">
            <input type="text" name="search" placeholder="Escribe algo divertido..." required>
            <!-- Campo de texto para la entrada del usuario. -->
            <button type="submit">Buscar</button>
            <!-- Botón para enviar el formulario. -->
        </form>

        <!-- Bloque condicional para mostrar un GIF destacado si no se ha realizado una búsqueda. -->
        <?php if (!$searchPerformed) : ?>
            <div class="gif-destacado">
                <!-- Contenedor para el GIF destacado. -->
                <a href="https://www.configuroweb.com/"><img src="configuroweb.gif" alt="GIF destacado"></a>
                <!-- Enlace y imagen del GIF destacado. -->
            </div>
        <?php endif; ?>

        <div class="gif-container">
            <?php
            if (isset($_GET['search'])) {
                $apiKey = 'tu_api_key_aquí';
                $search = urlencode($_GET['search']);
                $url = "https://api.giphy.com/v1/gifs/search?api_key=$apiKey&q=$search&limit=40";

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                $output = curl_exec($ch);
                curl_close($ch);

                $data = json_decode($output, true);
                if (!empty($data['data'])) {
                    foreach ($data['data'] as $gif) {
                        $originalUrl = $gif['images']['original']['url'];
                        echo "<div class='gif' onclick='openModal(\"" . $gif['images']['fixed_height']['url'] . "\", \"" . $originalUrl . "\")'><img src='" . $gif['images']['fixed_height']['url'] . "' alt='GIF'></div>";
                    }
                } else {
                    echo "<p>No se encontraron resultados. Intenta con otro término de búsqueda.</p>";
                }
            }
            ?>
        </div>

    </main>

    <!-- Modal para visualizar el GIF en detalle. -->
    <div id="gifModal" class="modal">
        <span id="closeModal" class="close">&times;</span>
        <!-- Botón para cerrar el modal. -->
        <img class="modal-content" id="img01">
        <!-- Contenido de imagen del modal. -->
        <div id="modalInfo">
            <!-- Información adicional y enlace de descarga en el modal. -->
            ...
        </div>
    </div>

    <script src="script.js"></script>
    <!-- Enlace al archivo JavaScript para funcionalidades interactivas. -->
</body>

</html>