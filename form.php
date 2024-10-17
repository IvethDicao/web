<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $puesto = $_POST['puesto'];
    $mensaje = $_POST['mensaje'];

    // Manejo del archivo subido
    $cv = $_FILES['cv'];
    $cv_nombre = $cv['name'];
    $cv_tmp = $cv['tmp_name'];
    $cv_error = $cv['error'];

    // Comprueba si hay algún error con la carga del archivo
    if ($cv_error === 0) {
        // Guardar el archivo en el servidor (ajusta la ruta según sea necesario)
        $cv_destino = "cvs/" . $cv_nombre; // Asegúrate de que la carpeta 'cvs' exista
        move_uploaded_file($cv_tmp, $cv_destino);
        
        // Configura el destinatario
        $destinatario = "ivethdicao@gmail.com";
        $asunto = "Solicitud de Empleo de " . $nombre;

        // Crea el cuerpo del mensaje
        $cuerpo = "Nombre: $nombre\n";
        $cuerpo .= "Email: $email\n";
        $cuerpo .= "Teléfono: $telefono\n";
        $cuerpo .= "Puesto: $puesto\n";
        $cuerpo .= "Mensaje: $mensaje\n";
        $cuerpo .= "CV: " . $cv_nombre; // Incluye el nombre del archivo del CV

        // Enviar el correo
        mail($destinatario, $asunto, $cuerpo);

        echo "Solicitud enviada con éxito.";
    } else {
        echo "Error al cargar el archivo. Por favor, intenta de nuevo.";
    }
}
?>
