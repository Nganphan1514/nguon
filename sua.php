<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Responsive Registration Form | CodingLab </title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="container">
        <!-- Title section -->
        <div class="title">Sửa</div>
        <div class="content">
            <!-- Registration form -->
            <form action="#">
                <div class="user-details">
                    <div class="input-box">
                        <span class="details">ID</span>
                        <input type="number" name="id" placeholder="Enter ID">
                    </div>
                    <!-- Input for Full Name -->
                    <div class="input-box">
                        <span class="details">Name</span>
                        <input type="text" name="name" placeholder="Enter name">
                    </div>
                    <!-- Input for Username -->
                    <div class="input-box">
                        <span class="details">Brand</span>
                        <input type="text" name="brand" placeholder="Enter brand">
                    </div>
                    <!-- Input for Email -->
                    <div class="input-box">
                        <span class="details">Made in</span>
                        <input type="text" name="made" placeholder="Enter made in">
                    </div>
                    <!-- Input for Phone Number -->
                    <div class="input-box">
                        <span class="details">Price</span>
                        <input type="text" name="price" placeholder="Enter price">
                    </div>
                    <!-- Input for Password -->

                    <!-- Input for Confirm Password -->
                    <div style="margin: 0 auto;">
                        <span class="details" style="margin-left: 40%;">Image</span> <br>
                        <input type="file" style="margin-top: 6.5%;" name="anh" id="">
                    </div>

                </div>

                <!-- Submit button -->
                <div class="button">
                    <input type="submit" value="Sửa" name="Enter">

                </div>

                <div class="button" style="margin: 0 auto; width: 50%;">
                    <a href="hienthi.php"><input type="button" value="Về trang hiển thị" />
                    </a>
                </div>

            </form>
        </div>
    </div>
</body>

</html>