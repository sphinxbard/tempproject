<?php 

$host= 'localhost';
$user='root';
$db = 'hotels_packages';
$con = mysqli_connect($host,$user,'',$db);

if(mysqli_connect_errno($con))
{
    echo "Connection to packages/hotels database failed.";
    mysqli_close($con);
}

function test_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>