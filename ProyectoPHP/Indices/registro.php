<?php

declare(strict_types=1);
require 'headerA.php';

function altaCuenta($mysqli, $nombre, $contra, $email): bool {
    $sql = "INSERT INTO `accounts` (`username`, `password`, `email`) VALUES (?, ?, ?)";
    $stmt = $mysqli->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("sss", $nombre, $contra, $email);
        
        try {
            return $stmt->execute();
        } catch (mysqli_sql_exception $e) {
            // Si ocurre un error, lanza la excepción para manejarla en el bloque principal
            throw $e;
        }
    } else {
        // En caso de que no se pueda preparar la consulta
        return false;
    }
}

$dbhost = "localhost"; // Host donde esta la bd
$dbname = "login-php"; // Nombre de la bd
$dbuser = "root"; // Username
$dbpass = ""; // Password

$mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

// Habilita excepciones para errores de mysqli
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

if ($mysqli->connect_error) {
    die("Error de conexión: " . $mysqli->connect_error);
}

$username = $_POST["username"];
$correo = $_POST["email"];
$password = $_POST["password"];

if ($username != "" && $correo != "" && $password != "") {
    try {
        if (altaCuenta($mysqli, $username, $password, $correo)) {
            // Redirige a login si fue exitoso
            header("Location: login.html");
            exit();
        } else {
            echo "<div class='error-message'>Error desconocido al registrar la cuenta.</div>";
        }
    } catch (mysqli_sql_exception $e) {
        if ($e->getCode() == 1062) { // Código de error para entrada duplicada
            echo "<div class='error-message'>Error: El usuario o el email ya están registrados.</div>";
        } else {
            echo "<div class='error-message'>Error en el registro: " . $e->getMessage() . "</div>";
        }
    }
} else {
    echo "<div class='error-message'>Llene los campos correctamente</div>";
}

// Cierra la conexión
$mysqli->close();

?>