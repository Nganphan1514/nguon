<?php
include("connec/connec.php");

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Xử lý việc xóa sản phẩm
if (isset($_POST['xoa'])) {
    $admin_id = $_POST['admin_id'];

    // Sử dụng Prepared Statements để xóa sản phẩm
    $stmt = $conn->prepare("DELETE FROM users WHERE admin_id=?");
    $stmt->bind_param("i", $admin_id); // "i" cho kiểu dữ liệu integer

    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Xóa sản phẩm thành công!"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Lỗi: " . $stmt->error]);
    }
    $stmt->close();
    exit; // Ngừng thực hiện để tránh in HTML
}

// Truy vấn để lấy danh sách sản phẩm
$sql = "SELECT * FROM users";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Nhân sự</title>
    <link rel="stylesheet" href="css/main.css">
    <script>
        function xoaSanPham(admin_id) {
            if (confirm("Bạn có chắc chắn muốn xóa sản phẩm này?")) {
                const formData = new FormData();
                formData.append('xoa', '1'); // Thêm tham số xóa
                formData.append('admin_id', admin_id); // Thêm ID sản phẩm

                fetch('', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        alert(data.message); // Hiển thị thông báo
                        if (data.status === "success") {
                            document.getElementById('row-' + admin_id).remove(); // Xóa hàng trong bảng
                        }
                    })
                    .catch(error => {
                        console.error('Lỗi:', error);
                    });
            }
        }
    </script>
</head>

<body>
    <h2 style="text-align: center;">Quản lý Nhân sự</h2>

    <table class="content-table" style="width: 80%;">
        <thead>
            <tr>
                <th>admin_id</th>
                <th>admin_email</th>
                <th>admin_password</th>
                <th>Images</th>
                <th colspan="2">
                    <div class="button" style="margin: 0 auto; width: 30%;">
                        <a href="them.php"><input type="button" value="Thêm " /></a>
                    </div>
                </th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result && $result->num_rows > 0) {
                // Hiển thị dữ liệu mỗi hàng
                while ($row = $result->fetch_assoc()) { ?>
                    <tr id="row-<?php echo $row["admin_id"]; ?>">
                        <td><?php echo $row["admin_id"]; ?></td>
                        <td><?php echo $row["admin_email"]; ?></td>
                        <td><?php echo $row["admin_password"]; ?></td>
                        <td class='anh'>
                            <img style="width: 20vh; height: 20vh;" src='anh/<?php echo $row["images"]; ?>' alt='<?php echo $row["name"]; ?>'>
                        </td>
                        <td>
                            <div class="Nut" style="float: right;">
                                <a href="sua.php?admin_id=<?php echo $row['admin_id']; ?>">
                                    <button name="sua" type="button" class="btn-sua">Sửa</button>
                                </a>
                            </div>
                        </td>
                        <td>
                            <div class="Nut">
                                <button name="xoa" type="button" class="btn-xoa" onclick="xoaSanPham(<?php echo $row['admin_id']; ?>)">Xoá</button>
                            </div>
                        </td>
                    </tr>
            <?php }
            } else {
                echo "<tr><td colspan='8'>Không có dữ liệu</td></tr>";
            }
            ?>
        </tbody>
    </table>

</body>

</html>

<?php
$conn->close(); // Đóng kết nối sau khi hoàn tất tất cả các truy vấn
?>