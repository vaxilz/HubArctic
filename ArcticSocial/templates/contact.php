
<!-- Page Content -->
<div class="container">

    <!-- Page Heading/Breadcrumbs -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Contact
                <small>Subheading</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="index.html">Home</a>
                </li>
            </ol>
        </div>
    </div>
    <!-- /.row -->

    <!-- Content Row -->
    <div class="row">
        <!-- Map Column -->
        <div class="col-md-8">
            <!-- Embedded Google Map -->
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2766.8260069608696!2d-64.80345798469769!3d46.094445499189!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4ca0b8d8ebffbbe3%3A0x6f50940a222b9b7!2sFlanders+Ct%2C+Moncton%2C+NB+E1C+0K6!5e0!3m2!1sen!2sca!4v1481739528113"
                    width="100%" height="400px" frameborder="0" style="border:0" allowfullscreen></iframe>
        </div>
        <!-- Contact Details Column -->
        <div class="col-md-4">
            <h3>Contact Details</h3>
            <p>
                New Brunswick, Canada<br>
            </p>
            <p><i class="fa fa-phone"></i> 
                <abbr title="Phone">Phone</abbr>: (506) 456-7890
            </p>
            <p><i class="fa fa-envelope-o"></i> 
                <abbr title="Email">Email</abbr>: <a href="">ArcticSocial@gmail.com</a>
            </p>
            <p><i class="fa fa-clock-o"></i> 

        </div>
    </div>
    <!-- /.row -->

    <!-- Contact Form -->
    <!-- In order to set the email address and subject line for the contact form go to the bin/contact_me.php file. -->
    <div class="row">
        <div class="col-md-8">
            <h3>Send us a Message</h3> 
            <?php
            if (!isset($_POST["submit"])) {
                ?>
                <form name="sentMessage" method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>" id="contactForm" novalidate>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Full Name:</label>
                            <input type="text" class="form-control" name="name" id="uname" required data-validation-required-message="Please enter your name.">
                            <p class="help-block"></p>
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Email Address:</label>
                            <input type="email" class="form-control" name="uemail" id="uemail" required data-validation-required-message="Please enter your email address.">
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Message:</label>
                            <input type="text" class="form-control" name="message"id="message" required data-validation-required-message="Please enter your message">
                        </div>
                    </div>
                    <input type="submit" name="submit" value="Send Email" class="btn btn-primary">
                </form>
                <?php
            } else {
                // the user has submitted the form'
                include("classes/class.phpmailer.php"); //you have to upload class files "class.phpmailer.php" and "class.smtp.php"
                $mail = new PHPMailer();
                
                $mail->IsSMTP();
                $mail->SMTPAuth = true;

                $mail->From = $_POST['uemail'];
                $mail->FromName = "demouser";

                $mail->AddAddress('bradley@vaxthinking.com', "Test");
                $mail->Subject = "This is the subject";
                $mail->Body = $_POST['message'];
                $mail->WordWrap = 50;
                $mail->IsHTML(true);
                $mail->Port = 25;
                $str1 = "gmail.com";
                $str2 = strtolower($_POST["name"]);
                var_dump($_POST);
                If (strstr($str2, $str1)) {
                    $mail->SMTPSecure = 'tls';
                    $mail->Port = 587;
                    if (!$mail->Send()) {
                        echo "Mailer Error: " . $mail->ErrorInfo;
                        echo "<br><br> * Please double check the user name and password to confirm that both of them are correct. <br><br>";
                        echo "* If you are the first time to use gmail smtp to send email, please refer to this link :http://www.smarterasp.net/support/kb/a1546/send-email-from-gmail-with-smtp-authentication-but-got-5_5_1-authentication-required-error.aspx?KBSearchID=137388";
                    } else {
                        echo "Message has been sent";
                    }
                } else {
                    $mail->Port = 25;
                    if (!$mail->Send()) {
                        echo "Mailer Error: " . $mail->ErrorInfo;
                        echo "<br><BR>* Please double check the user name and password to confirm that both of them are correct. <br>";
                        
                        echo $_POST['message'];
                    } else {
                        echo "Message has been sent";
                    }
                }
            }
                    ?>
        </div>

    </div>
    <!-- /.row -->

    <hr>