<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

header('Content-Type: application/json');

// Allow only AJAX POST
if (
    $_SERVER['REQUEST_METHOD'] !== 'POST' ||
    empty($_SERVER['HTTP_X_REQUESTED_WITH']) ||
    strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) !== 'xmlhttprequest'
) {
    echo json_encode(['type' => 'error', 'text' => 'Invalid request']);
    exit;
}

require_once 'PHPMailer/Exception.php';
require_once 'PHPMailer/PHPMailer.php';
require_once 'PHPMailer/SMTP.php';

// Helper function
function clean($value)
{
    return trim(filter_var($value, FILTER_SANITIZE_SPECIAL_CHARS));
}

// Required fields
$user_Name    = clean($_POST['userName'] ?? '');
$user_Email   = filter_var($_POST['userEmail'] ?? '', FILTER_SANITIZE_EMAIL);
$user_Phone   = clean($_POST['userPhone'] ?? '');
$user_Message = clean($_POST['userMessage'] ?? '');

// Validation
if (strlen($user_Name) < 3) {
    echo json_encode(['type' => 'error', 'text' => 'Name is too short']);
    exit;
}

if (!filter_var($user_Email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['type' => 'error', 'text' => 'Invalid email address']);
    exit;
}

if (strlen($user_Message) < 5) {
    echo json_encode(['type' => 'error', 'text' => 'Message is too short']);
    exit;
}

// Optional fields
$data = [
    'Subject'        => clean($_POST['userSubject'] ?? ''),
    'City/Country'  => clean($_POST['userCity'] ?? ''),
    'Service'       => clean($_POST['service'] ?? ''),
    'Project Type'  => clean($_POST['projectType'] ?? ''),
    'Budget'        => clean($_POST['quoteBudget'] ?? ''),
];

// Mail config
$mail = new PHPMailer(true);

try {
    // SMTP settings
    $mail->isSMTP();
    $mail->Host       = 'mail.schelps.com.ng';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'esender@schelps.com.ng';
    $mail->Password   = 'Welcome2025@';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port       = 465;

    // Headers
    $mail->setFrom('esender@schelps.com.ng', 'SCHELPS Website');
    $mail->addReplyTo($user_Email, $user_Name);
    $mail->addAddress('sunkanmi@schelps.com.ng', 'Olasunkanmi Ogundele');

    // Content
    $mail->isHTML(true);
    $mail->Subject = 'New Contact Inquiry - SCHELPS';

    $body  = "<h3>New Website Inquiry</h3>";
    $body .= "<strong>Name:</strong> {$user_Name}<br>";
    $body .= "<strong>Email:</strong> {$user_Email}<br>";
    $body .= "<strong>Phone:</strong> {$user_Phone}<br>";

    foreach ($data as $label => $value) {
        if (!empty($value)) {
            $body .= "<strong>{$label}:</strong> {$value}<br>";
        }
    }

    $body .= "<br><strong>Message:</strong><br>";
    $body .= "<div style='background:#f4f6f8;padding:15px;border-radius:5px;'>";
    $body .= nl2br($user_Message);
    $body .= "</div>";

    $mail->Body    = $body;
    $mail->AltBody = $user_Message;

    $mail->send();

    echo json_encode([
        'type' => 'message',
        'text' => "Hi {$user_Name}, thank you for contacting SCHELPS."
    ]);

} catch (Exception $e) {
    echo json_encode([
        'type' => 'error',
        'text' => 'Mail sending failed. Please try again later.'
    ]);
}
