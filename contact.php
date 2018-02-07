
<?php
    // Define variables and set values
    $name = $email = $tel = $message = "";
    $nameError  = $emailTelError = $emailError = $telErrorFormat = $telErrorLength = $messageError = $contactSendStatus = "";
    $nameReady = $emailReady = $telReady = $emailPartReady = $telPartReady = $emailTelReady = $messageReady = false;

    if ( isset($_POST['submit']) ) {   
        
        // Check if input fields are empty and display relevant error message
        if (empty($_POST["name"])) {
            // $nameError = "<span class='contact-error'>" . "Please enter your name" . "</span>";
            $nameError = "*Please enter your name"."<br>";
            // echo $nameError;
        } else {
            $name = sanitize($_POST["name"]);
            if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
                $nameError = "*Only letters and spaces allowed for name"."<br>";
                // echo $nameError;
            } else {
                $nameReady = true;
            }
        }

        switch (true) {
            case (empty($_POST["email"]) && empty($_POST["tel"])):
                $emailTelError = "*Please enter your email address or phone number"."<br>";
                // echo $emailTelError;
                break;
            case (!empty($_POST["email"]) && empty($_POST["tel"])):
                $email = sanitize($_POST["email"]);
                // echo $email;
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $emailError = "*Invalid email format"."<br>";
                    // echo $email;
                } else {
                    $emailReady = true;
                }
                // echo "tel empty";
                break;
            case (empty($_POST["email"]) && !empty($_POST["tel"])):
                $tel = sanitize($_POST["tel"]);
                // echo $tel;
                if (!preg_match("/^[0-9]*$/",$tel)) {
                    $telErrorFormat = "*Please only enter numbers in the phone number field"."<br>";
                    // echo $telErrorFormat;
                } else if (strlen($tel) < 8) {
                    $telErrorLength = "*Please enter a phone number of at least 8 digits"."<br>";
                    // echo $telErrorLength;
                } else {
                    $telReady = true;
                }
                // echo "email empty";
                break;
            case (!empty($_POST["email"]) && !empty($_POST["tel"])):
                $email = sanitize($_POST["email"]);
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $emailError = "*Invalid email format"."<br>";
                    // echo $emailError;
                } else {
                    $emailPartReady = true;
                }
                $tel = sanitize($_POST["tel"]);
                if (!preg_match("/^[0-9]*$/",$tel)) {
                    $telErrorFormat = "*Please only enter numbers in the phone number field"."<br>";
                    // echo $telErrorFormat;
                } else if (strlen($tel) < 8) {
                    $telErrorLength = "*Please enter a phone number of at least 8 digits"."<br>";
                    // echo $telErrorLength;
                } else {
                    $telPartReady = true;
                }
                // echo "neither empty";
                if ($emailPartReady && $telPartReady) {
                    $emailTelReady = true;
                }
                break;
        }

        if (empty($_POST["message"])) {
            $messageError = "*Please enter your message"."<br>";
        } else {
            $message = sanitize($_POST["message"]);
            if (strlen($message) < 10) {
                $messageError = "*Please enter at least 10 characters in your message"."<br>";
                // echo $messageError;
            } else {
                $message = wordwrap($message, 70, "\r\n");
                $messageReady = true;
            }
        }

        if ($nameReady && ($emailReady || $telReady || $emailTelReady) && $messageReady) {
            $headers = "Name: " . $name . "\r\n" . "Email: " . $email . "\r\n" . "Phone Number: " . $tel . "\r\n";
            if (mail('chrisau233@gmail.com', 'Customer enquiry from website', $message, $headers)) {
                $contactSendStatus = "<span style='color:#00AA00;'>Message sent, thanks you'll hear from us soon</span>";
            } else {
                $contactSendStatus = "Hmm, the message didn't send. Try hitting 'Send Message' again";
            }
        }
    }

// Define function to sanitize field inputs for security purposes
function sanitize($inputField) {
    $inputField = htmlspecialchars($inputField);
    $inputField = trim($inputField);
    $inputField = stripslashes($inputField);
    return $inputField;
}

?>