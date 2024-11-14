<?php
$customer_list = array(
    "1" => array(
        "ten" => "Mai Văn Hoàn",
        "ngaysinh" => "1983-08-20",
        "diachi" => "Hà Nội",
        "anh" => get_random_user_image()
    ),
    "2" => array(
        "ten" => "Nguyễn Văn Nam",
        "ngaysinh" => "1983-08-20",
        "diachi" => "Bắc Giang",
        "anh" => get_random_user_image()
    ),
    "3" => array(
        "ten" => "Nguyễn Thái Hòa",
        "ngaysinh" => "1983-08-21",
        "diachi" => "Nam Định",
        "anh" => get_random_user_image()
    ),
    "4" => array(
        "ten" => "Trần Đăng Khoa",
        "ngaysinh" => "1983-08-22",
        "diachi" => "Hà Tây",
        "anh" => get_random_user_image()
    ),
    "5" => array(
        "ten" => "Nguyễn Đình Thi",
        "ngaysinh" => "1983-08-17",
        "diachi" => "Hà Nội",
        "anh" => get_random_user_image()
    )
);

// Hàm lấy ảnh ngẫu nhiên cho từng khách hàng
function get_random_user_image()
{
    // Lấy ảnh người ngẫu nhiên từ Random User API
    $response = file_get_contents('https://randomuser.me/api/?inc=picture');
    $data = json_decode($response, true);
    return $data['results'][0]['picture']['thumbnail']; // Lấy ảnh ngẫu nhiên
}

function searchByDate($customers, $from_date, $to_date)
{
    if (empty($from_date) && empty($to_date))
        return $customers;

    $filtered_customers = [];
    foreach ($customers as $customer)
        if (
            !empty($from_date) && (strtotime($customer['ngaysinh']) > strtotime($from_date))
            && !empty($to_date) && (strtotime($customer['ngaysinh']) < strtotime($to_date))
        )
            $filtered_customers[] = $customer;

    return $filtered_customers;
}

$from_date = NULL;
$to_date = NULL;
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["from"]) && isset($_GET["to"])) {
    $from_date = $_GET["from"];
    $to_date = $_GET["to"];
}
$filtered_customers = searchByDate($customer_list, $from_date, $to_date);
?>

<!DOCTYPE html>
<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style>
    table {
        border-collapse: collapse;
        width: 100%;
    }

    th,
    td {
        padding: 8px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    .container {
        padding: 16px;
        max-width: 100%;
        border: 1px solid black;
    }

    input {
        padding: 16px;
    }

    #submit {
        border-radius: unset;
        padding: 14px;
        max-width: 100px;
        width: 100%;
    }

    .message {
        text-align: center;
    }
</style>

<body>
    <div class="container">
        <form method="get">
            Từ: <input id="from" type="text" name="from" placeholder="yyyyy/mm/dd" value="<?php echo $from_date; ?>" />
            Đến: <input id="to" type="text" name="to" placeholder="yyyy/mm/dd" value="<?php echo $to_date; ?>" />
            <button type="submit" id="submit">Lọc</button>
        </form>
    </div>

    <table border="0">
        <caption>
            <h1>Danh sách khách hàng</h1>
        </caption>
        <tr>
            <th>STT</th>
            <th>Tên</th>
            <th>Ngày sinh</th>
            <th>Địa chỉ</th>
            <th>Ảnh</th>
        </tr>

        <?php foreach ($filtered_customers as $key => $values) {
            echo "<tr>";
            echo "<td>" . $key . "</td>";
            echo "<td>" . $values['ten'] . "</td>";
            echo "<td>" . $values['ngaysinh'] . "</td>";
            echo "<td>" . $values['diachi'] . "</td>";
            echo "<td><image src ='" . $values['anh'] . "' width = '60px' height ='60px'/></td>";
            echo "</tr>";
        } ?>

        <?php if (count($filtered_customers) === 0): ?>
            <tr>
                <td colspan="5" class="message">Không tìm thấy khách hàng nào</td>
            </tr>
        <?php endif; ?>
    </table>
</body>

</html>