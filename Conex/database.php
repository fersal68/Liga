<?php
require_once 'Config.php';
class Database
{
    /**
     * Se conecta a la base de datos y devuelve un objeto PDO.
     * @return La conexión a la base de datos.
     */
    function conectar()
    {
        try {
            $database_path=APP_DATALA;
            //$database_path='C:\xampp\htdocs\Liga\App_Data\DB_tickets.mdb';
            $pdo = new PDO('odbc:Driver={Microsoft Access Driver (*.mdb, *.accdb)}; Dbq=' . $database_path . '; Uid=; Pwd=;' );
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION)  ;   
            return $pdo;
        } catch (PDOException $e) {
            echo 'Error conexion: ' . $e->getMessage();
            exit;
        }
    }
}
