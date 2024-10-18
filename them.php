<?php
include('connec/connec.php');
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $admin_email = $_POST['admin_email'];
    $admin_password = $_POST['admin_password'];
    $image_name = ""; // Khởi tạo biến tên hình ảnh

    // Kiểm tra và xử lý upload file ảnh
    if (isset($_FILES["images"]) && $_FILES["images"]["error"] == 0) {
        $target_dir = "anh/";  // Thư mục lưu trữ ảnh
        $target_file = $target_dir . basename($_FILES["images"]["name"]);
        $image_name = $_FILES["images"]["name"];

        // Kiểm tra và di chuyển file vào thư mục đã định nghĩa
        if (move_uploaded_file($_FILES["images"]["tmp_name"], $target_file)) {
        } else {
            echo "Lỗi khi tải hình ảnh.";
        }

        // Lưu sản phẩm vào cơ sở dữ liệu với đường dẫn file ảnh
        $sql = "INSERT INTO users (admin_email, admin_password, images) VALUES ('$admin_email', '$admin_password', '$image_name')";

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Thêm sản phẩm thành công!');</script>";
        } else {
            echo "Lỗi: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Không có file ảnh nào được tải lên hoặc xảy ra lỗi.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm thông tin user</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="container">
        <!-- Title section -->
        <div class="title">Thêm</div>
        <div class="content">
            <!-- Registration form -->
            <form action="" method="POST" enctype="multipart/form-data"> <!-- Sửa đổi ở đây -->
                <div class="user-details">

                    <div class="input-box">
                        <span class="details">admin_email</span>
                        <input type="text" name="admin_email" placeholder="Enter admin_email" required>
                    </div>

                    <div class="input-box">
                        <span class="details">admin_password</span>
                        <input type="text" name="admin_password" placeholder="Enter admin_password" required>
                    </div>


                    <div style="margin: 0 auto;">
                        <span class="details" style="margin-left: 40%;">Images</span> <br>
                        <input type="file" name="images" id="" required> <!-- Bắt buộc chọn file -->
                    </div>

                </div>

                <!-- Submit button -->
                <div class="button">
                    <input type="submit" value="Thêm" name="Enter">
                </div>

                <div class="button" style="margin: 0 auto; width: 50%;">
                    <a href="hienthi.php"><input type="button" value="Về trang hiển thị" /></a>
                </div>

            </form>
        </div>
    </div>
</body>

</html>