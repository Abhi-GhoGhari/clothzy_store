<?php
session_start();

$error = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'db.php';

    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        
        header("Location: index.php");
        exit;
    } else {
        $error = "Invalid username or password.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Login - Clothzy Store</title>
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
        table.login-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 20px;
        }
        table.login-table td {
            vertical-align: middle;
        }
        table.login-table label {
            font-weight: 600;
            font-size: 1.05rem;
            color: #333;
            display: block;
            margin-bottom: 6px;
            min-width: 100%;
        }
        table.login-table input[type="text"],
        table.login-table input[type="password"] {
            width: 100%;
            padding: 10px 14px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 1rem;
            font-family: 'Inter', sans-serif;
            color: #0b1226;
            transition: box-shadow 0.3s ease;
        }
        table.login-table input[type="text"]:focus,
        table.login-table input[type="password"]:focus {
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
        p.signup-text {
            text-align: center;
            margin-top: 1.2rem;
            color: #0b1226;
            font-size: 1rem;
        }
        p.signup-text a {
            color: #c9a34a;
            font-weight: 700;
            text-decoration: none;
        }
        p.signup-text a:hover {
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
        <h1>Clothzy Store - Login</h1>
    </header>
    <main class="container">
        <form action="login.php" method="POST" class="product-form" autocomplete="off">
            <h2>Login to Your Account</h2>
            <?php if ($error): ?>
                <div class="error-msg"><?php echo htmlspecialchars($error); ?></div>
            <?php endif; ?>
            <table class="login-table">
                <tr>
                    <td>
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" required />
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
                        <button type="submit" class="btn">Login</button>
                    </td>
                </tr>
            </table>
            <p class="signup-text">Don't have an account? <a href="signup.php">Sign up here</a></p>
        </form>
    </main>
</body>
</html>
