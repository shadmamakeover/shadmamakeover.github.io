<?php
// backend.php - Contact form handler for Shadma Makeup Artist Website

// Enable error reporting for development (disable in production)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Set headers for JSON response and CORS
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

// Only allow POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode([
        'success' => false,
        'message' => 'Method not allowed. Only POST requests are accepted.'
    ]);
    exit;
}

// Function to sanitize input data
function sanitizeInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
    return $data;
}

// Function to validate email
function isValidEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

// Function to validate phone number (Indian format)
function isValidPhone($phone) {
    if (empty($phone)) return true; // Phone is optional
    $phone = preg_replace('/\s+/', '', $phone); // Remove spaces
    return preg_match('/^[6-9]\d{9}$/', $phone);
}

// Function to validate name
function isValidName($name) {
    return strlen($name) >= 2 && preg_match('/^[a-zA-Z\s]+$/', $name);
}

// Function to log form submissions (for record keeping)
function logSubmission($data) {
    $logFile = 'submissions.log';
    $timestamp = date('Y-m-d H:i:s');
    $logEntry = "[$timestamp] " . json_encode($data) . PHP_EOL;

    // Try to write to log file
    $logHandle = fopen($logFile, 'a');
    if ($logHandle) {
        fwrite($logHandle, $logEntry);
        fclose($logHandle);
    }
}

// Function to send email notification
function sendNotificationEmail($formData) {
    $to = 'hello@shadma-makeup.com'; // Replace with actual email
    $subject = 'New Contact Form Submission - Shadma Makeup Artist';

    // Create email body
    $message = "New contact form submission received:\n\n";
    $message .= "Name: " . $formData['name'] . "\n";
    $message .= "Email: " . $formData['email'] . "\n";
    $message .= "Phone: " . ($formData['phone'] ?: 'Not provided') . "\n";
    $message .= "Service: " . ($formData['service'] ?: 'Not specified') . "\n";
    $message .= "Message: " . ($formData['message'] ?: 'No message') . "\n\n";
    $message .= "Submitted at: " . date('Y-m-d H:i:s') . "\n";
    $message .= "---\nThis is an automated message from your website.";

    $headers = 'From: website@shadma-makeup.com' . "\r\n" .
               'Reply-To: ' . $formData['email'] . "\r\n" .
               'X-Mailer: PHP/' . phpversion();

    // Try to send email (you may need to configure SMTP settings)
    return mail($to, $subject, $message, $headers);
}

// Function to send confirmation email to user
function sendConfirmationEmail($formData) {
    $to = $formData['email'];
    $subject = 'Thank you for contacting Shadma - Your Beauty Journey Begins!';

    $message = "Dear " . $formData['name'] . ",\n\n";
    $message .= "Thank you for reaching out to me! I'm excited to help you discover your most beautiful self.\n\n";
    $message .= "I've received your message and will get back to you within 24 hours to discuss your beauty vision.\n\n";
    $message .= "Here's what you shared:\n";
    if ($formData['service']) {
        $message .= "- Service of interest: " . $formData['service'] . "\n";
    }
    if ($formData['message']) {
        $message .= "- Your message: " . substr($formData['message'], 0, 200) . "...\n";
    }
    $message .= "\n";
    $message .= "In the meantime, feel free to follow my journey on social media for beauty tips and inspiration:\n";
    $message .= "- Instagram: @shadma_makeup\n";
    $message .= "- YouTube: @shadma_makeup\n\n";
    $message .= "Looking forward to creating something beautiful together!\n\n";
    $message .= "With beauty and grace,\n";
    $message .= "Shadma\n";
    $message .= "Professional Makeup Artist\n";
    $message .= "+91 98765 43210\n\n";
    $message .= "---\nThis is an automated confirmation email.";

    $headers = 'From: Shadma Makeup Artist <hello@shadma-makeup.com>' . "\r\n" .
               'Reply-To: hello@shadma-makeup.com' . "\r\n" .
               'X-Mailer: PHP/' . phpversion();

    return mail($to, $subject, $message, $headers);
}

try {
    // Get and sanitize form data
    $formData = [
        'name' => isset($_POST['name']) ? sanitizeInput($_POST['name']) : '',
        'email' => isset($_POST['email']) ? sanitizeInput($_POST['email']) : '',
        'phone' => isset($_POST['phone']) ? sanitizeInput($_POST['phone']) : '',
        'service' => isset($_POST['service']) ? sanitizeInput($_POST['service']) : '',
        'message' => isset($_POST['message']) ? sanitizeInput($_POST['message']) : ''
    ];

    // Validation
    $errors = [];

    // Required field validation
    if (empty($formData['name'])) {
        $errors[] = 'Name is required';
    } elseif (!isValidName($formData['name'])) {
        $errors[] = 'Please enter a valid name (letters and spaces only)';
    }

    if (empty($formData['email'])) {
        $errors[] = 'Email is required';
    } elseif (!isValidEmail($formData['email'])) {
        $errors[] = 'Please enter a valid email address';
    }

    if (!isValidPhone($formData['phone'])) {
        $errors[] = 'Please enter a valid 10-digit phone number';
    }

    // Check for validation errors
    if (!empty($errors)) {
        http_response_code(400);
        echo json_encode([
            'success' => false,
            'message' => 'Validation failed: ' . implode(', ', $errors)
        ]);
        exit;
    }

    // Log the submission
    logSubmission($formData);

    // Send notification email to business owner
    $notificationSent = sendNotificationEmail($formData);

    // Send confirmation email to user
    $confirmationSent = sendConfirmationEmail($formData);

    // Success response
    echo json_encode([
        'success' => true,
        'message' => 'Thank you! Your message has been sent successfully. I\'ll get back to you soon.',
        'notification_sent' => $notificationSent,
        'confirmation_sent' => $confirmationSent
    ]);

} catch (Exception $e) {
    // Log the error
    error_log('Contact form error: ' . $e->getMessage());

    // Error response
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Sorry, there was an error processing your request. Please try again later or contact me directly.'
    ]);
}
?>
