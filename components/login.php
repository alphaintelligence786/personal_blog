<?php
session_start();
include "conn.php";
include "header.php";

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $email = trim(strtolower($_POST['email']));
    $password = $_POST['password'];
    $sql = "SELECT * FROM user_data WHERE email = '$email' and password = '$password'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $count = mysqli_num_rows($result);
    if ($count == 1) {
        $_SESSION['message'] = "Login Success";
        $_SESSION['logged_in_user_id'] = $row['id'];
        header('location: /components/post_articles.php');
        die();
    } else {
        $_SESSION['message'] = "Login failed. Invalid email or password.";
        header('location: /components/login.php');
    }
    die();

}

?>
<div class="root">
    <div class="nav">


    </div>

    <div class="signup_form">
        <div class="sign_up">
            <form action="login.php" method="post" class="sign_up">
                <div class="header">
                    <img src="Images/download.png" alt="Personal Blogs">
                </div>
                <p class="sign">Sign In</p>
                <?php
                if (isset($_SESSION['message'])) {
                    echo "<h2 style='color: blue'>" . $_SESSION['message'] . "</h2>";
                    unset($_SESSION['message']);
                }
                ?>
                <label><i class="fa-sharp fa-regular fa-envelope"></i>
                    <input type="email" placeholder="@example.com" value="" name="email" required>
                </label>
                <label for=""><i class="fa-solid fa-lock"></i>
                    <input type="password" placeholder="Password" value="" name="password" required>
                </label>
                <button class="btn btn-primary" value="Login" type="submit">SIGN IN</button>
            </form>
            <div class=already>
                <p>OR</p>
                <p class="al-registered">Create an Account</p>
                <a href="sign_up.php"><button class="btn btn-danger" style="width: 100%">SIGN UP</button></a>
            </div>
        </div>
    </div>
</div>

<?php include "footer.php"; ?>
