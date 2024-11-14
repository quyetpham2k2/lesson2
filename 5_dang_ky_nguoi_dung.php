<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Đăng Ký Người Dùng</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            display: flex;
            justify-content: center;
            height: 100vh;
            margin-top: 50px;
        }

        .form-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        label {
            font-weight: bold;
            display: block;
            margin-top: 10px;
        }

        input[type="text"],
        input[type="email"],
        input[type="tel"] {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .error {
            color: red;
            font-size: 0.9em;
        }

        .errorMessage,
        .success {
            color: green;
            text-align: center;
            font-weight: bold;
        }

        .errorMessage {
            color: red;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            border: none;
            color: white;
            font-size: 16px;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <div class="form-container">
        <h2>Đăng Ký Người Dùng</h2>

        <?php
        $nameErr = $emailErr = $phoneErr = "";
        $name = $email = $phone = "";
        $successMessage = "";
        $errorMessage = "";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $name = trim($_POST["name"]);
            $email = trim($_POST["email"]);
            $phone = preg_replace('/[^\d+]/', '', trim($_POST["phone"]));

            if (empty($name)) {
                $nameErr = "Tên không được để trống.";
            }
            if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Email không hợp lệ.";
            }
            if (empty($phone) || !preg_match('/^(?:\+(\d{10,15})|0\d{9})$/', $phone)) {
                $phoneErr = "Số điện thoại không hợp lệ!";
            }

            if (empty($nameErr) && empty($emailErr) && empty($phoneErr)) {
                $userExists = checkUserExists('5_users.json', $email, $phone);
                if ($userExists === "email") {
                    $errorMessage = "Email đã tồn tại!";
                } elseif ($userExists === "phone") {
                    $errorMessage = "Số điện thoại đã tồn tại!";
                } elseif ($userExists === "both") {
                    $errorMessage = "Cả email và số điện thoại đã tồn tại!";
                } else {
                    if (saveDataJSON('5_users.json', $name, $email, $phone)) {
                        $successMessage = "Đăng ký thành công!";
                        $name = $email = $phone = "";
                    } else {
                        $errorMessage = "Đã xảy ra lỗi khi lưu dữ liệu!";
                    }
                }
            }
        }

        function checkUserExists($filename, $email, $phone)
        {
            if (file_exists($filename)) {
                $data = json_decode(file_get_contents($filename), true);
            }

            if (is_array($data)) {
                $emailExists = false;
                $phoneExists = false;
                foreach ($data as $user) {
                    if ($user['email'] === $email) {
                        $emailExists = true;
                    }
                    if ($user['phone'] === $phone) {
                        $phoneExists = true;
                    }
                }

                if ($emailExists && $phoneExists) {
                    return "both";
                } elseif ($emailExists) {
                    return "email";
                } elseif ($phoneExists) {
                    return "phone";
                }
            }

            return false;
        }

        function saveDataJSON($filename, $name, $email, $phone)
        {
            $contact = array("name" => $name, "email" => $email, "phone" => $phone);
            $data = file_exists($filename) ? json_decode(file_get_contents($filename), true) : array();
            $data[] = $contact;

            return file_put_contents($filename, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        }
        ?>

        <?php if ($successMessage): ?>
            <p class="success"><?= $successMessage ?></p>
        <?php endif; ?>
        <?php if ($errorMessage): ?>
            <p class="errorMessage"><?= $errorMessage ?></p>
        <?php endif; ?>

        <form method="POST" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>">
            <label for="name">Tên người dùng:</label>
            <input type="text" id="name" name="name" value="<?= htmlspecialchars($name) ?>">
            <span class="error"><?= $nameErr ?></span>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?= htmlspecialchars($email) ?>">
            <span class="error"><?= $emailErr ?></span>

            <label for="phone">Số điện thoại:</label>
            <input type="tel" id="phone" name="phone" value="<?= htmlspecialchars($phone) ?>" minlength="10"
                maxlength="15">
            <span class="error"><?= $phoneErr ?></span>

            <button type="submit">Đăng Ký</button>
        </form>
    </div>
</body>

</html>