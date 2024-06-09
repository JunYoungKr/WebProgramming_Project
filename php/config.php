<?php
$servername = "localhost";
$username = "root";  // XAMPP 기본 사용자명
$password = "";      // XAMPP 기본 비밀번호는 없음
$dbname = "diary_db";  // 생성한 데이터베이스 이름

// 데이터베이스 연결
$conn = new mysqli($servername, $username, $password, $dbname);

// 연결 확인
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
