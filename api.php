<?php
//EDIT THIS

$mysqlserver = 'localhost'; //Server - Normally Localhost
$username = 'username'; //Database Username
$password = 'password'; //Database Password
$database = 'tips'; //Default of mysql import
//If you do not know what your doing, do not touch!
$con=mysqli_connect("$mysqlserver","$username","$password","$database");
// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
$num = Rand (0,2) ; 
$result = mysqli_query($con,"SELECT * FROM tips ORDER BY RAND() LIMIT 1");

while($row = mysqli_fetch_array($result)) {
  echo "<tr>";
  echo "<td>" . $row['tip'] . "</td>";
  echo "</tr>";
}
?>
		
