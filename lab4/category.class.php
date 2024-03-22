<?php

class Category {
    private $categoryID;
    private $categoryName;

    public function __construct($categoryID, $categoryName) {
        $this->categoryID = $categoryID;
        $this->categoryName = $categoryName;
    }

    // Phương thức để lấy danh sách các loại sản phẩm từ cơ sở dữ liệu
    public static function list_category() {
        // Kết nối đến cơ sở dữ liệu
        $conn = new mysqli("localhost", "root", "", "demo_lap3");

        // Kiểm tra kết nối
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Chuẩn bị câu truy vấn SQL để lấy danh sách các loại sản phẩm
        $sql = "SELECT * FROM categories";

        // Thực thi câu truy vấn
        $result = $conn->query($sql);

        $categories = array();

        // Kiểm tra kết quả và lấy dữ liệu
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $categories[] = $row;
            }
        }

        // Đóng kết nối và trả về kết quả
        $conn->close();
        return $categories;
    }

    // Các phương thức khác của lớp Category nếu cần
}

?>
