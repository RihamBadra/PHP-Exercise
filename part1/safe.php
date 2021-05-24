<?php

require"safe.php";
session_start();
session_destroy();

if($conn){

$username=$_GET["username"];
$password=$_GET["password"];
if($username=="admin"&&$password=="admin123"){
    
	session_start();
$_SESSION['isloggedin']=1;
$_SESSION['username']=$username;
header('location:home.php');
}

if(mysqli_num_rows($loginQuery)==1){
echo"Login Success";
session_start();
$_SESSION['isloggedin']=1;
$_SESSION['username']=$username;
header('location:home.php');

}else{
echo"Wrong Password";  
header('location:home.php');

}
}else{
echo"This Username is not registered,Please click on register";
header('location:home.php');
}
}
}

else{
echo"Connection Error";
header('location:home.php');


}

?>