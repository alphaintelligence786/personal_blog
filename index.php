<?php
include "components/conn.php";
session_start();
//$query = "SELECT * FROM user_data WHERE id =  " . $_SESSION['logged_in_user_id'] . " ";
//$result = mysqli_query($conn, $query);
//$row = mysqli_fetch_assoc($result);

$query = "SELECT * FROM  articles";
$result = mysqli_query($conn, $query);
include "components/header.php";
?>
<div class="root">
    <div class="nav">
        <div class="header">
            <img src="components/Images/download.png" alt="Personal Blogs">
        </div>
        <?php if (!isset($_SESSION['logged_in_user_id'])) {
            ?>
            <nav class="navbar">
                <ul>
                    <a href="components/sign_up.php">
                        <i class="fa-solid fa-user-plus"></i>Register </a>
                    <a href="/components/login.php">
                        <i class="fa-solid fa-user"></i>Login</a>
                </ul>
            </nav>
        <?php } else {
            $query = "SELECT * FROM user_data WHERE id =  " . $_SESSION['logged_in_user_id'] . " ";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_assoc($result);
            ?>
            <nav class="navbar">
                <ul>
                        <span>
                            <i class="fa-solid fa-user"></i><?php echo $row['user_name'] ?></span>
                    <a href="/components/logout.php">
                        <i class="fa-solid fa-user"></i>Logout</a>
                </ul>
            </nav>
        <?php } ?>
    </div>
    <h2 class="root_articles">Articles</h2>

    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <div class="card" style="width: 18rem;">
            <div class="card-body">
                <h3><?php echo $row['title'] . "\n"; ?></h3>
                <?php $myfile = fopen("components/" . $row['file_name'], "r") or die("Unable to open File!") ?>
                <p> <?php echo fread($myfile, filesize("components/" . $row['file_name'])); ?></p>
            </div>
        </div>

        <?php fclose($myfile); ?>
    <?php } ?>
</div>
<?php include "components/footer.php"; ?>
