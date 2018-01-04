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
  

$name = $_POST['name'];     
$add = $_POST['add'];     

  
$sql = "UPDATE company SET name='$name',address='$add' where id='0'";  

if(!mysqli_query($con,$sql))  
{  
    echo 'Company Not Updated';  
}  
else  
{  
    echo 'Company Updated';  
}  
header("refresh:3; url=index.php")  
?>  