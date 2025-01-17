<?php

$host = "localhost";
$username = "root";
$password = "";
$dbname = "bookblog";

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM books";
$result = $conn->query($sql);

$books = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $books[] = $row;
    }
} else {
    echo "Kitap bulunamadı.";
}
?>



<!DOCTYPE html>
<html>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, inital-scale=1.0">
        <title>Book Blog</title>
        <link rel="stylesheet" href="topbar.css">
        <link rel="stylesheet" href="general.css">
        <link rel="stylesheet" href="books.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Funnel+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel="stylesheet">
    </head>

    <body>
        
        <div class="topbar">
            
            <div class="left-section">
                <a href="index.php" class="home-icon">
                    <i class='bx bx-home'></i>
                </a>

                <a href="books.php" class="books-icon">
                    <i class='bx bxs-book'></i>
                </a>

            </div>

            <div class="middle-section">
                <input type="text" class="search-bar" placeholder="Search books">
                
            </div>
            
            <div class="right-section">
                
                <a href="login.html" class="login-icon">
                    <i class='bx bx-log-in'></i>
                </a>

                <a href="register.html" class="account-icon">
                    <i class='bx bx-user'></i>
                </a>

            </div>
        </div>

        <div class="grid">
            <?php foreach ($books as $book): ?>
                
                <a href="book.php?id=<?php echo $book['id']; ?>" class="book-link">
                    <div class="book-card">

                        <div class="book-image">
                            <img src="<?php echo $book['book_image']; ?>" class="book-picture" alt="Book Image">
                        </div>

                        <div class="book-info">
                            <div class="book-header">
                                <p class="book-name"><?php echo htmlspecialchars($book['title']); ?></p>
                            </div>

                            <div class="author-image">
                                <img src="<?php echo $book['author_image']; ?>" class="author-picture" alt="Author Image">
                            </div>

                            <div class="book-author">
                                <p class="book-author-text"><?php echo htmlspecialchars($book['author']); ?></p>
                            </div>
                        </div>

                    </div>
                </a>
            <?php endforeach; ?>
                
        </div>

        <script src="searchbar.js"></script>

    </body>

</html>