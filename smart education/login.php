<?php
// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo 'Method Not Allowed';
    exit();
}

// Database connection
$host = 'localhost';
$dbname = 'smart_education';
$username = 'root';
$password = ''; // Update with your actual database password

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

// Get POST data
$email = $_POST['s_email'] ?? '';
$password = $_POST['s_password'] ?? '';

// Validate input
if (empty($email) || empty($password)) {
    echo 'Please fill in both fields.';
    exit();
}

// Query to check user credentials
$sql = "SELECT * FROM student_info WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    
    // Verify password (make sure passwords are hashed in the database)
    if (password_verify($password, $user['password'])) {
        // Start session and redirect on success
        session_start();
        $_SESSION['email'] = $email;
        header('Location: homepage.html'); // Redirect to homepage or dashboard
        exit();
    } else {
        echo 'Invalid email or password.';
    }
} else {
    echo 'Invalid email or password.';
}

$stmt->close();
$conn->close();
?>
