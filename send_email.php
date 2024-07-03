<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $contact = $_POST['contact'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    $date = $_POST['appointmentDate'];
    $time = $_POST['appointmentTime'];

    // Compose the email message
    $to = "manidumaneeshaww@gmail.com";
    $subject = "New Appointment Request";
    $emailMessage = "First Name: $firstName\nLast Name: $lastName\nContact: $contact\nEmail: $email\nMessage: $message\nDate: $date\nTime: $time";

    // Initialize PHPMailer
    $mail = new PHPMailer(true);
    try {
        // Configure SMTP settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'ypremium.in1@gmail.com';
        $mail->Password = 'vgjjpcoakjfprtip';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Set email properties for the recipient
        $mail->setFrom($email, "$firstName $lastName");
        $mail->addAddress($to);
        $mail->Subject = $subject;
        $mail->Body = $emailMessage;

        // Send the email to the recipient
        $mail->send();

        // Clear all recipients and attachments for the next email
        $mail->clearAddresses();
        $mail->clearAttachments();

        // Set email properties for the sender
        $mail->addAddress($email); // Send a copy to the sender
        $mail->Subject = "Appointment Request Confirmation";
        $mail->Body = "Dear $firstName $lastName,\n\nThank you for your appointment request. Here are the details you submitted:\n\n$emailMessage\n\nWe will contact you soon to confirm your appointment.\n\nBest regards,\nManidu Team";

        // Send the email to the sender
        $mail->send();

        echo "Thank you for your appointment request! We will contact you soon.";
    } catch (Exception $e) {
        echo "Oops! Something went wrong. Please try again. " . $mail->ErrorInfo;
    }
}
?>
