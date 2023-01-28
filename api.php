 <?php

//collect user id data from finger print sensor
$id = $_GET["id"];

if ($id % 2 == 0 ) {
    $id = $id / 2 ;
}else if($id % 2 == 1 ){
  $id = ($id + 1) / 2;
}

//database credentials
$servername = "localhost";
$username = "admin";
$password = "hiveaccess22";
$dbname = "fpda";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

switch (date("m")) {
  case 1:
    $c_month = "jan";
    break;
  case 2:
    $c_month = "feb";
    break;
  case 3:
    $c_month = "mar";
    break;
  case 4:
    $c_month = "apr";
    break;
  case 5:
  $c_month = "may";
    break;
  case 6:
    $c_month = "jun";
    break;
  case 7:
    $c_month = "jul";
    break;
  case 8:
    $c_month = "aug";
    break;
  case 9:
    $c_month = "sep";
    break;
  case 10:
    $c_month = "oct";
    break;
  case 11:
    $c_month = "nov";
    break;
  case 12:
    $c_month = "decc";
    break;
  default:
    echo "month not found!";
}

///echo $c_month;
///echo "<br>"."<br>";

$sql = "SELECT * FROM staff WHERE id=$id";
//$sql = "SELECT * FROM staff WHERE id=10";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    $name_f = $row["name"];
    ///echo $name_f;
    
    ///echo "<br>"."<br>";
    
    $sql = "INSERT INTO $c_month (name)
    VALUES ('$name_f')";

    if ($conn->query($sql) === TRUE) {
      echo "#@success*+";
    } else {
      echo "#@error*+";
      ///echo "#@error*+: " . $sql . "<br>" . $conn->error;
    }
    
    //echo "id: " . $row["id"]. " Name: " .$row["name"]. "<br>";
  }
} else {
  echo "0 results";
}

$conn->close();
?>
