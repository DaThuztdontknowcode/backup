<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Slider</title>
    <!-- Thêm các tệp CSS và JS của Slick Carousel -->
    <link rel="stylesheet" href="../css/ProductsCss.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/jquery.slick/1.6.0/slick.css"/>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery.slick/1.6.0/slick.min.js"></script>
</head>
<body>

<!-- Nội dung của slider -->
<div class="slider-container">
    <?php
    // Nạp file config.php để có kết nối đến cơ sở dữ liệu
    require_once '../config.php';
    require_once '../Model/Product.php';

    // Truy vấn dữ liệu từ cơ sở dữ liệu
    $sql = "SELECT * FROM Products";
    $result = $conn->query($sql);

    // Kiểm tra và hiển thị dữ liệu
    if ($result->num_rows > 0) {
        echo "<div class='slider'>";
        // Loop để hiển thị sản phẩm trong slider
        while($row = $result->fetch_assoc()) {
            $product = new Product(
                $row["ProductID"],
                $row["ProductName"],
                $row["CategoryID"],
                $row["Price"],
                $row["Description"],
                $row["StockQuantity"],
                $row["image_url"]
            );

            echo "<div>";
            echo "<img src='" . $product->img . "' alt='" . $product->ProductName . "'>";
            echo "<h3>" . $product->ProductName . "</h3>";
            echo "<p>" . $product->Description . "</p>";
            echo "</div>";
        }
        echo "</div>";

        // Nút mũi tên chuyển slide
        echo "<button class='prev'>Previous</button>";
        echo "<button class='next'>Next</button>";
    } else {
        echo "0 kết quả";
    }

    // Đóng kết nối
    $conn->close();
    ?>

    <!-- Kịch bản JavaScript để khởi tạo Slick Carousel -->
    <script>
        $(document).ready(function(){
            $('.slider').slick({
                // Các tùy chọn của Slick Carousel
                infinite: true,
                slidesToShow: 1,
                slidesToScroll: 1,
                centerMode: true, // Đưa slide hiện tại ra giữa
                variableWidth: true, // Tự động tính chiều rộng của slide
                prevArrow: $('.prev'),
                nextArrow: $('.next')
            });
        });
    </script>

</div>

</body>
</html>