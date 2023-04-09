<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Get the form data
  $name = trim($_POST["contact-name"]);
  $email = trim($_POST["contact-email"]);
  $message = trim($_POST["contact-project"]);

  // Validate the form data
  if (empty($name) || empty($email) || empty($message)) {
    http_response_code(400);
    echo "Please fill in all the required fields.";
    exit;
  }

  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo "Please enter a valid email address.";
    exit;
  }

  // Set the recipient email address
  $to = "your-email@example.com"; // Replace with your own email address

  // Set the email subject and body
  $subject = "New message from $name";
  $body = "Name: $name\nEmail: $email\nMessage:\n$message";

  // Set the email headers
  $headers = "From: $name <$email>\r\n";
  $headers .= "Reply-To: $email\r\n";

  // Send the email
  if (mail($to, $subject, $body, $headers)) {
    http_response_code(200);
    echo "Thanks for your message! We'll get back to you soon.";
  } else {
    http_response_code(500);
    echo "Sorry, there was an error sending your message. Please try again later.";
  }
} else {
  http_response_code(405);
  echo "Method not allowed.";
}
