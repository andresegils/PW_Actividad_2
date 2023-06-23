<!DOCTYPE html>
<html>
<head>
    <title>Manejo de archivos con PHP</title>
</head>
<body>
    <form method="POST">
        <input type="text" name="nombre_archivo" placeholder="Ingresa el nombre del archivo" required><br>
        <textarea name="contenido" placeholder="Contenido del archivo"></textarea><br>
        <input type="submit" name="guardar" value="Guardar">
        <input type="submit" name="limpiar" value="Limpiar">
        <input type="submit" name="abrir" value="Abrir">
    </form>
    <?php
        if (isset($_POST['guardar'])) {
            $nombre_archivo = $_POST['nombre_archivo'];
            $contenido = $_POST['contenido'];

            $fp = fopen($nombre_archivo, "w");
            if (!$fp) {
                echo "No se ha podido abrir el archivo";
            } else {
                fwrite($fp, $contenido);
                fclose($fp);
                echo "Archivo guardado con éxito";
            }
        }
        elseif (isset($_POST['limpiar'])) {
            echo "<script>document.location.reload()</script>";
        }
        elseif (isset($_POST['abrir'])) {
            $nombre_archivo = $_POST['nombre_archivo'];
            if (file_exists($nombre_archivo)) {
                $file = fopen($nombre_archivo, "r");
                $filecontent = fread($file, filesize($nombre_archivo));
                fclose($file);
                echo "<script>document.getElementsByName('contenido')[0].value = `{$filecontent}`;</script>";
            } else {
                echo "El archivo no existe";
            }
        }
    ?>
</body>
</html>
