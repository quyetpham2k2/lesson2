# lesson2
- include_once và require_once giúp tránh các lỗi lặp lại khai báo biến và hàm không đáng có khi nhúng trong cùng 1 file
- try, catch và finally nên được dùng nhiều để kiểm soát lỗi chương trình tốt hơn.
- ném các lỗi tùy chỉnh vào những trường hợp lỗi và các cấp nhỏ hơn để làm giảm phức tạp hơn cho chương trình, các trường hợp gây lỗi thì có thể dùng điều kiện để phân loại và ném lỗi và bắt chúng ở cấp cao nhất (nên cân nhắc kỹ trường hợp sử dụng kỹ thuật này cho phù hợp).
- Các hàm sắp xếp mảng trong php đa số là chỉnh sửa tham chiếu (bản gốc) của mảng, vậy nên nếu sử dụng thì nên cân nhắc tạo bản sao cho mảng để chỉnh sửa cho phù hợp, có thể dùng tham trị của hàm và trả về mảng mới trong hàm để tạo bản sao...
- các hàm sắp xếp mảng trong php khác với js là mỗi hàm sắp xếp đều có chức năng riêng, hơn là hàm kết hợp như js:

# Các hàm sắp xếp cơ bản
- sort():
-        Tham chiếu: Hàm này sắp xếp mảng theo thứ tự tăng dần và thay đổi mảng gốc.
-        Cú pháp: sort($array);
-        Trả về: true nếu thành công, false nếu có l   ỗi.

-   rsort():
-       Tham chiếu: Hàm này sắp xếp mảng theo thứ tự giảm dần và thay đổi mảng gốc.
-       Cú pháp: rsort($array);
-       Trả về: true nếu thành công, false nếu có lỗi.

-   usort():
-       Tham chiếu: Hàm này sắp xếp mảng dựa trên một hàm so sánh tùy chỉnh và thay đổi mảng gốc.
-       Cú pháp: usort($array, "comparison_function");
-       Trả về: true nếu thành công, false nếu có lỗi.

-   asort():
-       Tham chiếu: Hàm này sắp xếp mảng kết hợp (associative array) theo giá trị và thay đổi mảng gốc.
-       Cú pháp: asort($array);
-       Trả về: true nếu thành công, false nếu có lỗi.

-   ksort():
-       Tham chiếu: Hàm này sắp xếp mảng kết hợp theo khóa và thay đổi mảng gốc.
-       Cú pháp: ksort($array);
-       Trả về: true nếu thành công, false nếu có lỗi.

-   array_multisort(): là một hàm rất mạnh mẽ khi bạn cần sắp xếp nhiều mảng đồng thời.
-       Hàm này làm việc theo tham chiếu, tức là nó thay đổi mảng gốc khi sắp xếp.
-       Bạn có thể sử dụng nhiều mảng và chỉ định thứ tự và kiểu sắp xếp riêng cho từng mảng.

# Tóm tắt các hàm hiển thị:
-      Hàm	             Mô tả	                                  Trả về
-       echo	          In ra chuỗi	                              Không trả về
-       print	          In ra chuỗi và trả về 1	                  1
-       printf	          In ra chuỗi đã định dạng	                  Không trả về
-       sprintf	       Tạo chuỗi đã định dạng và trả về	         Chuỗi
-       var_dump	       Hiển thị chi tiết kiểu dữ liệu	            Không trả về
-       var_export	    Hiển thị mã PHP có thể thực thi lại	      Không trả về
-       print_r	       Hiển thị mảng hoặc đối tượng	               Không trả về
-       exit / die	    Dừng chương trình và hiển thị thông báo	   Không trả về

| Hàm            | Mô tả                                        | Trả về                |
|----------------|----------------------------------------------|-----------------------|
| echo           | In ra chuỗi                                  | Không trả về           |
| print          | In ra chuỗi và trả về 1                      | 1                     |
| printf         | In ra chuỗi đã định dạng                     | Không trả về           |
| sprintf        | Tạo chuỗi đã định dạng và trả về             | Chuỗi                 |
| var_dump       | Hiển thị chi tiết kiểu dữ liệu               | Không trả về           |
| var_export     | Hiển thị mã PHP có thể thực thi lại          | Không trả về           |
| print_r        | Hiển thị mảng hoặc đối tượng                 | Không trả về           |
| exit / die     | Dừng chương trình và hiển thị thông báo     | Không trả về           |

- Khi nào sử dụng các hàm này?
    echo và print: Thường dùng để hiển thị chuỗi đơn giản trong các trang web PHP.
    printf và sprintf: Khi cần in hoặc tạo chuỗi với định dạng đặc biệt.
    var_dump và print_r: Khi bạn muốn debug và cần thông tin chi tiết về biến.
    exit / die: Khi bạn cần dừng chương trình trong các tình huống đặc biệt và muốn hiển thị thông báo.
- Tùy thuộc vào yêu cầu của bạn mà sẽ chọn loại hàm hiển thị phù hợp.
