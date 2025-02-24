<?php
require("conexionbdd.php");

session_start();

// Insertar producto

$stmt = $conn->prepare("INSERT INTO productos(numero_de_parte, nombre_producto, categoria_producto, marca_producto, precio_producto, stock_producto, descripcion_producto) VALUES (?,?,?,?,?,?,?)");
$stmt->bind_param("ssssiis",  $_POST['num_parte'], $_POST['nombre_producto'], $_POST['categoria'], $_POST['marca'], $_POST['precio'], $_POST['stock'], $_POST['descripcion']); 
$stmt->execute();

$id_producto = $conn->insert_id;
echo $id_producto;

//Subir Foto 1

if (isset($_FILES['file-upload-1'])) {

    $fotonum = 1;
    $archivo = $_FILES['file-upload-1'];

    if ($archivo['error'] === UPLOAD_ERR_OK) {

        $nombre_variable = $_POST['num_parte']." [1]";// Asumiendo que se envía a través de un formulario

        $nombre_variable = preg_replace('/[^a-zA-Z0-9]/', '', $nombre_variable);

        $nombre_archivo = $nombre_variable . "." . pathinfo($archivo['name'], PATHINFO_EXTENSION);
        $tipo_archivo = $archivo['type'];
        $tamano_archivo = $archivo['size'];
        $ruta_temporal = $archivo['tmp_name'];

        $tipos_permitidos = array('image/jpeg', 'image/png');
        $tamano_maximo = 10 * 1024 * 1024;

        if (in_array($tipo_archivo, $tipos_permitidos) && $tamano_archivo <= $tamano_maximo) {

            $ruta_destino = '../assets/foto-repuestos/' . $nombre_archivo;
            if (move_uploaded_file($ruta_temporal, $ruta_destino)) {

                // INSERT INTO foto_productos(ruta_foto, num_foto, id_producto) VALUES ([value-1],'[value-2]','[value-3]','[value-4]')
                $stmt = $conn->prepare("INSERT INTO foto_productos(ruta_foto, num_foto, id_producto) VALUES (?, 1, ?)");
                $stmt->bind_param("si", $ruta_destino, $id_producto); 
                $stmt->execute();

                echo "Archivo subido correctamente.";

            } else {
                echo "Error al mover el archivo.";
            }
        } else {
            echo "Error: Tipo de archivo no permitido o tamaño excedido.";
        }

    } else {
        switch ($archivo['error']) {
            case UPLOAD_ERR_INI_SIZE:
                echo "Error: El archivo excede el tamaño máximo permitido por PHP.";
                break;
            case UPLOAD_ERR_FORM_SIZE:
                echo "Error: El archivo excede el tamaño máximo permitido por el formulario.";
                break;
            case UPLOAD_ERR_PARTIAL:
                echo "Error: El archivo fue subido parcialmente.";
                break;
            case UPLOAD_ERR_NO_FILE:
                echo "Error: No se ha subido ningún archivo.";
                break;
            case UPLOAD_ERR_NO_TMP_DIR:
                echo "Error: No se ha encontrado la carpeta temporal.";
                break;
            case UPLOAD_ERR_CANT_WRITE:
                echo "Error: No se pudo escribir el archivo en el disco.";
                break;
            case UPLOAD_ERR_EXTENSION:
                echo "Error: Una extensión de PHP impidió la subida del archivo.";
                break;
            default:
                echo "Error desconocido al subir el archivo.";
        }
    }
} else {
   //   
}


// header("location: ../panelAdmin/admin.php");
// exit();

$stmt->close();
$conn->close();
?>

