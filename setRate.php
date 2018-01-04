<?php  
  
$con = mysqli_connect('127.0.0.1','root','');  
  
if(!$con)  
{  
    echo 'not connect to the server';  
}  
if(!mysqli_select_db($con,'invoice'))  
{  
    echo 'database not selected';  
}  
  

$Rate = $_POST['Rate'];     

  
$sql = "UPDATE gst SET rate='$Rate' where id='0'";  

if(!mysqli_query($con,$sql))  
{  
    echo 'Rate Not Updated';  
}  
else  
{  
    echo 'Rate Updated';  
}  
header("refresh:3; url=index.php")  
?>  