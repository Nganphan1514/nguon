<?php
include("connec/connec.php");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['admin_id'])) {
    $admin_id = $_GET['admin_id'];
    $sql = "SELECT * FROM users WHERE admin_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $admin_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $admin_email = $row['admin_email'];
        $admin_password = $row['admin_password'];
        $images = $row['images'];
    }
    $stmt->close();
}


if (isset($_POST['Enter'])) {
    $admin_id = $_POST['admin_id'];
    $admin_email = $_POST['admin_email'];
    $admin_password = $_POST['admin_password'];
    $name_anh = "";  // Khởi tạo biến để lưu tên hình ảnh

    // Kiểm tra nếu có ảnh được tải lên
    if (isset($_FILES["images"]) && $_FILES["images"]["error"] == 0) {
        $target_dir = "anh/";  // Thư mục lưu trữ ảnh
        $target_file = $target_dir . basename($_FILES["images"]["name"]);
        $name_anh = $_FILES["images"]["name"];

        // Di chuyển file vào thư mục đã định nghĩa
        if (move_uploaded_file($_FILES["images"]["tmp_name"], $target_file)) {
        } else {
            echo "<script>alert('Lỗi khi tải hình ảnh.');</script>";
        }
    }

    // Kiểm tra nếu có ID để thực hiện cập nhật sản phẩm
    if (!empty($admin_id)) {
        // Nếu có ảnh mới, cập nhật cả ảnh
        if (!empty($name_anh)) {
            $sql = "UPDATE users SET admin_email='$admin_email', admin_password='$admin_password', images='$name_anh' WHERE admin_id='$admin_id'";
        } else {
            // Nếu không có ảnh mới, chỉ cập nhật các trường khác
            $sql = "UPDATE users SET admin_email='$admin_email', admin_password='$admin_password' WHERE admin_id='$admin_id'";
        }

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Cập nhật sản phẩm thành công!'); window.location.href = 'hienthi.php';</script>";
        } else {
            echo "<script>alert('Lỗi khi cập nhật: " . $sql . "');</script>";
        }
    } else {
        // Nếu không có ID, thêm sản phẩm mới
        if (!empty($name_anh)) {
            $sql = "INSERT INTO users (admin_email, admin_password, images) VALUES ('$admin_email', '$admin_password', '$name_anh')";
        } else {
            $sql = "INSERT INTO users (admin_email, admin_password) VALUES ('$admin_email', '$admin_password')";
        }

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Thêm sản phẩm thành công!');</script>";
        } else {
            echo "<script>alert('Lỗi khi thêm sản phẩm: " . $sql . "');</script>";
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Nhân sự</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="container">
        <div class="title">Sửa thông tin</div>
        <div class="content">
            <form action="#" method="POST" enctype="multipart/form-data">
                <div class="user-details">
                    <div class="input-box">
                        <span class="details">ID</span>
                        <input type="number" name="admin_id" value="<?php
                                                                    echo $admin_id;
                                                                    ?>">
                    </div>
                    <div class="input-box">
                        <span class="details">admin_email</span>
                        <input type="text" name="admin_email" value="<?php
                                                                        echo $admin_email;
                                                                        ?>" required>
                    </div>
                    <div class="input-box">
                        <span class="details">admin_password</span>
                        <input type="text" name="admin_password" value="<?php
                                                                        echo $admin_password;
                                                                        ?>" required>
                    </div>

                    <div style="margin: 0 auto;">
                        <span class="details" style="margin-left: 40%;">Images</span> <br>
                        <input type="file" style="margin-top: 6.5%;" name="images" id="">
                    </div>
                </div>

                <div class="button">
                    <input type="submit" value="Sửa" name="Enter">
                </div>

                <div class="button" style="margin: 0 auto; width: 50%;">
                    <a href="hienthi.php"><input type="button" value="Về trang hiển thị"></a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>