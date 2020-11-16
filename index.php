<?php

    use PHPMailer\PHPMailer\PHPMailer;

    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';

    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $user = filter_var($_POST['username'],FILTER_SANITIZE_STRING);
        $email = filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
        $phone = filter_var($_POST['phone'],FILTER_SANITIZE_NUMBER_INT);
        $message = filter_var($_POST['message'],FILTER_SANITIZE_STRING);

        $formErrors = array();

        if(strlen($user) <= 3){
            $formErrors[] = 'Username Must Be More Than <Strong>3</Strong> Characters.';
        }
        if(strlen($message) < 10){
            $formErrors[] = 'Message Can\'t Be Less Than <Strong>10</Strong> Characters.';
        }

        if(empty($formErrors)){

            $mail = new PHPMailer(true);
            // SMTP configuration
            //$mail->SMTPDebug = 2;
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = gethostbyname('ssl://smtp.gmail.com');                    // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = '*******';                     // SMTP username
            $mail->Password   = '*******';                               // SMTP password
            $mail->SMTPSecure = 'tls';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = 465;

            $mail->setFrom($email, $user);
            $mail->addAddress('*******');
            $mail->Subject = 'Send Email via SMTP using PHPMailer';
            $mail->isHTML(true);
            $mail->Body = $message;

            try {
                if (!$mail->send()) {
                    echo 'Message could not be sent.';
                    echo 'Mailer Error: ' . $mail->ErrorInfo;
                } else {

                    $user = '';
                    $email = '';
                    $message = '';
                    $phone = '';

                    $success = '<div class="alert alert-success">We Have Received Your Message.</div>';

                }
            } catch (\PHPMailer\PHPMailer\Exception $e) {

            }
        }

    }

?>


<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Contact Form</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="ContactForm.css">
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <!-- start form -->

    <div class="container">
        <h1 class="text-center"> Contact Me</h1>
        <form class="contact-form" action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
                <?php if(!empty($formErrors)){ ?>
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <?php
                        foreach ($formErrors as $error){
                            echo $error . '<br/>';
                        }
                        ?>
                    </div>
                <?php } ?>
                <?php if(isset($success)){echo $success;}?>
            <div class="form-group">
                <input class=" username form-control"
                       name="username"
                       type="text"
                       placeholder="Type Your Username"
                       value="<?php if(isset($user)) {echo $user;} ?>"/>
                <i class="fa fa-user fa-fw"></i>
                <span class="asterisk">*</span>
                <div class="alert alert-danger custom-alert">
                    Username Must Be More Than <Strong>3</Strong> Characters.
                </div>
            </div>
            <div class="form-group">
                <input class=" email form-control"
                       name="email"
                       type="email"
                       placeholder="Please Type A Valid Email"
                       value="<?php if(isset($email)) {echo $email;} ?>"/>
                <i class="fa fa-envelope fa-fw"></i>
                <span class="asterisk">*</span>
                <div class="alert alert-danger custom-alert">
                    Email Can't Be Empty.
                </div>
            </div>
            <div class="form-group">
                <input class="form-control"
                       name="phone"
                       type="text"
                       placeholder="Type Your Phone Number"
                       value="<?php if(isset($phone)) {echo $phone;} ?>"/>
                <i class="fa fa-phone fa-fw"></i>
            </div>
            <div class="form-group">
                <textarea class=" message form-control"
                          name="message"
                          type="text"
                          placeholder="Your Message !"><?php if(isset($message)) {echo $message;} ?></textarea>
                <div class="alert alert-danger custom-alert">
                    Message Can't Be Less Than <Strong>10</Strong> Characters.
                </div>
            </div>
            <input class="btn btn-success btn"
                   type="submit"
                   value="Send Message"/>
            <i class="fa fa-send fa-fw sendIcon"></i>
        </form>
    </div>

    <!-- end form -->

    <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
    <script src="custom.js"></script>

</body>

</html>