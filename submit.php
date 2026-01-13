<?php
include 'db.php';

$name=$_POST['name'];
$phone=$_POST['phone'];
$email=$_POST['email'];
$address=$_POST['address'];
$car=implode(",",$_POST['car']);

mysqli_query($conn,"INSERT INTO car_enquiry 
(name,phone,email,address,car_type)
VALUES ('$name','$phone','$email','$address','$car')");

echo "<script>alert('Enquiry Submitted');window.location='index.php';</script>";
