<?php
session_start(); // Memulai session

$servername = "localhost"; // Nama host database Anda
$usernameDB = "root"; // Username database Anda
$passwordDB = ""; // Password database Anda
$dbname = "userr"; // Nama database Anda

// Membuat koneksi ke database
$conn = new mysqli($servername, $usernameDB, $passwordDB, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fungsi untuk memproses login
function processLogin($username, $password, $conn) {
    if (empty($username) || empty($password)) {
        return "All fields are required.";
    }

    // Query untuk mendapatkan data user berdasarkan username
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();

            // Verifikasi password
            if (password_verify($password, $user['password'])) {
                // Simpan data user ke session
                $_SESSION['user_id'] = $user['id'];  
                $_SESSION['username'] = $user['username'];

                // Redirect ke halaman utama
                header("Location: Tabel.php");
                exit();
            } else {
                return "Invalid password.";
            }
        } else {
            return "Username not found.";
        }
    } else {
        return "Database query error.";
    }
}

// Proses login saat form dikirim
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Memproses login dan menangkap error jika ada
    $errorMessage = processLogin($username, $password, $conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Anime Style</title>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Raleway', sans-serif;
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f4f4f9;
        }

        .background {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('bg.jpg');
            background-size: cover;
            background-position: center;
            filter: blur(8px);
            z-index: -1;
        }

        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 0;
        }

        .form-container {
            position: relative;
            background-color: #ffffff;
            box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.1);
            border-radius: 15px;
            padding: 30px;
            width: 350px;
            text-align: center;
            z-index: 1;
            border: 2px solid #7d5fff;
        }

        .form-container h1 {
            color: #7d5fff;
            font-size: 28px;
            margin-bottom: 25px;
        }

        .form-container input[type="text"],
        .form-container input[type="password"] {
            width: 100%;
            padding: 12px;
            margin: 12px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }

        .form-container button {
            background-color: #7d5fff;
            color: #ffffff;
            border: none;
            padding: 12px 20px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .form-container button:hover {
            background-color: #5a3cb4;
        }

        .error {
            color: red;
            font-size: 14px;
            margin-top: -10px;
            margin-bottom: 10px;
        }

        .login-link {
            margin-top: 15px;
            font-size: 14px;
            color: #555;
        }

        .login-link a {
            color: #7d5fff;
            text-decoration: none;
            font-weight: bold;
        }

        .login-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="background"></div>
    <div class="overlay"></div>

    <div class="form-container">
        <h1>Login</h1>
        <form method="POST" action="login.php">
            <input type="text" id="username" name="username" placeholder="Username" required>
            <input type="password" id="password" name="password" placeholder="Password" required>
            <div id="error-message" class="error">
                <?php if (isset($errorMessage)) echo $errorMessage; ?>
            </div>
            <button type="submit">Login</button>
        </form>
        <div class="login-link">
            Don't have an account? <a href="signup.php">Sign up here</a>
        </div>
    </div>
</body>
</html>
