<!-- composer require mercadopago/dx-php -->



<?php
require mercadopago/dx-php;
require __DIR__ . '/vendor/autoload.php'; // Asegúrate de que Composer haya instalado el SDK de Mercado Pago

// Configura tus credenciales
MercadoPago\SDK::setAccessToken('YOUR_ACCESS_TOKEN'); // Reemplaza con tu Access Token

// Crea un objeto de preferencia
$preference = new MercadoPago\Preference();

// Crea un ítem en la preferencia
$item = new MercadoPago\Item();
$item->title = 'Mi producto';
$item->quantity = 1;
$item->currency_id = 'ARS';
$item->unit_price = 75.56; // Reemplaza con el precio de tu producto
$preference->items = array($item);

// Opcional: Configura URLs de retorno
$preference->back_urls = array(
    "success" => "https://www.tu-sitio.com/success",
    "failure" => "https://www.tu-sitio.com/failure",
    "pending" => "https://www.tu-sitio.com/pending"
);
$preference->auto_return = "approved";

// Guarda la preferencia
$preference->save();

// Obtén el link de pago
echo 'Paga tu compra haciendo clic <a href="' . $preference->init_point . '">aquí</a>';
?>





<?php
// success.php

if ($_GET['collection_status'] == 'approved') {
    // El pago fue aprobado
    echo "Pago aprobado.";
    // Aquí puedes actualizar el estado del pedido en tu base de datos
} else {
    echo "Pago no aprobado.";
}
?>