<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bookblog";

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Veritabanı bağlantısı başarısız: " . $conn->connect_error);
}


$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id > 0) {
    
    $query = "SELECT * FROM books WHERE id = $id";
    $result = $conn->query($query);

    if ($result && $result->num_rows > 0) {
        $book = $result->fetch_assoc();
    } else {
        echo "Kitap bulunamadı.";
        exit;
    }
} else {
    echo "Geçersiz kitap ID.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, inital-scale=1.0">
        <title>Book Blog</title>
        <link rel="stylesheet" href="topbar.css">
        <link rel="stylesheet" href="general.css">
        <link rel="stylesheet" href="book.css">
        

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Funnel+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
        
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel="stylesheet">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Funnel+Sans:ital,wght@0,300..800;1,300..800&family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">

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
    
        <div class="bg">

            <div class="container">

                <div class="book-card">

                    <img src="<?= htmlspecialchars($book['book_image']) ?>" class="book-picture">
            
                    <div class="book-name">
                        <?= htmlspecialchars($book['title']) ?>
                    </div>

                    <div class="author-pic">
                        <img src="<?= htmlspecialchars($book['author_image']) ?>">
                    </div>

                    <div class="author-name">
                        <?= htmlspecialchars($book['author']) ?>
                    </div>

                </div>

                <div class="symbols">
                    <div class="heart">
                        <i class='bx bx-heart'></i>
                    </div>
                    
                    <div class="comment">
                        <i class='bx bx-message-rounded'></i>

                    </div>

                </div>

                <div class="book-review">
                    <p>
                        <?= nl2br(htmlspecialchars($book['description'])) ?>
                    </p>
                </div>


            </div>
        </div>
    
    
    </body>
</html>