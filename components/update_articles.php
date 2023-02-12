<?php
session_start();
include "header.php";
include "conn.php";
if (!isset($_SESSION['logged_in_user_id'])){
    echo "<h2> Your Session is expired please login </h2>";
    echo "<a href='login.php'><Button class='btn btn-danger'>Login</Button></a>";
    die();
}
else {
    $query = "SELECT * FROM user_data WHERE id =  " . $_SESSION['logged_in_user_id'] . " ";
    $user = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($user);
    $userId = $_SESSION['logged_in_user_id'];
    $articlesId = $_GET['update'];
    $query = "SELECT * FROM articles WHERE id = '" . $articlesId . "'";
    $result = mysqli_query($conn, $query);
}
?>

    <div class="root">
        <div class="nav">
            <div class="header">
                <img src="Images/download.png" alt="Personal Blogs">
            </div>
            <nav class="navbar">
                <ul>
                    <span><i class="fa-solid fa-user"></i>
                        <?php echo $row['user_name']; ?></span>
                    <a href="logout.php">
                        <i class="fa-solid fa-user"></i>Logout</a>
                </ul>
            </nav>
        </div>
        <div class="new_article">
            <form action="update.php" method="post">
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                        <input type="hidden" name="id" value="<?php echo $articlesId?>">

                    <input type="text" placeholder="Title" value="<?php echo $row['title'] ?>" required name="title">
                    <?php $myfile = fopen($row['file_name'], "r") or die("Unable to open File!") ?>
                    <textarea name="description" id="" cols="30" rows="10"
                              placeholder="Description..."><?php echo fread($myfile, filesize($row['file_name'])) ?></textarea>
                    <button class="btn btn-success" value="post" type="submit">update</button>
                    <?php fclose($myfile); ?>
                <?php } ?>
            </form>
        </div>
    </div>


<?php include "footer.php"; ?>