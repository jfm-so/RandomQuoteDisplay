<?php
//Database Info
$servername = "localhost";
$username = "";
$password = "";
$dbname = "";
//Chosen Creds for Admin Dashboard
$admin = "admin";
$adminpass = "";
$nonsense = "eujenwheidnwjhrgjyrghurdghesfhtwdghtsdg";
if (isset($_COOKIE['PrivatePageLogin'])) {
   if ($_COOKIE['PrivatePageLogin'] == md5($adminpass.$nonsense)) {

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
//Create Action "view"
if ($_GET['action'] == "view"){
$sql = "SELECT id, quote FROM quotes";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table><tr><th>ID</th><th>Quote</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["id"]."</td><td>".$row["quote"]." </td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

}
//Create action add
elseif ($_GET['action'] == "add"){
?>
<html>
<body>
<form action="" method="post">
Quote: <input type="text" name="quote" required>
Confirm: <input type="text" name="confirm" value=true>
<input type="submit">
</form>
<?php
if ($_POST['confirm'] == "true"){
$new="INSERT INTO quotes (quote)
VALUES
('$_POST[quote]')";
if (!mysqli_query($conn,$new))
  {
  die('Error: ' . mysqli_error($con));
  }
echo "Record Added";
}

 }
//Create action remove 
elseif ($_GET['action'] == "remove"){
?><html>
<body>
<form action="" method="post">
id: <input type="text" name="id" >
Confirm Remove: <input type="text" name="confirm" value="confirm">
<input type="submit">
</form>
<?php
$id = $_POST['id'];
if ($_POST['confirm'] == "confirm"){
$new="DELETE from quotes where id='".$id."'";
if (!mysqli_query($conn,$new))
  {
  die('Error: ' . mysqli_error($con));
//echo $new;
  }
echo "Record Removed";
}

  }
else {
?> <html>Hello, Welcome to the Admin dashboard. Please append the "?action" string to your request along with a valid action. </html><?php
}
 //Auth

      exit;
   } else {
      echo "Bad Cookie. Remove Cookies and try again";
      exit;
   }
}
if (isset($_GET['action']) && $_GET['action'] == "login") {
   if ($_POST['user'] != $admin) {
      echo "Sorry, that username does not match.";
      exit;
   } else if ($_POST['keypass'] != $adminpass) {
      echo "Sorry, that password does not match.";
      exit;
   } else if ($_POST['user'] == $admin && $_POST['keypass'] == $adminpass) {
      setcookie('PrivatePageLogin', md5($_POST['keypass'].$nonsense));
      header("Location: $_SERVER[PHP_SELF]");
   } else {
      echo "Sorry, you could not be logged in at this time.";
   }
}
?>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>?action=login" method="post">
<label>Username: <input type="text" name="user" id="user" /></label><br />
<label>Password: <input type="password" name="keypass" id="keypass" /></label><br />
<input type="submit" id="submit" value="Login" />
</form>

