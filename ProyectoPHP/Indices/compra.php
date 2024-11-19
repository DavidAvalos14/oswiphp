<?php
require 'headerProd.html';

session_start();

echo "<title>OSWI - Compra</title>";

echo "<h1 class=\"subtitulo\"> Tu compra total:";
echo "<br>$".$_GET['total']." MXN<br>Estas por comprar:</h1>";
echo "<main class=\"contenedorP\"><h1 class=\"producto\">";

if (isset($_GET['total']) && isset($_GET['id'])) {
    $id = $_GET['id'];
    $conexion = mysqli_connect("localhost", "root", "", "tenis", 3306) or die("Problemas con la conexión");

    if($id == 0){        
        $consulta = "SELECT  c.id, c.precio, c.color, c.talla, ma.nombre as 'marca', mo.nombre as 'modelo', c.imagen, c.cantidad FROM carrito c, marca ma, modelo mo WHERE c.modelo = mo.id and c.marca = ma.id;";
        $resultado = mysqli_query($conexion, $consulta);
        while ($tenis = mysqli_fetch_assoc($resultado)) {   
            $_SESSION['modelo'] = $tenis["modelo"];
            $_SESSION['color'] = $tenis["color"];
            $_SESSION['talla'] = $tenis["talla"];
            $_SESSION['marca'] = $tenis["marca"];
            $_SESSION['cantidad'] = $tenis["cantidad"];
            $_SESSION['precio'] = $tenis["precio"];
            $_SESSION['imagen'] = $tenis["imagen"];

            echo "<p class=\"tituloP\">".$tenis["modelo"] . "<br></p>";
            echo "Color(es): " . $tenis["color"] . "<br>";
            echo "Talla: " . $tenis["talla"] . "(MX)<br>";
            echo "Marca: " . $tenis["marca"] . "<br>";
            echo "Cantidad a comprar: " . $tenis["cantidad"] . "<br>";
            echo "<p class=\"precioP\">$" . $tenis["precio"] . " MXN<br></p>";
            echo "<img class=\"imgP\"src=\"../img/" . $tenis["imagen"] . "\" width=\"70%\">";
        }       

        $_SESSION['control'] = '1'; 
    }
    else{
        $consulta = "SELECT  t.id, t.precio, t.color, t.talla, ma.nombre as 'marca', mo.nombre as 'modelo', t.imagen, t.cantidad FROM tenis t, marca ma, modelo mo WHERE t.modelo = mo.id and t.marca = ma.id and t.id = ".$id;
        $resultado = mysqli_query($conexion, $consulta);
        $tenis = mysqli_fetch_assoc($resultado);

        $_SESSION['modelo'] = $tenis["modelo"];
        $_SESSION['color'] = $tenis["color"];
        $_SESSION['talla'] = $tenis["talla"];
        $_SESSION['marca'] = $tenis["marca"];
        $_SESSION['cantidad'] = $tenis["cantidad"];
        $_SESSION['precio'] = $tenis["precio"];
        $_SESSION['imagen'] = $tenis["imagen"];

        echo "<p class=\"tituloP\">".$tenis["modelo"] . "<br></p>";
        echo "Color(es): " . $tenis["color"] . "<br>";
        echo "Talla: " . $tenis["talla"] . "(MX)<br>";
        echo "Marca: " . $tenis["marca"] . "<br>";
        echo "Cantidad a comprar: " . $tenis["cantidad"] . "<br>";
        echo "<p class=\"precioP\">$" . $tenis["precio"] . " MXN<br></p>";
        echo "<img class=\"imgP\"src=\"../img/" . $tenis["imagen"] . "\" width=\"70%\">";

        $_SESSION['control'] = '2'; 
    }
    echo "<br><a class=\"botonP\" href=\"login.html\">¿Quieres iniciar sesion?</a>";
    echo "<br><a class=\"botonP\" href=\"pdf.php\">Generar recibo en PDF</a><br><br>";
    exit;
    echo "</h1></main>";
}

mysqli_close($conexion);
require 'footerCompra.html';
require 'footerProd.html';
?>