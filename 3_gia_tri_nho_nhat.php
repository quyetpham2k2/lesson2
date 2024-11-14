<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tìm Giá Trị Nhỏ Nhất</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;

            letter-spacing: 0.1em
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            text-align: center;
        }

        input[type="text"] {
            width: 100%;
            padding: 16px;
            margin: 16px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
            display: block;
            font-size: 20px;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 18px;
        }

        button:hover {
            background-color: #45a049;
        }

        .result {
            margin-top: 15px;
            font-weight: bold;
            color: #333;
            text-align: left;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Tìm Giá Trị Nhỏ Nhất Trong Mảng</h1>
        <form method="GET">
            <input type="text" name="array" placeholder="Nhập mảng (cách nhau bằng dấu phẩy)">
            <button type="submit">Tìm</button>
        </form>
        <div class="result">
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["array"])) {
                $arrayInput = $_GET["array"];
                $array = array_map('intval', explode(',', $arrayInput));

                function findMinIndex($array)
                {
                    $min = $array[0];
                    $index = 0;

                    for ($i = 1; $i < count($array); $i++)
                        if ($array[$i] < $min) {
                            $min = $array[$i];
                            $index = $i;
                        }

                    return $index;
                }

                $minIndex = findMinIndex($array);
                echo "Mảng đang xét: " . implode(', ', $array) . ".</br></br>";
                echo "Giá trị nhỏ nhất là: " . $array[$minIndex] . " tại vị trí: " . $minIndex;
            } ?>
        </div>
    </div>
</body>

</html>