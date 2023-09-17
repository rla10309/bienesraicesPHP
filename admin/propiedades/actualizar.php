<?php
require "../../includes/funciones.php";
$auth = estaAutenticado();



if (!$auth) {
    header("Location: /bienesraices/index.php");
}

// VALIDAMOS LA URL
$id = $_GET["id"];
$id = filter_var($id, FILTER_VALIDATE_INT);

if (!$id) {
    header("Location: /bienesraices/admin/index.php");
}
// Base de datos
require "../../includes/config/database.php";
$db = conectarDB();

// Consulta para obtener los datos de la propiedad
$consultaPropiedad = "SELECT * FROM propiedades WHERE idpropiedades = $id";
$resultadoPropiedad = mysqli_query($db, $consultaPropiedad);
$propiedad = mysqli_fetch_assoc($resultadoPropiedad);

// echo "<pre>";
// var_dump($propiedad);
// echo "</pre>";



// Consultar para obtener los vendedores
$consulta = "SELECT * FROM vendedores";
$resultado = mysqli_query($db, $consulta);



// Arreglo con mensajes de error
$errores = [];

$titulo = $propiedad["titulo"];
$precio = $propiedad["precio"];
$descripcion = $propiedad["descripcion"];
$habitaciones = $propiedad["habitaciones"];
$wc = $propiedad["wc"];
$estacionamiento = $propiedad["estacionamiento"];
$idvendedor = $propiedad["idvendedor"];
$imagenPropiedad = $propiedad["imagen"];
// echo "<pre>";
// var_dump($imagenPropiedad);
// echo "</pre>";
// exit;

// Ejectua el código después de enviar el formulario
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // echo "<pre>";
    // var_dump($_POST);
    // echo "</pre>";
    // exit;

    $titulo = $_POST["titulo"];
    $precio = mysqli_real_escape_string($db, $_POST["precio"]);
    $descripcion = mysqli_real_escape_string($db, $_POST["descripcion"]);
    $habitaciones = mysqli_real_escape_string($db, $_POST["habitaciones"]);
    $wc = mysqli_real_escape_string($db, $_POST["wc"]);
    $estacionamiento = mysqli_real_escape_string($db, $_POST["estacionamiento"]);
    $idvendedor = mysqli_real_escape_string($db, $_POST["vendedor"]);
    $creado = date("Y/m/d");

    // Asignar FILES hacia una variable
    $imagen = $_FILES["imagen"];
    //var_dump($imagen);


    if (!$titulo) {
        $errores[] = "Debes añadir un título";
    }
    if (!$precio) {
        $errores[] = "El precio es obligatorio";
    }
    // Validar imagenp por tamaño (100 Kb máximo)
    $medida = 1000 * 1000;
    if ($imagen["size"] > $medida) {
        $errores[] = "La imagen es muy grande";
    }
    if (strlen($descripcion) < 50) {
        $errores[] = "La descripción es obligatoria y debe tener al menos 50 caracteres";
    }
    if (!$habitaciones) {
        $errores[] = "Debe introducir el número de habitaciones";
    }
    if (!$wc) {
        $errores[] = "Debe introducir los baños de la propiedad";
    }
    if (!$estacionamiento) {
        $errores[] = "Debe introducir el número de estacionamientos";
    }
    if (!$idvendedor) {
        $errores[] = "Elige un vendedor";
    }


    // Debemos revistar que el array de errores está vacío o no
    if (empty($errores)) {
        // Guardar imágenes en el servidor
        // 1. Crear carpeta
        $carpetaImagenes = "../../imagenes/";
        if (!is_dir($carpetaImagenes)) {
            mkdir($carpetaImagenes);
        }
        $nombreImagen = "";

        if ($imagen["name"]) {
            // Eliminar una imagen anterior
            unlink($carpetaImagenes . $propiedad["imagen"]);
            // 2. Generar un nombre única
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";
            // 3. Subir la imagen
            move_uploaded_file($imagen["tmp_name"], $carpetaImagenes . $nombreImagen);
        } else {
            $nombreImagen = $propiedad["imagen"];
        }



        // Actualizar en la base de datos
        $query = "UPDATE propiedades SET titulo = '$titulo', precio = $precio, imagen = '$nombreImagen', descripcion = '$descripcion', habitaciones = $habitaciones, wc = $wc, estacionamiento = $estacionamiento, idvendedor = $idvendedor WHERE idpropiedades = $id";

        $resultado = mysqli_query($db, $query);

        if ($resultado) {
            // Redireccionar al usuario
            header("Location: /bienesraices/admin/index.php?resultado=2");
        }
    } else {
        echo "No se han insertado los datos";
    }
}




incluirTemplate("header");
?>

<main class="contenedor seccion">
    <h1>Actualizar</h1>
    <a href="/bienesraices/admin/index.php" class=" boton btn-verde">Volver</a>
    <?php foreach ($errores as $error) : ?>
        <div class="alerta error">
            <?php echo $error ?>
        </div>

    <?php endforeach; ?>


    <!-- Formulario de inserción de propiedades -->
    <form action="" class="formulario" method="POST" enctype="multipart/form-data">
        <fieldset>
            <legend>Información General</legend>

            <label for="titulo">Título</label>
            <input type="text" id="titulo" name="titulo" placeholder="Titulo propiedad" value="<?php echo $titulo ?>">

            <label for="precio">Precio</label>
            <input type="number" id="precio" name="precio" placeholder="Precio propiedad" value="<?php echo $precio ?>">

            <label for="imagen">Imagen</label>
            <input type="file" id="imagen" name="imagen" accept="image/jpeg, image/png">

            <img src="../../imagenes/<?php echo $imagenPropiedad; ?>" class="imagen-small" alt="imagen a actualizar">

            <label for="descripcion">Descripción</label>
            <textarea id="descripcion" name="descripcion"><?php echo $descripcion ?></textarea>
        </fieldset>
        <fieldset>
            <legend>Información Propiedad</legend>

            <label for="habitaciones">Habitaciones</label>
            <input type="number" id="habitaciones" name="habitaciones" placeholder="Ej: 3" min="1" max="9" value="<?php echo $habitaciones ?>">

            <label for="wc">Baños</label>
            <input type="number" id="wc" name="wc" placeholder="Ej: 3" min="1" max="9" value="<?php echo $wc ?>">

            <label for="estacionamiento">Estacionamiento</label>
            <input type="number" id="estacionamiento" name="estacionamiento" placeholder="Ej: 3" min="1" max="9" value="<?php echo $estacionamiento ?>">

            <fieldset>
                <legend>Vendedor</legend>
                <select id="vendedor" name="vendedor">
                    <option value="">-- Seleccione --</option>
                    <?php while ($vendedor = mysqli_fetch_assoc($resultado)) : ?>
                        <option <?php echo $idvendedor === $vendedor["idvendedor"] ? "selected" : " "; ?> value="<?php echo $vendedor["idvendedor"]; ?>"><?php echo $vendedor['nombre'] . " " . $vendedor["apellido"]; ?></option>
                    <?php endwhile; ?>


                </select>
            </fieldset>
            <input type="submit" value="Actualizar propiedad" class="boton btn-verde">
    </form>
</main>
<?php
incluirTemplate("footer");
?>