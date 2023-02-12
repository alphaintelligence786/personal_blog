<?php
session_start();
include "conn.php";
$articleId = $_POST['id'];
$title = mysqli_real_escape_string($conn, $_POST['title']);
$description = mysqli_real_escape_string($conn, $_POST['description']);

$result = mysqli_query($conn, "SELECT * FROM articles WHERE id='" . $articleId . "'");
$row = mysqli_fetch_assoc($result);

$fileName = $row['file_name'];

$myfile = fopen($fileName, 'w+') or die("unable to open file!");
fwrite($myfile, $description);
fclose($myfile);

$result = mysqli_query($conn, "UPDATE articles SET title='" . $title . "' WHERE id='" . $articleId. "'");
header("location: /components/my_articles.php");



