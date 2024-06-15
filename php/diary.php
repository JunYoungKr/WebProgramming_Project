<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $user_id = $_SESSION['user_id'];

    $sql = "INSERT INTO diaries (user_id, title, content) VALUES ('$user_id', '$title', '$content')";

    if (mysqli_query($conn, $sql)) {
        header("Location: diary_list.php");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>1일 1일기장</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>

<body>
    <header>
        <h2>나의 일기장</h2>
        <nav>
            <a href="../index.html">Home</a>
            <a href="diary.html">Write</a>
            <a href="logout.php">Logout</a>
            <a href="profile.php">Profile</a>
        </nav>
    </header>
    <main class="mainContainer">
        <section class="sectionContainer" id="write-diary">
            <h2>Write a new diary entry</h2>
            <form class="registerContainer" action="diary.php" method="post">
                <label for="title">Title:</label>
                <input type="text" id="title" name="title" required>
                <label for="content">Content:</label>
                <textarea id="content" name="content" required></textarea>
                <button type="submit">Save</button>
            </form>
        </section>
    </main>
</body>

</html>
