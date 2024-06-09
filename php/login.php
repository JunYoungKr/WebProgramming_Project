<?php
session_start();
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT id, password FROM users WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            echo "<script>
                    alert('로그인 성공!');
                    window.location.href = 'diary_list.php';
                  </script>";
        } else {
            echo "<script>
                    alert('아이디 또는 비밀번호가 잘못되었습니다.');
                    window.history.back();
                  </script>";
        }
    } else {
        echo "<script>
                alert('아이디 또는 비밀번호가 잘못되었습니다.');
                window.history.back();
              </script>";
    }

    $conn->close();
} else {
    echo "<script>
            alert('잘못된 요청입니다.');
            window.history.back();
          </script>";
}
?>
