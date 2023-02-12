<?php include "header.php"; ?>
    <div class="root">
        <div class="nav">
            <div class="header">
                <img src="Images/download.png" alt="Personal Blogs">
            </div>
            <nav class="navbar">
                <ul>
                    <a href="index.php">
                        <i class="fa-solid fa-user-plus"></i>Register </a>
                    <a href="/components/my_blog.php">
                        <i class="fa-solid fa-user"></i>Login  </a>
                </ul>
            </nav>
        </div>

        <div class="form">
            <form action="contact_me.php" method="post" class="contact_me">
                <h2>Let me know what's on your mind</h2>
                <input type="text" placeholder="First Name" value="" name="first-name" required>
                <input type="text" placeholder="Last Name" value="" name="first-name" required>
                <input type="email" placeholder="Email" value="" name="email*" required>
                <input type="text" placeholder="Leave us a message" value="" name="message" required>
                <input type="submit" value="Submit" class="btn btn-primary">
            </form>
        </div>
    </div>

<?php include "footer.php"; ?>