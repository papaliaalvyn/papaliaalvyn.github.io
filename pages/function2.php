<?php


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/phpmailer/phpmailer/src/Exception.php';
require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/SMTP.php';



//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function

use PHPMailer\PHPMailer\SMTP;


//Load Composer's autoloader
require 'vendor/autoload.php';


$sizes = $_POST["size"];
$colors = $_POST["color"];
$items = $_POST["item"];
$nama = htmlspecialchars($_POST["nama"]);
$telp = $_POST['hp'];
$alamat = $_POST['alamat'];
$email = htmlspecialchars($_POST["email"]);

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->SMTPDebug = false;
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'astarypapalia@gmail.com';                     //SMTP username
    $mail->Password   = 'yqqqjtwyhdkkpslk';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('alvynpapalia@gmail.com', 'Merch Shop');
    $mail->addAddress($email, $nama);     //Add a recipient
    // $mail->addAddress('ellen@example.com');               //Name is optional
    // $mail->addReplyTo('info@example.com', 'Information');
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

    //Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    // $mail->addAttachment('');         //Add attachments
    // $mail->addAttachment('');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Order Your Clothes';
    $mail->Body    = '<b>Anda telah memesan pakaian!</b> dari Alvyn Papalia Merch Shop<br>
    <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Trial</title>
    <style type="text/css">
    .css {
        background-color: black;
        width: 95%;
        padding-top: 1rem;
        padding-bottom: 1rem;
        padding-left: 1rem;
        margin-top: 1rem;
        border-radius: 10px;
    }
    .css2 {
        background-image: url(logo.png);
        opacity: 0.8;
        background-repeat: no-repeat;
        background-position: center;
    }
    .border {
        border-bottom: 5px solid white;
        width: 95%;
    }
    h1, h3 {
        color: white;
    }
</style>
</head>
<body>
<div class="css">
<div class="css2">
<div class="border"><h1>' . $nama . '</h1></div>
<h3>Item pesanan anda adalah<br>
<br>
<table>
        <tr>
            <td><label>Nama Item</label></td>
            <td>:</td>
            <td>' . $items . '</td>
        </tr>
        <br>
        <tr>
            <td><label>Size</label></td>
            <td>:</td>
            <td>' . $sizes . '</td>
        </tr>
        <br>
        <tr>
            <td><label>Color</label></td>
            <td>:</td>
            <td>' . $colors . '</td>
        </tr>
        <br>
Dan tentang diri anda adalah
        <br>
        <tr>
            <td><label>Alamat</label></td>
            <td>:</td>
            <td>' . $alamat . '</td>
        </tr>
        <br>
        <tr>
            <td><label>No. HP</label></td>
            <td>:</td>
            <td>' . $telp . '</td>
        </tr>

</table>
<br>Jika ada yang kurang tepat, atau sekiranya pengiriman item yang anda pesan tidak tepat. hubungi kami via WhatsApp di 087881626354. Terimakasih..</h3>

</div>
</div>
</body>
</html>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    // echo 'Message has been sent';
    // echo "";
    header('location: page2_step2.html');
} catch (Exception $e) {
    // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    echo "<script>
                alert('Send failed! Masukan pesanan dan data diri anda dengan benar'); document.location.href = 'page2.html';
            </script>";
}
