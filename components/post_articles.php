<?php
session_start();
include "conn.php";
if (isset($_GET['del'])) {
    $id = $_GET['del'];
    $result = mysqli_query($conn, "DELETE FROM articles WHERE id=$id");
    var_dump($result);
    header('location: /components/post_articles.php');
    die();
}
if (!isset($_SESSION['logged_in_user_id'])) {
    echo "<h2> Your Session is expired please login </h2>";
    echo "<a href='login.php'><Button class='btn btn-danger'>Login</Button></a>";
    die();
}
else {
    $query = "SELECT * FROM user_data WHERE id =  " . $_SESSION['logged_in_user_id'] . " ";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $query = "SELECT * FROM articles";
    $result = mysqli_query($conn, $query);
}
?>
<?php include "header.php"; ?>
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
                    <a href=" my_articles.php"><i class="fa-solid fa-user"></i>
                                        My Articles
                    </a>
                    <a href="logout.php">
                        <i class="fa-solid fa-user"></i>Logout</a>
                </ul>
            </nav>
        </div>
        <div class="post_article">
            <a href="/components/new_article.php">
                <button class="btn btn-primary"> <i class="fa-solid fa-circle-plus"></i>Post New Article</button>
            </a>
        </div>
        <h2 class="articles">Articles</h2>
        <div class="main_articles">
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h3><?php echo $row['title'] . "\n"; ?></h3>
                        <?php $myfile = fopen($row['file_name'], "r") or die("Unable to open File!") ?>
                        <p> <?php echo fread($myfile, filesize($row['file_name'])); ?></p>
                    </div>
                </div>
                <?php fclose($myfile); ?>
                <?php echo "<br>"?>
            <?php } ?>
        </div>
    </div>

<?php include "footer.php"; ?>
