<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bookblog";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$selected_ids = []; 
$daily_books = [];  



$today = date('Y-m-d');
srand(strtotime($today)); 


$sql = "SELECT * FROM books";
$result = $conn->query($sql);

$books = [];
while ($row = $result->fetch_assoc()) {
    $books[] = $row;
}


shuffle($books);
$daily_books = array_slice($books, 0, 3);


$sql = "SELECT * FROM poems ORDER BY RAND() LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $poems = $result->fetch_assoc();
} else {
    $poems = [
        'poem' => 'Henüz bir şiir yok.',
        'author' => 'Bilinmeyen Yazar',
        'author_image' => 'img/default-author.jpg'
    ];
}

$sql = "SELECT * FROM autobiographys ORDER BY RAND() LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $autobiographys = $result->fetch_assoc();
} else {
    $autobiographys = [
        'author' => 'Bilinmeyen Yazar',
        'author_image' => 'img/default-author.jpg',
        'autobiography' => 'Henüz bir otobiyografi yok.'
    ];
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, inital-scale=1.0">
        <title>Book Blog</title>
        <link rel="stylesheet" href="topbar.css">
        <link rel="stylesheet" href="general.css">
        <link rel="stylesheet" href="daily.css">
        

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


        <div class="content">

            <div class="daily-book">

                <div class="book-header">
                    <p class="book-header-text">~ Book of the day ~</p>
                </div>
                
                <?php foreach ($daily_books as $book): ?>
                    <a href="book.php?id=<?php echo $book['id']; ?>" class="book-link">
                        <div class="book-card">

                            <div class="book-picture">
                                <img class="book-img" src="<?php echo $book['book_image']; ?>">
                            </div>

                            <div class="book-info">
                                <div class="book-name">
                                    <?php echo $book['title']; ?>
                                </div>

                                <div class="book-author-pic">
                                    <img class="book-author-img" src="<?php echo $book['author_image']; ?>">
                                </div>

                                <div class="book-author-name">
                                    <?php echo $book['author']; ?>
                                </div>

                            </div>

                        </div>
                    </a>
                <?php endforeach; ?>
               
            
            </div>
            
            <div class="daily-author">
                
                <p class="author-header">~ Author of the day ~</p>
                
                <?php foreach ($daily_books as $book): ?>

                    <div class="author-card">
                        <img class="author-pic" src="<?php echo $book['author_image'] ?>">
                        <p class="author"><?php echo $book['author'] ?></p>
                    </div>

                <?php endforeach; ?>
                  
            </div>
            
            
            <div class="daily-poem">

                <div class="poem-header">
                    <p class="poem-header-text">~ Poem of the day ~</p>
                </div>

                <div class="poem-text">

                    <p class="poem">
                        <?php echo $poems['poem']; ?>
                    </p>

                    <div class="poet-profil">
                        <img src="<?php echo $poems['author_image']; ?>" class="poet-img">
                        <p class="poet"><?php echo $poems['author']; ?></p>
                    </div>

                </div>

                
            </div>
            
            <div class="author-autobiography">

                <div class="header-autobiography">
                    <p class="autobiography-header-text">~ Autobiography of the day ~</p>

                </div>

                <div class="author-profil">
                    
                    <img src="<?php echo $autobiographys['author_image']; ?>" class="author-p">
                    <p class="author-n"><?php echo $autobiographys['author']; ?></p>
                </div>

                <div class="text-autobiography">
                    <p class="autobiography">
                        <?php echo $autobiographys['autobiography']; ?>
                    </p>
                </div>

            </div>
          
        </div>

       
        <script src="searchbar.js"></script>

    </body>


</html>


