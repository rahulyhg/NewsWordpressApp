<?php
include 'deets.php';

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
	 die("Connection failed: " . $conn->connect_error);
} 

if(isset($_GET['proj_username']))
{
$proj_username = $_GET['proj_username'];
}else{
die("404");
}


$querry = "SELECT * FROM `tb_news_user` WHERE `email` = '{$proj_username}'";

if ($result=mysqli_query($conn, $querry)) {
if(mysqli_num_rows($result)>0){
        $row = mysqli_fetch_assoc($result);
	$curl = curl_init();
        //echo $curl;
        // Set some options - we are passing in a useragent too here
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => 'http://api.msg91.com/api/sendhttp.php?authkey=91761A0Q6OzrJc55e9c0d9&mobiles='.$row["username"].'&message=Your%20password%20is%20'.$row["password"].'&sender=OURAPP&route=4&country=0',
            CURLOPT_USERAGENT => 'Codular Sample cURL Request'
        ));
        // Send the request & save response to $resp
        $resp = curl_exec($curl);
        //echo $resp;
        // Close request to clear up some resources
        curl_close($curl);
        }
        
} else {
	echo "Error: " . $querry . "<br>" . mysqli_error($conn);
}
$conn->close();
?>  