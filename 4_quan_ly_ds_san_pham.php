<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Danh sách Sản phẩm</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            display: flex;
            justify-content: center;
            height: 100vh;
            margin-top: 50px;
        }

        .container {
            width: 80%;
            max-width: 600px;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #333;
        }

        form,
        .product-list,
        .search-form {
            margin-top: 15px;
        }

        input[type="text"],
        input[type="number"] {
            width: 100%;
            padding: 8px;
            margin: 5px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        button {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Quản lý Danh sách Sản phẩm</h2>

        <form method="GET">
            <input type="text" name="name" placeholder="Tên sản phẩm" required>
            <input type="number" name="price" placeholder="Giá sản phẩm" min="0" required>
            <input type="number" name="quantity" placeholder="Số lượng sản phẩm" min="0" required>
            <button type="submit" name="action" value="add">Thêm sản phẩm</button>
        </form>

        <form method="GET" class="search-form">
            <input type="text" name="keyword" placeholder="Tìm kiếm sản phẩm theo tên">
            <button type="submit" name="action" value="search">Tìm kiếm</button>
        </form>

        <form method="GET">
            <button type="submit" name="action" value="display">Hiển thị danh sách</button>
            <button type="submit" name="action" value="sort">Sắp xếp theo tên</button>
        </form>

        <div class="product-list">
            <?php
            session_start();
            if (!isset($_SESSION['products'])) {
                $_SESSION['products'] = [];
            }
            $products = &$_SESSION['products'];
            // ===================================================================
            
            if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['action'])) {
                $action = $_GET['action'];

                if ($action == "add") {
                    $name = htmlspecialchars(trim($_GET['name']));
                    $price = intval($_GET['price']);
                    $quantity = intval($_GET['quantity']);

                    if ($price > 0 && $quantity > 0)
                        addProduct($products, $name, $price, $quantity);
                    else
                        echo "Giá và số lượng phải lớn hơn 0.";
                } elseif ($action == "display")
                    displayProducts($products);
                elseif ($action == "search") {
                    $keyword = $_GET['keyword'];
                    $searchResults = searchProduct($products, $keyword);
                    displayProducts($searchResults);
                } elseif ($action == "sort")
                    displayProducts(sortProductsByName($products));
            }
            ?>
        </div>
    </div>
</body>

</html>

<?php
function addProduct(&$products, $name, $price, $quantity)
{
    $products[] = ['name' => $name, 'price' => $price, 'quantity' => $quantity];
}

function displayProducts($products)
{
    if (empty($products)) {
        echo "<p>Không có sản phẩm nào trong danh sách.</p>";
    } else {
        echo "<table>";
        echo "<tr><th>Tên sản phẩm</th><th>Giá</th><th>Số lượng</th></tr>";
        foreach ($products as $product) {
            printf(
                "<tr><td>%s</td><td>%d</td><td>%d</td></tr>",
                htmlspecialchars($product['name']),
                $product['price'],
                $product['quantity']
            );
        }
        echo "</table>";
    }
}

function searchProduct($products, $keyword)
{
    $result = [];
    foreach ($products as $product) {
        if (stripos($product['name'], $keyword) !== false) {
            $result[] = $product;
        }
    }
    return $result;
}

function sortProductsByName($products)
{
    usort($products, function ($a, $b) {
        return strcmp($a['name'], $b['name']);
    });

    return $products;
}
?>