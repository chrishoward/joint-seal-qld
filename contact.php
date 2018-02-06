<?php
    // Define variables and set values
    $name = $email = $tel = $message = "";
    $nameError = $emailError = $telErrorFormat = $telErrorLength = $emailTelError = $messageError = "";

    if ( isset($_POST['submit']) ) {   
        
        // Check if input fields are empty and display relevant error message
        if (empty($_POST["name"])) {
            $nameError = "Please enter your name";
            // echo $nameError;
        } else {
            $name = sanitize($_POST["name"]);
            if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
                $nameError = "Only letters and spaces allowed";
                // echo $nameError;
            }
        }

        // if (empty($_POST["email"]) && empty($_POST["tel"])) {
        //     $nameTelError = "Please enter your email address or phone number";
        // } else {
        //     $email = sanitize($_POST["name"]);
        // }

        switch (true) {
            case (empty($_POST["email"]) && empty($_POST["tel"])):
                $emailTelError = "Please enter your email address or phone number";
                // echo $emailTelError;
                break;
            case (!empty($_POST["email"]) && empty($_POST["tel"])):
                $email = sanitize($_POST["email"]);
                // echo $email;
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $emailError = "Invalid email format";
                    // echo $email;
                }
                // echo "tel empty";
                break;
            case (empty($_POST["email"]) && !empty($_POST["tel"])):
                $tel = sanitize($_POST["tel"]);
                // echo $tel;
                if (!preg_match("/^[0-9]*$/",$tel)) {
                    $telErrorFormat = "Only numbers allowed";
                    // echo $telErrorFormat;
                }
                if (strlen($tel) < 8) {
                    $telErrorLength = "Please enter a phone number of at least 8 digits";
                    // echo $telErrorLength;
                }
                // echo "email empty";
                break;
            case (!empty($_POST["email"]) && !empty($_POST["tel"])):
                $email = sanitize($_POST["email"]);
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $emailError = "Invalid email format";
                    echo $emailError;
                }
                $tel = sanitize($_POST["tel"]);
                if (!preg_match("/^[0-9]*$/",$tel)) {
                    $telErrorFormat = "Only numbers allowed";
                    echo $telErrorFormat;
                }
                if (strlen($tel) < 8) {
                    $telErrorLength = "Please enter a phone number of at least 8 digits";
                    echo $telErrorLength;
                }
                // echo "neither empty";
                break;
        }

        if (empty($_POST["message"])) {
            $messageError = "Please enter your message";
        } else {
            $message = sanitize($_POST["message"]);
            if (strlen($message) < 10) {
                $messageError = "Please enter at least 10 characters in your message";
                echo $messageError;
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

            // // Sanitize all field inputs
            // $name = sanitize($_POST["name"]);
            // $email = sanitize($_POST["email"]);
            // $tel = sanitize($_POST["tel"]);
            // $message = sanitize($_POST["message"]);
        
            // echo $name . "<br>";
            // echo $email . "<br>";
            // echo $tel . "<br>";
            // echo $message . "<br>";

?>