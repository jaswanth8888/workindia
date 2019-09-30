<?php
include("dbconnection.php");
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $name=$_POST['name'];
    $phonenumber=$_POST['phone_number'];
    $date_of_birth=$_POST['date_of_birth'];
$sql = "INSERT INTO `contacts` (`name`, `phone`, `dob`, `id`) VALUES ('$name', $phonenumber, '$date_of_birth', NULL)";
    $result=mysqli_query($conn,$sql);
    if($result){
        $last_id = $conn->insert_id;
        $token=md5($phonenumber);
        $sql1="INSERT INTO `UserTokens` (`id`, `user_id`, `token`) VALUES (NULL, $last_id, '$token')";
        echo $sql1;
        $result1=mysqli_query($conn,$sql1);
        echo json_encode(array('success'=>'true'));
    }
    else{
        echo json_encode(array('success'=>'false'));
    }
}
?>