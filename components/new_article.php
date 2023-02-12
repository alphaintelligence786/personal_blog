<?php
include "conn.php";
session_start();
if (!isset($_SESSION['logged_in_user_id'])){
    echo "<h2> Your Session is expired please login </h2>";
    echo "<a href='login.php'><Button class='btn btn-danger'>Login</Button></a>";

    die();
}else {
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $userId = $_SESSION['logged_in_user_id'];
        $title = mysqli_real_escape_string($conn, $title);
        $fileName = bin2hex(openssl_random_pseudo_bytes(10)) . ".txt";
        $myFile = fopen($fileName, 'w+');
        fwrite($myFile, $description);
        fclose($myFile);
        $query = "INSERT INTO articles (user_id, title, file_name) VALUES ('" . $userId . "','" . $title . "', '" . $fileName . "')";
        mysqli_query($conn, $query);
        header('location: /components/post_articles.php');
    }
}
    $query = "SELECT * FROM user_data WHERE id =  " . $_SESSION['logged_in_user_id'] . " ";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);


?>
    <?php include "header.php";?>

    <div class="root">
        <div class="nav">
            <div class="header">
                <img src="Images/download.png" alt="Personal Blogs">
            </div>
            <nav class="navbar">
                <ul>
                    <span><i class="fa-solid fa-user"></i>
                    <?php echo $row['user_name']; ?>
                    </span>
                    <a href="logout.php">
                        <i class="fa-solid fa-user"></i>Logout</a>
                </ul>
            </nav>
        </div>
        <div class="new_article">
            <form action="new_article.php" method="post">
                <input type="text" placeholder="Title" value="" required name="title">
                <textarea name="description" id="" cols="30" rows="10" placeholder="Description..."></textarea>
                <button class="btn btn-secondary" value="post" type="submit">Post</button>
            </form>
        </div>
    </div>


<?php include "footer.php"; ?>