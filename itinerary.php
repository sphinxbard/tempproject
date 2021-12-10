<?php 

function getit($PID)
{
    include 'basic.php';
    $it = 0;
    $squery = "SELECT * from itinerary where pid = $PID order by Dayno";
    $it = mysqli_query($con, $squery);
    echo "<table><tr><th>Attraction/Other Details</th><th>Place</th><th>Day no.</th></tr>";
    while($row = mysqli_fetch_assoc($it))
    {
        echo "<tr><td>".$row["Attraction"]."</td><td>".$row["Place"]."</td><td>".$row["Dayno"]."</td><td></tr>";
    }
    echo "</table>";
    $squery = "SELECT * FROM hotel where ID IN(SELECT hid from hotels_assoc_package where pid=$PID)";
    $hotel = mysqli_query($con, $squery);    
    echo "<br><br>Hotels associated with your stay:<br><br>";
    echo "<table><tr><th>Hotel Name</th><th>Rating</th><th>City</th></tr>";
    while($row = mysqli_fetch_assoc($hotel))
    {
        echo "<tr><td>".$row["Name"]."</td><td>".$row["Rating"]."</td><td>".$row["City"]."</td><td></tr>";
    }
    echo "</table>";

}
// [Regular] [Deluxe] [Premium]
function wrapper_getit($d, $n)
{
include 'basic.php';
$query = "SELECT ID from package where Destination = $d and No_of_days = $n";
$pkgid = mysqli_query($con, $query);
getit($pkgid);
}

?>