<!DOCTYPE html>
<html>

<head>
  <title>Hiển thị danh sách người dùng</title>
</head>

<body>
  <h1>Danh sách người dùng</h1>

  <?php
  // Thực hiện kết nối đến cơ sở dữ liệu
  $servername = "localhost"; // Thay đổi địa chỉ máy chủ MySQL nếu cần
  $username = "root"; // Thay đổi tên đăng nhập MySQL của bạn
  $password = ""; // Thay đổi mật khẩu MySQL của bạn
  $dbname = "bank"; // Thay đổi tên cơ sở dữ liệu của bạn

  // Tạo kết nối
  $conn = new mysqli($servername, $username, $password, $dbname);

  // Kiểm tra kết nối
  if ($conn->connect_error) {
    die("Kết nối đến cơ sở dữ liệu thất bại: " . $conn->connect_error);
  }

  // Truy vấn dữ liệu từ bảng user
  $sql = "SELECT username, password FROM user";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    echo "<table border='1'>
            <tr>
                <th>Username</th>
                <th>Password</th>
            </tr>";
    while ($row = $result->fetch_assoc()) {
      echo "<tr>
                <td>" . $row["username"] . "</td>
                <td>" . $row["password"] . "</td>
            </tr>";
    }
    echo "</table>";
  } else {
    echo "Không có dữ liệu người dùng.";
  }

  // Đóng kết nối đến cơ sở dữ liệu
  $conn->close();
  ?>
</body>

</html>