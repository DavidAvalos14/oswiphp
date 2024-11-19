<?php
session_start();
ob_start(); // Iniciar el almacenamiento en búfer de salida para evitar salidas antes de header()

// Credenciales de acceso a la base de datos
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'login-php';

// Conexión a la base de datos
$conexion = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

if (mysqli_connect_error()) {
    exit('Fallo en la conexión de mysqli: ' . mysqli_connect_error());
}

// Validar si se ha enviado la información
if (!isset($_POST['username'], $_POST['password'])) {
    header('Location: login.html');
    exit;
}

// Prevenir inyección SQL
if ($smtmt = $conexion->prepare('SELECT id, password FROM accounts WHERE username = ?')) {
    $smtmt->bind_param('s', $_POST['username']);
    $smtmt->execute();
    $smtmt->store_result();

    if ($smtmt->num_rows > 0) {
        $smtmt->bind_result($id, $password);
        $smtmt->fetch();

        // Verificar si la contraseña es correcta
        if ($_POST['password'] === $password) {
            session_regenerate_id();
            $_SESSION['loggedin'] = true;
            $_SESSION['name'] = $_POST['username'];
            $_SESSION['id'] = $id;

            // Verificar el rol de quien inició sesión
            if ($stmt = $conexion->prepare('SELECT rol FROM accounts WHERE username = ?')) {
                $stmt->bind_param('s', $_POST['username']);
                $stmt->execute();
                $stmt->bind_result($rol);
                $stmt->fetch();
                $stmt->close();

                //echo "el rol es: " . $rol . " + " . strlen($rol);
                //exit;

                // Verificar el rol y redireccionar
                if ($rol === 'admin') {

                    header('Location: headerAdmin.html');
                    exit;
                } else {
                    header('Location: productos.php');
                    exit;
                }
            } else {
                echo "Error en la consulta de rol.";
            }
        } else {
            // Contraseña incorrecta
            header('Location: login.html');            
            exit;
        }
    } else {
        // Usuario no encontrado
        header('Location: login.html');
        exit;
    }
    $smtmt->close();
}

ob_end_flush(); // Finalizar el almacenamiento en búfer y enviar la salida al navegador
?>