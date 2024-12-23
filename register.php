<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "uas";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirmPassword = $_POST['confirmPassword'];

// Debugging bagian ini
if (empty($username) || empty($email) || empty($password)) {
    echo "All fields are required.";
    exit;
}

if ($password !== $confirmPassword) {
    echo "Passwords do not match.";
    exit;
}

$hashedPassword = password_hash($password, PASSWORD_BCRYPT);
$browser = $_SERVER['HTTP_USER_AGENT'];
$ipAddress = $_SERVER['REMOTE_ADDR'];

// Tambahkan debug
echo "Username: $username, Email: $email, Hashed Password: $hashedPassword, Browser: $browser, IP: $ipAddress";

// Insert data into database
$sql = "INSERT INTO users (username, email, password, browser, ip_address) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssss", $username, $email, $hashedPassword, $browser, $ipAddress);

if ($stmt->execute()) {
    echo "Registration successful.";
} else {
    echo "Error: " . $stmt->error;
}


$stmt->close();
$conn->close();
?>

<?php
require_once 'User.php';

// Inisialisasi objek User
$user = new User();

// Tangkap data dari form
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirmPassword = $_POST['confirmPassword'];

// Validasi input
if (empty($username) || empty($email) || empty($password)) {
    echo "All fields are required.";
    exit;
}

if ($password !== $confirmPassword) {
    echo "Passwords do not match.";
    exit;
}

// Daftarkan user
echo $user->register($username, $email, $password);
?>
