<?php
session_start();

$error = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'db.php';

    $username = $_POST['username'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    try {
        $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$username, $email, $hashed_password]);

        header("Location: login.php");
        exit;
    } catch (PDOException $e) {
        if ($e->getCode() == 23000) {
            $error = "Username or email already exists.";
        } else {
            $error = "An error occurred: " . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Sign Up - Clothzy Store</title>
    <link rel="stylesheet" href="style.css" />
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f8f5f0;
            margin: 30px;
            color: #0b1226;
        }
        header h1 {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 30px;
            color: #c9a34a;
            text-align: center;
        }
        main.container {
            max-width: 400px;
            margin: 0 auto;
            background: white;
            padding: 25px 30px;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgb(201 163 74 / 0.3);
        }
        form.product-form h2 {
            text-align: center;
            margin-bottom: 20px;
            font-family: 'Playfair Display', serif;
            color: #c9a34a;
            font-weight: 700;
            font-size: 1.8rem;
        }
        table.signup-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 20px;
        }
        table.signup-table td {
            vertical-align: middle;
        }
        table.signup-table label {
            font-weight: 600;
            font-size: 1.05rem;
            color: #333;
            display: block;
            margin-bottom: 6px;
            min-width: 100%;
        }
        table.signup-table input[type="text"],
        table.signup-table input[type="email"],
        table.signup-table input[type="password"] {
            width: 100%;
            padding: 10px 14px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 1rem;
            font-family: 'Inter', sans-serif;
            color: #0b1226;
            transition: box-shadow 0.3s ease;
        }
        table.signup-table input[type="text"]:focus,
        table.signup-table input[type="email"]:focus,
        table.signup-table input[type="password"]:focus {
            box-shadow: 0 0 8px #c9a34a;
            border-color: #c9a34a;
            outline: none;
        }
        button.btn {
            background-color: #c9a34a;
            color: #0b1226;
            font-weight: 700;
            font-size: 1.2rem;
            padding: 12px 0;
            width: 100%;
            border: none;
            border-radius: 30px;
            cursor: pointer;
            margin-top: 20px;
            transition: background-color 0.3s ease;
        }
        button.btn:hover {
            background-color: #0b1226;
            color: #c9a34a;
            box-shadow: 0 0 15px #c9a34a;
        }
        p.login-text {
            text-align: center;
            margin-top: 1.2rem;
            color: #0b1226;
            font-size: 1rem;
        }
        p.login-text a {
            color: #c9a34a;
            font-weight: 700;
            text-decoration: none;
        }
        p.login-text a:hover {
            text-decoration: underline;
        }
        .error-msg {
            background-color: #330000;
            color: #ff4d4d;
            padding: 10px 15px;
            border-radius: 8px;
            font-weight: 700;
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <header>
        <h1>Clothzy Store - Sign Up</h1>
    </header>
    <main class="container">
        <form action="signup.php" method="POST" class="product-form" autocomplete="off">
            <h2>Create an Account</h2>
            <?php if ($error): ?>
                <div class="error-msg"><?php echo htmlspecialchars($error); ?></div>
            <?php endif; ?>
            <table class="signup-table">
                <tr>
                    <td>
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" required />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" required />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" required />
                    </td>
                </tr>
                <tr>
                    <td>
                        <button type="submit" class="btn">Sign Up</button>
                    </td>
                </tr>
            </table>
            <p class="login-text">Already have an account? <a href="login.php">Login here</a></p>
        </form>
    </main>
</body>
</html>
