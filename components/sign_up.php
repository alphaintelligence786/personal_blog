<?php
include "header.php";
include "conn.php";
session_start();

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $name = $_POST['username'];
    $email = trim(strtolower($_POST['email']));
    $password = $_POST['password'];
    $sql = "SELECT * FROM user_data WHERE email = '$email' and password = '$password'";
    $signUp = mysqli_query($conn, $sql);
    if (mysqli_num_rows($signUp) > 0) {
        $_SESSION['message'] = "User is already Registered";
    } else {
        $query = "INSERT INTO user_data (user_name, email, password) VALUES ('" . $name . "', '" . $email . "', '" . $password . "')";
        $result = mysqli_query($conn, $query);
    }
    header('location: /components/login.php');
    die();
}

?>
    <div class="root">
        <div class="main_signUp">
            <div class="signup_form">
                <div class="sign_up">
                <form action="sign_up.php" method="post" class="sign_up">
                    <div class="header">
                        <img src="Images/download.png" alt="Personal Blogs">
                    </div>
                    <p>Sign Up</p>
                    <label for=""><i class="fa-solid fa-user"></i>
                        <input type="text" placeholder="Username" value=""
                               name="username" required>
                    </label>
                    <label><i class="fa-sharp fa-regular fa-envelope"></i>
                        <input type="email" placeholder="@example.com" value="" name="email" required>
                    </label>
                    <label for=""><i class="fa-solid fa-lock"></i>
                        <input type="password" placeholder="Password" value="" name="password" required>
                    </label>
                    <button class="btn btn-danger" value="Register" type="submit">SIGN UP</button>
                </form>
                <div class="already">
                    <p class="al-registered">Already User?</p>
                    <a href="login.php"><button class="btn btn-warning">SIGN IN</button></a>
                </div>
                </div>
            </div>
        </div>
    </div>

<?php include "footer.php"; ?>
<?php //var_dump($_SESSION);?>