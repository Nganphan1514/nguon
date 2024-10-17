<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>How to Style HTML Tables with CSS</title>
    <link rel="stylesheet" href="css/main.css">
</head>

<body>
    
    <table class="content-table">
        <thead>
            <tr>
                <th>Rank</th>
                <th>Name</th>
                <th>Points</th>
                <th>Team</th>
                <td>Image</td>

                <th>Hoạt động</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>Domenic</td>
                <td>88,110</td>
                <td>dcode</td>
                <td>dcode</td>

                <td>
                    <div class="Nut">
                        <a href="sua.php">
                            <button type="button" class="btn-sua">Sửa</button>
                        </a>
                        <button type="button" class="btn-xoa" onclick="alert('Xóa thành công!')">Xoá</button>
                    </div>
                </td>
            </tr>
            <tr class="active-row">
                <td>2</td>
                <td>Sally</td>
                <td>72,400</td>
                <td>Students</td>
                <td>dcode</td>

                <td>
                    <div class="Nut">
                        <a href="sua.php">
                            <button type="button" class="btn-sua">Sửa</button>
                        </a>
                        <button type="button" class="btn-xoa" onclick="alert('Xóa thành công!')">Xoá</button>
                    </div>
                </td>
            </tr>
            <tr>
                <td>3</td>
                <td>Nick</td>
                <td>52,300</td>
                <td>dcode</td>
                <td>dcode</td>

                <td>
                    <div class="Nut">
                        <a href="sua.php">
                            <button type="button" class="btn-sua">Sửa</button>
                        </a>
                        <button type="button" class="btn-xoa" onclick="alert('Xóa thành công!')">Xoá</button>
                    </div>
                </td>


            </tr>
            <tr>
                <td colspan="6">
                    <div class="button" style="margin: 0 auto; width: 50%;">
                        <a href="them.php"><input type="button" value="Thêm dữ liệu" />
                        </a>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>

</body>

</html>