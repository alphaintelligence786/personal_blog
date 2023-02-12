<?php
$conn = mysqli_connect('localhost','root', '');
if (!$conn){
    die("Connection Failed");
}
$result = mysqli_query($conn, "CREATE DATABASE IF NOT EXISTS personal_blog");
mysqli_select_db($conn,'personal_blog');

$user = "CREATE TABLE user_data( 
user_id int(150) AUTO_INCREMENT PRIMARY KEY,
user_name VARCHAR (150) NOT NULL, 
email VARCHAR (150) NOT NULL, 
password VARCHAR (150) NOT NULL    
)";
$create_table = "CREATE TABLE articles(
id int(150) AUTO_INCREMENT PRIMARY KEY, 
user_id int(150) NOT NULL,     
title VARCHAR(150) NOT NULL ,  
file_name VARCHAR(150) NOT NULL 
                          
)";
$results = mysqli_query($conn, $user);
$results = mysqli_query($conn, $create_table);

