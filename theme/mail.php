<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    # FIX: Replace this email with recipient email
    $mail_to = "timnewark@hotmail.com";
    
    # Sender Data
    $name = str_replace(array("\r","\n"),array(" "," ") , strip_tags(trim($_POST["name"])));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $phone = trim($_POST["subject"]); // Assuming this is meant to be a phone field
    $message = trim($_POST["message"]);
    $subject = "Contact Form Submission"; // Assuming you want a static subject for now
    
    if ( empty($name) OR !filter_var($email, FILTER_VALIDATE_EMAIL) OR empty($phone) OR empty($message)) {
        # Set a 400 (bad request) response code and exit.
        http_response_code(400);
        echo "Please complete the form and try again.";
        exit;
    }
    
    # Mail Content
    $content = "Name: $name\n";
    $content .= "Phone: $phone\n";
    $content .= "Email: $email\n\n";
    $content .= "Message:\n$message\n";

    # Email headers.
    $headers = "From: $name <$email>";

    # Send the email.
    $success = mail($mail_to, $subject, $content, $headers);
    if ($success) {
        # Set a 200 (okay) response code.
        http_response_code(200);
        echo "Thank You! Your message has been sent.";
    } else {
        # Set a 500 (internal server error) response code.
        http_response_code(500);
        echo "Oops! Something went wrong, we couldn't send your message.";
    }

} else {
    # Not a POST request, set a 403 (forbidden) response code.
    http_response_code(403);
    echo "There was a problem with your submission, please try again.";
}
?>
