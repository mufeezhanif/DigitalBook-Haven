<?php
include("config.php");

$search = $_POST['search'];

$query =  "select * from products where name like '%{$search}%' or author like '%{$search}%' or category like '%{$search}%' or description like '%{$search}%'";

$data = mysqli_query($connection,$query);

echo json_encode(mysqli_fetch_all($data,MYSQLI_ASSOC));

?>