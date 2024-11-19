<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preload" href="../CSS/normalize.css" as="style">
    <link rel="stylesheet" href="../CSS/normalize.css">
    <link rel="preload" href="../CSS/styleLogin.css" as="style">
    <link href="../CSS/styleLogin.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>OSWI - Registro</title>
</head>

<body class="fondo">
    <img src="../img/OSWI-logo-blanco.png" width="30%">
    <form class="formulario" action="registro.php" method="post">

        <fieldset>
            <legend>Registro</legend>
            <label for="username"><i class="fas fa-user"></i> Usuario:</label>
            <br>
            <input class="input-text" type="text" placeholder="Usuario" name="username" id="username">
            <br>
            <label for="email"> E-mail:</label>
            <br>
            <input class="input-text" type="text" placeholder="Email" name="email" id="email">
            <br>
            <label for="password"><i class="fas fa-lock"></i> Contraseña:</label>
            <br>
            <input class="input-text" type="password" placeholder="Contraseña" name="password" id="password">
            <div class="derecha flex"><input class="boton w-sm-100" type="submit" value="Registrarse"></div>
        </fieldset>
    </form>

    <footer>
        <p>David Avalos | Alfredo Puentes <br> Todos los derechos reservados</p>
    </footer>