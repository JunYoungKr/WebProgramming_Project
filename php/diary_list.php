<?php
include 'config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

$user_id = $_SESSION['user_id'];
$sql = "SELECT title, content, created_at FROM diaries WHERE user_id = '$user_id'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diary List</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <header>
        <h2>나의 일기장</h2>
        <nav>
            <a href="../index.html">Home</a>
            <a href="logout.php">Logout</a>
        </nav>
    </header>
    <main>
        <section id="diary-list">
            <h2>My Diary Entries</h2>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<div class='diary-entry'>";
                    echo "<h3>" . htmlspecialchars($row['title']) . "</h3>";
                    echo "<p>" . nl2br(htmlspecialchars($row['content'])) . "</p>";
                    echo "<small>" . $row['created_at'] . "</small>";
                    echo "</div>";
                }
            } else {
                echo "<p>No diary entries found.</p>";
            }
            $conn->close();
            ?>
        </section>
    </main>
</body>
</html>
