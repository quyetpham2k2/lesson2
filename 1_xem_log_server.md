# Bước 1: Xác định vị trí log trên XAMPP

## Log lỗi của Apache/PHP: Thường được lưu trong:

        C:\xampp\apache\logs\error.log

## Log truy cập của Apache: Thường nằm ở:

        C:\xampp\apache\logs\access.log

# Bước 2: Kiểm tra access.log và error.log

## Mở file access.log để theo dõi các truy cập vào ứng dụng.

## Mở file error.log để theo dõi các lỗi phát sinh.

# Bước 3: Tạo lỗi để kiểm tra log lỗi PHP

## Thêm một đoạn mã đơn giản gây lỗi vào một file PHP trong thư mục htdocs, chẳng hạn:

        <?php
        echo $undefined_variable;
        trigger_error("This is a custom error!", E_USER_ERROR);
        ?>

    Sau đó truy cập file này qua trình duyệt và
    kiểm tra error.log trong thư mục C:\xampp\apache\logs\error.log.

        error.log:    [Wed Nov 13 14:03:40.987687 2024] [php:error] [pid 6172:tid 1904] [client ::1:60271] PHP Fatal error:  This is a custom error! in C:\\xampp\\htdocs\\php_training\\lesson2\\1.php on line 3, referer: http://localhost/php_training/lesson2/

        access.log:    ::1 - - [13/Nov/2024:14:03:40 +0700] "GET /php_training/lesson2/1.php HTTP/1.1" 200 267 "http://localhost/php_training/lesson2/" "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36"

# Bước 4: Thay đổi vị trí lưu log (tuỳ chọn)

## Lưu log ở một vị trí khác:

    Mở file php.ini trong C:\xampp\php\php.ini.
    Tìm dòng error_log và thay đổi đường dẫn, ví dụ:

        error_log = "C:\Users\quyet\OneDrive\Máy tính"

    Lưu lại file php.ini và khởi động lại Apache từ XAMPP Control Panel để áp dụng thay đổi.
