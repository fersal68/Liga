<?php
        include("./conex/conexion.php");
        require_once './conex/Config.php';

        $jugador = $_SESSION['participante'];
        $fechaActual = date('d/m/Y'); // Obtiene la fecha actual en formato ddmmyyyy
        ?>   

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Búsqueda</title>
    <link rel="stylesheet" href="./classes/style_table_Hab_mp.css">
    <style>
        .loading {
            display: none; /* Ocultar la imagen inicialmente */
            position: fixed; /* Posicionar la imagen fija en la pantalla */
            left: 50%; /* Centrar horizontalmente */
            top: 50%; /* Centrar verticalmente */
            transform: translate(-50%, -50%); /* Ajustar el centrado */
        }
        .loading img {
            width: 60px; /* Ajustar el tamaño de la imagen */
            height: 60px; /* Ajustar el tamaño de la imagen */
            animation: spin 2s linear infinite; /* Añadir animación de rotación */
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        .error-message {
            color: red;
            font-weight: bold;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <?php


        try {
            // Conexión a la base de datos
            $conex = conectar();

            // Definir la consulta con un marcador de posición
            $sql = "SELECT observacion, dato FROM ligasetup WHERE ligasetup.equivalencia = 'X' AND ligasetup.modulo = :Modulo"; 
            $n_param = 'FECHA';
            $stmt = $conex->prepare($sql);
            $stmt->bindParam(':Modulo', $n_param);
            $stmt->execute();
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

            // Verificar si se encontró un registro
            if ($resultado) {
                $nfecha = $resultado['observacion'];
                $npartido = $resultado['dato'];

                $sql1 = "SELECT * FROM usuarios, mercadopago, ligasetup WHERE 
                usuarios.usuario = mercadopago.idusuario
                AND usuarios.fechahab = mercadopago.nfecha
                AND mercadopago.nfecha = ligasetup.dato 
                AND ligasetup.equivalencia = 'X' AND ligasetup.modulo='FECHA'
                AND usuarios.usuario = :jugador";
                $stmt1 = $conex->prepare($sql1);
                $stmt1->bindParam(':jugador', $jugador);
                $stmt1->execute();
                $resultado1 = $stmt1->fetch(PDO::FETCH_ASSOC);

                if ($resultado1) {
                    echo "<h1 class='text-center text-black-bold-shadow'>Ya estás jugando.</h1>";
                } else {
        ?>

        <h1 class="text-center text-black-bold-shadow">Búsqueda de Pago</h1>

        <p class="lead">
        Instrucciones del Juego
        </p>
        <ul class="list-unstyled">
           <li></li>
           <li>puntos:
           <ul>
               <li>Se podrá modificar el resultado hasta 1 día antes del partido.</li>
               <li>El valor para participar es:<mark class="fondotex"> $ 4.000,00</mark></li>
               <li>Los puntos se toman 2 si se acierta el resultado, 1 el ganador.</li>
               <li>En fase de eliminatorias se toma el resultado final con el alargue, sin penales. </li>
               <li>Premios: 1° el 80% y al 2° el 20% de lo Recaudado</li>
           </ul>
           </li>
           <li>Para arrancar se debe depositar por mercado pago al alias: ferchu0013.fs  o enviar al Administrador</li>
           <li>Tomar el ID de mercado pago y seguir los pasos:</li>
        </ul>

        <form method="POST" action="" class="d-flex justify-content-center align-items-center">
            <div class="form-group mr-2">
                <label for="payment_id" class="text-black-bold-shadow">ID del Pago:</label>
                <input type="text" class="form-control" id="payment_id" name="payment_id" required>
            </div>
            <button type="submit" class="btn btn-success" name="btnBuscar" onclick="showLoading()">Buscar</button>
        </form>

        <div id="loading" class="loading">
            <img src="./images/loading.png" alt="Cargando...">
        </div>

        <?php
                }
            } else {
                echo "<p class='error-message'>No se encontraron resultados para la consulta inicial.</p>";
            }
        } catch (PDOException $e) {
            // Log the error
            error_log($e->getMessage(), 3, "./log/file.log");
            echo "<p class='error-message'>Error en la conexión o consulta: " . htmlspecialchars($e->getMessage()) . "</p>";
        }

        if (isset($_POST['btnBuscar'])) {
            try {
                $payment_id = htmlspecialchars($_POST['payment_id']); // Sanitize input

                // Definir los parámetros de la petición
                $url = 'https://api.mercadopago.com/v1/payments/' . $payment_id;
                $token = 'APP_USR-7210448084079082-050214-4e76d7e7a626261e22799364788cc390-95876608';

                // Crear una instancia de cURL y configurar las opciones
                $curl = curl_init();
                curl_setopt_array($curl, array(
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_URL => $url,
                    CURLOPT_HTTPHEADER => array('Authorization: Bearer ' . $token)
                ));

                // Ejecutar la petición y obtener el resultado
                $resultado = curl_exec($curl);


                $importeEsperadoJugada = VALORJUGADA;  // Importe de la jugada
                if (curl_errno($curl)) {
                    $error_msg = curl_error($curl);
                    echo "Error al enviar la petición: $error_msg";
                } else {
                    $objeto_resultado = json_decode($resultado, true);

                    if (isset($objeto_resultado['error'])) {
                        $error_message = "Error: " . $objeto_resultado['error'] . " - " . $objeto_resultado['message'];
                        //echo $error_message;
                        echo  "<p class='text-black-bold-shadow'>No se encontró pago en Mercado Pago, comuníquese con el Administrador con el ID: " .  htmlspecialchars($payment_id) . "</p>";
                        

                        
                        // Grabar el error en el log
                        $log_message = date('Y-m-d H:i:s') . " - Error con el ID de pago $payment_id: " . $objeto_resultado['error'] . " - " . $objeto_resultado['message'] . "\n";
                        error_log($log_message, 3, "./log/file.log");
                    } else {
                        echo "<h2 class='text-center text-black-bold-shadow'>Resultado:</h2>";
                        $fecha_iso = htmlspecialchars($objeto_resultado['date_approved']);
                        $fecha_objeto = new DateTime($fecha_iso);
                        $fecha_formateada = $fecha_objeto->format('d/m/Y');
                        $transaction_mp = htmlspecialchars($objeto_resultado['transaction_amount']);
                        echo "<p class='text-black-bold-shadow'>ID del Pago: " . htmlspecialchars($objeto_resultado['id']) . "</p>";
                        echo "<p class='text-black-bold-shadow'>Fecha Aprobada: " . $fecha_formateada . "</p>";
                        echo "<p class='text-black-bold-shadow'>Estado: " . htmlspecialchars($objeto_resultado['status']) . "</p>";

                        if ($transaction_mp > $importeEsperadoJugada) {
                            echo "<p class='text-red-shadow'>Monto de la Transacción: " . $transaction_mp . " - El importe de la jugada es $importeEsperadoJugada</p>";
                        } else {
                            echo "<p class='text-black-bold-shadow'>Monto de la Transacción: " . $transaction_mp . "</p>";
                        }

                        echo "<p class='text-black-bold-shadow'>Descripción: " . htmlspecialchars($objeto_resultado['description']) . "</p>";

                        $IDpago_MP = htmlspecialchars(trim($objeto_resultado['id']));
                        $Status_MP = htmlspecialchars(trim($objeto_resultado['status']));
                        $Fecha_MP = $fecha_formateada;
                        $Importe_MP = htmlspecialchars($objeto_resultado['transaction_amount']);

                        $sql = "SELECT 
                        MERCADOPAGO.ID,
                        MERCADOPAGO.IDMP,
                        MERCADOPAGO.FECHAMP,
                        MERCADOPAGO.IMPORTEMP
                        FROM MERCADOPAGO 
                        WHERE MERCADOPAGO.IDMP = :IDpago_MP
                        ORDER BY MERCADOPAGO.ID";

                       $stmt = $conex->prepare($sql);
                       $stmt->bindParam(':IDpago_MP', $IDpago_MP);
                       $stmt->execute();
                       $result = $stmt->fetch(PDO::FETCH_ASSOC);

                     if ($result) {
                         echo "<h2 class='text-black-bold-shadow'>Resultado:</h2>";
                         echo "<p class='text-black-bold-shadow'>ID del Pago: " . htmlspecialchars($result['ID']) . "</p>";
                         echo "<p class='text-black-bold-shadow'>IDMP: " . htmlspecialchars($result['IDMP']) . "</p>";
                         echo "<p class='text-black-bold-shadow'>Fecha del Pago: " . htmlspecialchars($result['FECHAMP']) . "</p>";
                         echo "<p class='text-black-bold-shadow'>Importe del Pago: " . htmlspecialchars($result['IMPORTEMP']) . "</p>";
                         echo "<p class='text-black-bold-shadow'>El pago ya fue ingresado, ingresa uno nuevo o comunícate con el administrador.</p>";
                                  } else {
                         echo "<p class='text-black-bold-shadow'>El pago no se encuentra en la base de datos.</p>";
                         echo '<form method="POST" action="Sentencias_sql.php">';
                         echo '<input type="hidden" name="IDpago_MP" value="' . htmlspecialchars($IDpago_MP) . '">';
                         echo '<input type="hidden" name="Status_MP" value="' . htmlspecialchars($Status_MP) . '">';
                         echo '<input type="hidden" name="Fecha_MP" value="' . htmlspecialchars($Fecha_MP) . '">';
                         echo '<input type="hidden" name="Importe_MP" value="' . htmlspecialchars($Importe_MP) . '">';
                         echo '<input type="hidden" name="nfecha" value="' . htmlspecialchars($nfecha) . '">';
                         echo '<input type="hidden" name="jugador" value="' . htmlspecialchars($jugador) . '">';

                $importeEsperado = VALORJUGADA;

                if (trim($Importe_MP) !== trim($importeEsperado)) {
                    echo "<h3 class='text-red-shadow'>El importe no es igual al esperado. Comunícate con el administrador.</h3>";
                    echo '<button type="submit" class="btn btn-secondary" name="altajugadaporMP" disabled>Generar Fecha a ' . htmlspecialchars($jugador) . ' </button>';
                } else {
                    echo '<button type="submit" class="btn btn-success" name="altajugadaporMP" onclick="showLoading()">Generar Fecha a ' . htmlspecialchars($jugador) . '</button>';
                }

                $sql = "SELECT observacion, dato FROM ligasetup WHERE modulo = 'FECHA' AND equivalencia = 'X'";
                $stmt = $conex->prepare($sql);
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($result) {
                    echo '<input type="hidden" name="dato" value="' . htmlspecialchars($result['dato']) . '">';
                    echo '<input type="hidden" name="observacion" value="' . htmlspecialchars($result['observacion']) . '">';
                } else {
                    echo "<p class='text-black-bold-shadow'>No se encontraron resultados.</p>";
                }

                echo '</form>';
                }


                    }
                }
                curl_close($curl);

           

       


                
            } catch (PDOException $e) {
                error_log($e->getMessage(), 3, "./log/file.log");
                echo "<p class='error-message'>Error al ejecutar la consulta: " . htmlspecialchars($e->getMessage()) . "</p>";
            }
        }
        ?>
    </div>

    <script>
        function showLoading() {
            document.getElementById('loading').style.display = 'block';
        }
    </script>
</body>
</html>
