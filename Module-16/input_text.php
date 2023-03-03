<?php

include_once "autoload.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer();
$a = false;
try {
    if (!empty($_POST)) {
        $newObjcTT = new TelegraphText('./text1');
        $newObjcTT->__set('author', $_POST["author"]);
        $newObjcTT->__set('text', $_POST["text"]);

        $newFS = new FileStorage();
        $newFS->create($newObjcTT);


//Load Composer's autoloader
        require './vendor/autoload.php';

//Create an instance; passing `true` enables exceptions


        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host = 'http://localhost/input_text.php';                     //Set the SMTP server to send through
        $mail->SMTPAuth = true;                                   //Enable SMTP authentication
        $mail->Username = 'seriaa4@gmail.com';                     //SMTP username
        $mail->Password = 'secret';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('seriaa4@gmail.com', 'Mailer');
        $mail->addAddress($_POST["email"]);
        $mail->send();
        $mail->isHTML(true);
        $mail->Subject = $_POST["author"];
        $mail->Body = $newFS;


        $a = true;
    }
} catch (Exception $e) {
}


?>
<html>
<head></head>
<body>

<?php

if ($a) {
    if ($_POST["text"] && $_POST["email"] && $_POST["author"]) {
        echo "<div style='background: green'>успех</div>";
    }
}
?>

<form action="input_text.php" method="post">
    <div>
        <input placeholder="email" name="email">
    </div>
    <div>
        <input placeholder="автор" name="author">
    </div>
    <div>
        <input placeholder="текст" name="text">

        <?php
        if (empty($_POST["email"])) {
            echo "<div style='background: red'>" . $mail->ErrorInfo . "</div>";
        }


        ?>

    </div>
    <div>
        <button type="submit">ok</button>
    </div>
</form>
</body>

</html>
