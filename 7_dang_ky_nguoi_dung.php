<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Ký Người Dùng</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 500px;
            margin: 50px auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            font-size: 16px;
            color: #555;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            padding: 10px;
            font-size: 16px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .error {
            color: red;
            font-size: 14px;
            margin-bottom: 10px;
        }

        button {
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Đăng Ký Người Dùng</h1>

        <?php
        $errors = [];
        $username = $email = $password = "";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $username = trim($_POST["username"]);
            $email = trim($_POST["email"]);
            $password = trim($_POST["password"]);

            if (empty($username)) {
                $errors[] = "Tên người dùng không được để trống.";
            }
            if (empty($email)) {
                $errors[] = "Email không được để trống.";
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = "Email không hợp lệ.";
            }
            if (empty($password)) {
                $errors[] = "Mật khẩu không được để trống.";
            } elseif (strlen($password) < 8) {
                $errors[] = "Mật khẩu phải có ít nhất 8 ký tự.";
            }

            if (empty($errors)) {
                $userData = [
                    'username' => $username,
                    'email' => $email,
                    'password' => password_hash($password, PASSWORD_DEFAULT)
                ];


                $file = '7_users.json';
                $users = file_exists($file) ? json_decode(file_get_contents($file), true) : [];
                $users[] = $userData;

                file_put_contents($file, json_encode($users, JSON_PRETTY_PRINT));
                echo "<p style='color: green;'>Đăng ký thành công!</p>";
            }
        }
        ?>

        <form method="POST" action="">
            <label for="username">Tên người dùng:</label>
            <input type="text" id="username" name="username"
                value="<?= empty($errors) ? "" : htmlspecialchars($username) ?>" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?= empty($errors) ? "" : htmlspecialchars($email) ?>"
                required>

            <label for="password">Mật khẩu:</label>
            <input type="password" id="password" name="password" required>

            <?php if (!empty($errors)): ?>
                <div class="error">
                    <ul>
                        <?php foreach ($errors as $error): ?>
                            <li><?= $error ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <button type="submit">Đăng ký</button>
        </form>
    </div>
</body>

</html>