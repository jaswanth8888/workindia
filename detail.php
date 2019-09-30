<?php
include("dbconnection.php");
$headers = apache_request_headers();
if(isset($headers) && isset($headers['authorization']) && $_SERVER['REQUEST_METHOD'] === 'GET'){
    $token=$headers['authorization'];
    $sql1="select token from  UserTokens where user_id=".$_GET['id'];
    $result1=mysqli_query($conn,$sql1);
    $row=mysqli_fetch_row($result1);
    if($token==$row[0]){
    
    $id=$_GET['id'];
    $sql="select id,name,phone,dob from contacts where id=".$id;
    $result=mysqli_query($conn,$sql);
    $row=mysqli_fetch_row($result);
    if($result){
        
        echo json_encode(array(
            'id'=> $row[0],
            'name'=>$row[1],
            'phone_number'=>$row[2],
            'date_of_birth'=>$row[3]
        ));
    }
    else{
        echo json_encode(array('success'=>'false'));
    }
}
else{
    echo "token mismatch";
}
}
else{
    http_response_code(403);
    die('Forbidden');
}
?>