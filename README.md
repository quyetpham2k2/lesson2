# Lesson 2

## Tóm tắt kiến thức

- `include_once` và `require_once` giúp tránh khai báo biến và hàm trùng lặp.
- Sử dụng `try`, `catch`, và `finally` để kiểm soát lỗi hiệu quả.
- Ném lỗi tùy chỉnh ở các cấp nhỏ để giảm độ phức tạp của chương trình.
- Hàm sắp xếp mảng trong PHP chủ yếu làm việc với tham chiếu. Nên tạo bản sao nếu muốn tránh thay đổi mảng gốc.
- Các hàm sắp xếp trong PHP có chức năng riêng biệt, khác với JavaScript.

## Các hàm sắp xếp cơ bản

| Hàm           | Mô tả                                              | Trả về                |
|---------------|----------------------------------------------------|-----------------------|
| `sort()`      | Sắp xếp mảng theo thứ tự tăng dần, thay đổi mảng gốc| `true` nếu thành công |
| `rsort()`     | Sắp xếp mảng theo thứ tự giảm dần, thay đổi mảng gốc| `true` nếu thành công |
| `usort()`     | Sắp xếp mảng theo hàm so sánh tùy chỉnh            | `true` nếu thành công |
| `asort()`     | Sắp xếp mảng kết hợp theo giá trị, thay đổi mảng gốc| `true` nếu thành công |
| `ksort()`     | Sắp xếp mảng kết hợp theo khóa, thay đổi mảng gốc  | `true` nếu thành công |
| `array_multisort()` | Sắp xếp nhiều mảng đồng thời                   | `true` nếu thành công |

## Các hàm hiển thị trong PHP

| Hàm            | Mô tả                                        | Trả về                |
|----------------|----------------------------------------------|-----------------------|
| `echo`         | In ra chuỗi                                  | Không trả về           |
| `print`        | In ra chuỗi và trả về 1                      | `1`                   |
| `printf`       | In ra chuỗi đã định dạng                     | Không trả về           |
| `sprintf`      | Tạo chuỗi đã định dạng và trả về             | Chuỗi                 |
| `var_dump`     | Hiển thị chi tiết kiểu dữ liệu               | Không trả về           |
| `var_export`   | Hiển thị mã PHP có thể thực thi lại          | Không trả về           |
| `print_r`      | Hiển thị mảng hoặc đối tượng                 | Không trả về           |
| `exit / die`   | Dừng chương trình và hiển thị thông báo     | Không trả về           |

## Khi nào sử dụng các hàm này?
- `echo`, `print`: Dùng để in chuỗi đơn giản.
- `printf`, `sprintf`: Dùng để in hoặc tạo chuỗi với định dạng.
- `var_dump`, `print_r`: Dùng khi debug và cần chi tiết về biến.
- `exit`, `die`: Dùng khi dừng chương trình với thông báo.

