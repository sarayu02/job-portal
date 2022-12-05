<?php

$server='localhost';
$username='root';
$password='';
$database='job portal';

$conn= mysqli_connect($server,$username,$password,$database);

if($conn->connect_error){
    die("Connection failed:".$conn->connect_error);
}
echo"";

if(isset($_POST['submit'])){
    $name=$_POST['name'];
    $email=$_POST['email'];
    $number=$_POST['phone_no'];
    $password=$_POST['password'];

    $sql= "INSERT INTO users(Name,email,password,phone_no) VALUES ('$name','$email','$password','$number')";
    if(mysqli_query($conn,$sql)){
        echo "Records inserted successfully.";
    }else {
        echo "ERROR: Could not able to execute $sql.",mysqli_error($conn);
    }
}   

session_start();
if(isset($_POST['Login'])){
    $email=$_POST['email'];
    $password=$_POST['password'];
    $query="select * from users where email='$email' and password='$password'";
    $result=mysqli_query($conn,$query);
    $row=mysqli_fetch_array($result,MYSQLI_ASSOC);
    if(mysqli_num_rows($result)==1)
    {
     header('location:index.php');   
    }
    else
    {
        $alert = "Email-id or password is incorrect";
        echo "<script type='text/javascript'>alert('$alert');</script>";
    }
}
if(isset($_POST['press'])){
    $cname=$_POST['cname'];
    $pos=$_POST['pos'];
    $Jdesc=$_POST['Jdesc'];
    $skills=$_POST['skills'];
    $CTC=$_POST['CTC'];
    $sql= "INSERT INTO jobs(cname,position,Jdesc,skills,CTC) VALUES ('$cname','$pos','$Jdesc','$skills','$CTC')";
    if(mysqli_query($conn,$sql)){
        $alert = "New job posted";
        echo "<script type='text/javascript'>alert('$alert');</script>";
    }
    else{
        echo "ERROR: Failed to post new job $sql.".mysqli_error($conn);
    }
}
mysqli_close($conn);
?>