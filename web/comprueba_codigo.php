<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
//comprobamos si nos llegan los parametros de la RASPBERRY
if(isset($_GET['codigo_producto']) && isset($_GET['usuario'])){
    
    $servername = "localhost";
    $username = "u823703154_santi";
    $database = "u823703154_pro";
    $password = "santiago87";
    //Create a new connection to the MySQL database using PDO
    $conn = new mysqli($servername, $username, $password, $database);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        
    }
   
    $existe_producto = 0;
    //comprobamos en la tabla de productos
    $consulta = "SELECT codigo_producto FROM productos WHERE id_usuario =".$_GET['usuario'];
    $respuesta = array();
    $contador = 0;
    $resultado = $conn->query($consulta);
    //si $resultado->num_rows == 0 -----> mandamos email con el link para insertar el nuevo producto
    if($resultado->num_rows == 0){
        $c = 3;//$_GET['codigo_producto'];
        $u = 4 ;// $_GET['usuario'];
        $params = array($c,$u);
        //enviamos email----> hacemos uso de PHPmailer();
        // Instantiation and passing `true` enables exceptions
        $mail = new PHPMailer(true);
        try {
            //Server settings
            $mail->SMTPDebug = 0;                                       // Enable verbose debug output
            $mail->isSMTP();                                            // Set mailer to use SMTP
            $mail->Host       = 'smtp.gmail.com';  // Specify main and backup SMTP servers
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'santiagofragio@gmail.com';                     // SMTP username
            $mail->Password   = 'santiago87';                               // SMTP password
            $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
            $mail->Port       = 587;                                    // TCP port to connect to
            
            //Recipients
            $mail->setFrom('santiagofragio@gmail.com', 'yo');
            $mail->addAddress('santiagofragio@gmail.com', 'sannnttii');     // Add a recipient
            /*$mail->addAddress('ellen@example.com');               // Name is optional
             $mail->addReplyTo('info@example.com', 'Information');
             $mail->addCC('cc@example.com');
             $mail->addBCC('bcc@example.com');*/
            
            // Attachments
            /*$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
             $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name*/
            
            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Producto no existe en Base de Datos';
            $mail->Body    = 'Para dar de alta el producto, haga click en el siguiente enlce:\n localhost/API/alta_producto/'.$params;
            $mail->AltBody = 'esta es el cuerpo del mensaje para los clientes';
            
            $mail->send();
            echo 0;//'El mensaje se envio correctamente';
        } catch (Exception $e) {
            echo 0;//"Error al enviar el mensaje. Mailer Error: {$mail->ErrorInfo}";
        }
    }
    else{
        echo $l=1;
    }
}else{
    echo $l=0;
}