<?php
include 'config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

$user_id = $_SESSION['user_id'];

// 프로필 정보 가져오기
$sql = "SELECT username FROM users WHERE id = '$user_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    echo "프로필 정보를 가져올 수 없습니다.";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];

    // username 중복 확인
    $check_sql = "SELECT id FROM users WHERE username='$username' AND id != '$user_id'";
    $check_result = $conn->query($check_sql);

    if ($check_result->num_rows > 0) {
        echo "<script>
                alert('이미 사용 중인 아이디입니다.');
                window.history.back();
              </script>";
    } else {
        $update_sql = "UPDATE users SET username='$username' WHERE id='$user_id'";

        if ($conn->query($update_sql) === TRUE) {
            echo "<script>
                    alert('아이디가 업데이트되었습니다.');
                    window.location.href = 'profile.php';
                  </script>";
        } else {
            echo "아이디 업데이트 중 오류가 발생했습니다: " . $conn->error;
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>프로필 관리</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <header>
        <h2>나의 프로필</h2>
        <nav>
            <a href="../index.html">Home</a>
            <a href="diary.html">Write</a>
            <a href="logout.php">Logout</a>
            <a href="profile.php">Profile</a>
        </nav>
    </header>
    <main>
        <section id="profile">
            <h2 style="margin-Top:10px">Username 수정</h2>
            <form action="profile.php" method="post">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>

                <button type="submit">수정</button>
            </form>
        </section>
    </main>
</body>
</html>
