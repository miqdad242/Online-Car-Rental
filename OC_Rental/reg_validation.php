<?php 
include 'assets.php';

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "ocrental";

$conn=mysqli_connect($dbhost,$dbuser,$dbpass,$dbname) or die("Connection Failed");

if(isset($_POST) & !empty($_POST)){
    $customer_username = mysqli_real_escape_string($conn, $_POST['customer_username']);
    if (empty($customer_username)){
        echo "";
    }
    else{
        $sql = "select * from customers where customer_username= '$customer_username'";
        // console.log("Hello world!");
        $result = mysqli_query($conn,$sql);
        $count = mysqli_num_rows($result);
        if($count>0){
            echo '<div style="padding-left:5px; color:red; font-style: italic; font-size: 10px;">Username already Taken</div>';
        }
        else{
            echo '<div style="padding-left:5px; color:green; font-style: italic; font-size: 10px;">available</div>';
        }
    }
   
}

?>