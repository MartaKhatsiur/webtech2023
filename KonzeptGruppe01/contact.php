<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $visitor_name = "";
    $visitor_email = "";
    $email_title = "";
    $visitor_message = "";

    if (isset($_POST['visitor_name'])) {
        $visitor_name = filter_var($_POST['visitor_name'], FILTER_SANITIZE_STRING);
    }

    if (isset($_POST['visitor_email'])) {
        $visitor_email = str_replace(array("\r", "\n", "%0a", "%0d"), '', $_POST['visitor_email']);
        $visitor_email = filter_var($visitor_email, FILTER_VALIDATE_EMAIL);
    }

    if (isset($_POST['email_title'])) {
        $email_title = filter_var($_POST['email_title'], FILTER_SANITIZE_STRING);
    }

    if (isset($_POST['visitor_message'])) {
        $visitor_message = htmlspecialchars($_POST['visitor_message']);
    }

    $recipient = "martamiller004@gmail.com";

    $headers  = 'MIME-Version: 1.0' . "\r\n"
        . 'Content-type: text/html; charset=utf-8' . "\r\n"
        . 'From: ' . $visitor_email . "\r\n";

    $email_sent = mail($recipient, $email_title, $visitor_message, $headers);

    if ($email_sent) {
        header("Location: thanks.html");
        exit(); 
    } else {
        echo '<p>We are sorry but the email did not go through.</p>';
    }
} else {
    echo '<p>Something went wrong</p>';
}
?>
