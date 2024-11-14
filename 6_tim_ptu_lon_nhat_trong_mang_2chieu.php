<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tìm phần tử lớn nhất trong ma trận</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f4f8;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 100%;
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
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
            gap: 10px;
        }

        label {
            font-size: 16px;
            color: #555;
        }

        input[type="number"] {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
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

        .matrix-inputs {
            display: grid;
            gap: 10px;

            margin-top: 32px;
        }

        .result {
            margin-top: 20px;
            font-size: 18px;
            font-weight: bold;
            color: #333;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Tìm phần tử lớn nhất trong ma trận</h1>

        <?php
        $maxValue = null;
        $maxRow = -1;
        $maxCol = -1;
        $rows = 0;
        $cols = 0;
        $matrix = [];

        if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["rows"]) && isset($_GET["cols"])) {
            $rows = intval($_GET['rows']);
            $cols = intval($_GET['cols']);
        }

        if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["matrix"])) {
            $index = 0;
            for ($i = 0; $i < $rows; $i++) {
                for ($j = 0; $j < $cols; $j++) {
                    $matrix[$i][$j] = floatval($_GET["matrix"][$index]);
                    $index++;
                }
            }

            $maxValue = $matrix[0][0];
            $maxRow = 0;
            $maxCol = 0;

            for ($i = 0; $i < $rows; $i++) {
                for ($j = 0; $j < $cols; $j++) {
                    if ($matrix[$i][$j] > $maxValue) {
                        $maxValue = $matrix[$i][$j];
                        $maxRow = $i;
                        $maxCol = $j;
                    }
                }
            }
        }
        ?>

        <?php if ($rows <= 0 || $cols <= 0): ?>
            <form>
                <label for="rows">Nhập số dòng của ma trận:</label>
                <input type="number" id="rows" name="rows" min="2" max="23" value="<?php echo $rows; ?>" required>

                <label for="cols">Nhập số cột của ma trận:</label>
                <input type="number" id="cols" name="cols" min="2" max="23" value="<?php echo $cols; ?>" required>

                <button type="submit">Lấy bảng nhập ma trận</button>
            </form>
        <?php endif; ?>

        <?php if ($rows > 0 && $cols > 0): ?>
            <form>
                <div class="matrix-inputs" style="grid-template-columns: repeat(<?= $cols ?>, minmax(100px, 1fr));">
                    <input type="hidden" name="rows" value="<?= $rows ?>">
                    <input type="hidden" name="cols" value="<?= $cols ?>">

                    <?php for ($i = 0; $i < $rows; $i++): ?>
                        <?php for ($j = 0; $j < $cols; $j++): ?>
                            <input required type="number" name="matrix[]" value="<?php echo $matrix[$i][$j]; ?>">
                        <?php endfor; ?>
                    <?php endfor; ?>
                </div>

                <button type="submit">Tìm phần tử lớn nhất</button>
            </form>

            <button style="width: 100%; margin-top: 16px;"
                onclick="window.location.href='6_tim_ptu_lon_nhat_trong_mang_2chieu.php?rows=0&cols=0'">
                Trở về
            </button>
        <?php endif; ?>


        <?php if ($maxValue !== null): ?>
            <div class="result">
                <p>Phần tử lớn nhất là: <strong><?php echo $maxValue; ?></strong> tại tọa độ (<?php echo $maxRow + 1; ?>,
                    <?php echo $maxCol + 1; ?>)
                </p>
            </div>
        <?php endif; ?>
    </div>
</body>

</html>