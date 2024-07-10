<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Publicidad</title>
    <!-- Bootstrap CSS -->
    <!-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <style>

.image-container {
        position: relative;
        /*transition: all 1s ease-in-out;*/
        width: 150%; /* Ajusta el ancho según sea necesario */
        max-width: 600px; /* Ancho máximo */
        height:  auto; /*400px;  Altura fija para las imágenes */
        overflow: hidden;
        margin: 0 auto; /* nuevo */
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .image-container img {
        width: 95%; /* Ajusta el tamaño de la imagen al contenedor */
        height: auto; /* Asegúrate de que la imagen llene el contenedor */
        object-fit: cover; /* Ajusta cómo se escala la imagen */
    }
   /* .hidden {
        display: none;
    } */
    .overlay-text {
        position: absolute;
        bottom: 10%;
        left: 5%;
        color: white;
        background-color: rgba(0, 0, 0, 0.5);
        padding: 10px;
        z-index: 10; /* Asegura que el texto esté encima de la imagen */
    }
    </style>
</head>

<div id="imageContainer" class="image-container">
        <div class="overlay-text" id="overlayText">Texto sobre la imagen</div>
        <img id="adImage" src="./Publicidad/Copa_america.jpg" alt="Publicidad" class="img-fluid">
    </div>

    <script>
        $(document).ready(function(){
            // Array de imágenes
            var images = [
                {src: './Publicidad/mascota.jpg', text: 'Próximamente', link: 'https://example.com/copa_america' },
                {src: './Publicidad/Grupos2.jpg', text: 'Arranca el  26/06', link: 'https://example.com/copa_america' },
                {src: './Publicidad/fixture1.jpg', text: 'Arranca el  26/06', link: 'https://example.com/copa_america' },
                {src: './Publicidad/fixture2.jpg', text: 'Arranca el  26/06', link: 'https://example.com/copa_america' },
                {src: './Publicidad/mercadopago.png', text: 'En breve daremos más Información', link: 'https://example.com/copa_america'}
                // Agrega más objetos de imagen y texto según sea necesario
            ];
            var currentIndex = 0;
            var changeImageInterval = 5000; // Tiempo en milisegundos (5 segundos)

            function changeImage() {
                currentIndex = (currentIndex + 1) % images.length;
                $('#adImage').fadeOut(1000, function() {
                    $(this).attr('src', images[currentIndex].src).fadeIn(1000);
                });
                $('#overlayText').fadeOut(1000, function() {
                    $(this).text(images[currentIndex].text).fadeIn(1000);
                });
            
            }

            setInterval(changeImage, changeImageInterval);
                        // Manejar el clic en la imagen
                        $('#adImage').click(function() {
                var currentLink = images[currentIndex].link;
                if (currentLink) {
                    window.open(currentLink, '_blank');
                }
            });
        });
    </script>

</html>