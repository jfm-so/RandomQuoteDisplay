<?php
//EDIT THIS
$header = 'Header';
$title = 'Title';
$mysqlserver = 'localhost'; //Server - Normally Localhost
$username = 'username'; //Database Username
$password = 'password'; //Database Password
$database = 'tips'; //Default of mysql import

//If you do not know what your doing, do not touch!
//If you do not know what your doing, do not touch!
//If you do not know what your doing, do not touch!


$con=mysqli_connect("$mysqlserver","$username","$password","$database");
// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$num = Rand (0,2) ; 
$result = mysqli_query($con,"SELECT * FROM tips ORDER BY RAND() LIMIT 1");

//mysqli_close($con);
?>

<!DOCTYPE html>
<html class="no-js" lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>FakeLifeHacks</title>
		<meta name="description" content="">
		<meta name="robots" content="index, follow">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="/style.css">

	</head>
	<body class="error-page">
		

		<!-- Error page container -->
		<section class="container">
		
			<h2><?php echo $header?></h2>
			<p class="description"><?php echo $title?></p>
		<p>

<?php   
while($row = mysqli_fetch_array($result)) {
  echo "<tr>";
  echo "<td>" . $row['tip'] . "</td>";
  echo "</tr>";
}
?><br><a href="/" class="btn btn-default btn-lg" title="Refresh">Refresh</a></p>
		
		</section>
		<!-- /Error page container -->
		
	</body>
</html>
