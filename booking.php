<?php 
include 'basic.php';
include 'itinerary.php';
echo '<head><link rel="stylesheet" type="text/css" href="booking.css"></head>';

$destination = $nog = $departure = $arrival = "";
if($_SERVER["REQUEST METHOD"] == "POST")
{
    $destination = test_input($_POST["destination"]);
    $nog = test_input($_POST["nog"]);
    $departure = test_input($_POST["departure"]);
    $arrival = test_input($_POST["arrival"]);
}
$nod = $arrival - $departure + 1;
$basecharge = 10000;
$persons = ceil($nog/2);
//For all of these, +$flightcharge from Khushi's database
$regamt = $basecharge + ($persons*$nod)*3000; 
$deluxamt = $basecharge + ($persons*$nod)*5000; 
$premamt = $basecharge + ($persons*$nod)*7000; 
$query = "SELECT * from package where Destination = $destination and No_of_days = $nod";
$result = mysqli_query($con, $query);

if(mysqli_num_rows($result) == 0)
{
    echo "Sorry, we don't have packages for $destination that are $nod days long right now.";
    echo "<br><br>But don't worry! We're slowly expanding our reach. Meanwhile, you can check out the following packages:<br><br>";
    $query = "SELECT * from package";
    $result = mysqli_query($con, $query);
    echo "
    <div class=\"filter\">

    </div>

    <table>



        <tr>


            <th>Destination</th>

            <th>No. of Days</th>

            <th>Starting from</th>

            <th>View Details</th>

        </tr>";
    while($row = mysqli_fetch_assoc($result))
    {
        $d = $row['Destination'];
        $n = $row['No_of_days'];
        echo "<tr><td>".$row['Destination']."</td><td>".$row['No_of_days']."</td><td>$regamt</td><td><a href=\"<?php wrapper_getit($d,$n);?>\" class=\"btn\">View Itinerary</a></td></tr>";
    }
    echo "</table>";
}

else
{
    echo "
    <div class=\"filter\">

    </div>

    <table>



        <tr>


            <th>Destination</th>

            <th>No. of Days</th>

            <th>Starting from</th>

            <th>View Details</th>

        </tr>";
    while($row = mysqli_fetch_assoc($result))
    {
        $d = $row['Destination'];
        $n = $row['No_of_days'];
        echo "<tr><td>".$row['Destination']."</td><td>".$row['No_of_days']."</td><td>$regamt</td><td><a href=\"<?php wrapper_getit($d,$n);?>\" class=\"btn\">View Itinerary</a></td></tr>";
        //Make a button here which on clicking sends values of $d and $n to itinerary.php

    }
    echo "</table>";
}

?>

