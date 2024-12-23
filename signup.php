<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Anime Style</title>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;700&display=swap" rel="stylesheet">
    <style>
        /* CSS styling as per original code */
        body {
            font-family: 'Raleway', sans-serif;
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            background-color: #f4f4f9;
        }

        .background {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('bg.jpg'); /* Adjusted for relative path */
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
        .form-container input[type="email"],
        .form-container input[type="password"],
        .form-container input[type="checkbox"] {
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

        .terms {
            font-size: 12px;
            color: #555;
        }

        .terms a {
            color: #7d5fff;
            text-decoration: none;
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

    <?php
    // Konfigurasi koneksi database
    $servername = "localhost"; // Ganti dengan nama host database Anda
    $usernameDB = "root"; // Ganti dengan username database Anda
    $passwordDB = ""; // Ganti dengan password database Anda
    $dbname = "userr"; // Ganti dengan nama database Anda
        
    // Membuat koneksi ke database
    $conn = new mysqli($servername, $usernameDB, $passwordDB, $dbname);
        
    // Cek koneksi
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    // Inisialisasi variabel
    $username = $email = $password = $confirmPassword = "";
    $error = "";
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = htmlspecialchars($_POST['username']);
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);
        $confirmPassword = htmlspecialchars($_POST['confirmPassword']);
    
        // Validasi password
        if ($password !== $confirmPassword) {
            $error = "Passwords do not match!";
        } elseif (strlen($password) < 6) {
            $error = "Password must be at least 6 characters!";
        } else {
            // Hash password untuk keamanan
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        
            // Query SQL untuk menyimpan data ke tabel users
            $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
        
            if ($stmt) {
                $stmt->bind_param("sss", $username, $email, $hashedPassword);
            
                // Eksekusi query
                if ($stmt->execute()) {
                    $error = "Registration successful! Welcome to Anime World!";
                    // Reset input untuk keamanan
                    $username = $email = "";
                } else {
                    // Cek jika email sudah terdaftar
                    if ($conn->errno === 1062) {
                        $error = "Email already exists. Please use another one.";
                    } else {
                        $error = "Error: " . $stmt->error;
                    }
                }
                $stmt->close();
            } else {
                $error = "Error preparing query: " . $conn->error;
            }
        }
    }
    
    $conn->close();
    ?>

</head>
<body>
    <!-- Background and overlay -->
    <div class="background"></div>
    <div class="overlay"></div>

    <!-- Sign-up form -->
    <div class="form-container">
        <h1>Sign Up</h1>
        <?php if ($error): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>
        <form id="signupForm" action="" method="post">
            <input type="text" id="username" name="username" placeholder="Username" value="<?php echo $username; ?>" required>
            <input type="email" id="email" name="email" placeholder="Email" value="<?php echo $email; ?>" required>
            <input type="password" id="password" name="password" placeholder="Password" required>
            <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Confirm Password" required>
            <div>
                <input type="checkbox" id="terms" name="terms" required>
                <label for="terms" class="terms">I agree with the <a href="#">terms of service</a></label>
            </div>
            <button type="submit">Register</button>
        </form>
        <div class="login-link">
            Already a member? <a href="login.php">Login here</a>
        </div>
    </div>
</body>
</html>
