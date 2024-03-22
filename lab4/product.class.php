<?php

class Product {
    private $productName;
    private $categoryID;
    private $price;
    private $quantity;
    private $description;
    private $picture;

    public function __construct($productName, $categoryID, $price, $quantity, $description, $picture) {
        $this->productName = $productName;
        $this->categoryID = $categoryID;
        $this->price = $price;
        $this->quantity = $quantity;
        $this->description = $description;
        $this->picture = $picture;
    }

    public function save() {
        // Kết nối đến cơ sở dữ liệu
        $conn = new mysqli("localhost", "root", "", "demo_lap3");
    
        // Kiểm tra kết nối
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
    
        // Chuẩn bị câu truy vấn SQL để chèn dữ liệu vào cơ sở dữ liệu
        $sql = "INSERT INTO products (productName, categoryID, price, quantity, description, picture) 
                VALUES (?, ?, ?, ?, ?, ?)";
    
        // Chuẩn bị câu lệnh SQL để thực thi
        $stmt = $conn->prepare($sql);
    
        // Bind các tham số vào câu lệnh SQL
        $stmt->bind_param("siidis", $this->productName, $this->categoryID, $this->price, 
                          $this->quantity, $this->description, $this->picture);
    
        // Thực thi câu lệnh SQL
        $result = $stmt->execute();
    
        // Đóng câu lệnh và kết nối
        $stmt->close();
        $conn->close();
    
        // Trả về kết quả, true nếu thực hiện thành công, ngược lại là false
        return $result;
    }

    public static function list_product() {
        // Kết nối đến cơ sở dữ liệu
        $conn = new mysqli("localhost", "root", "", "demo_lap3");

        // Kiểm tra kết nối
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Chuẩn bị câu truy vấn SQL để lấy danh sách sản phẩm
        $sql = "SELECT * FROM product";

        // Thực thi câu truy vấn
        $result = $conn->query($sql);

        $products = array();

        // Kiểm tra kết quả và lấy dữ liệu
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $products[] = $row;
            }
        }

        // Đóng kết nối và trả về kết quả
        $conn->close();
        return $products;
    }
}

?>
