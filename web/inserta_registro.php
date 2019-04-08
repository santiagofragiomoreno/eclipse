 <?php
$servername = "server189.hostinger.es";
$username = "u823703154";
$password = "santiago87";
$dbname = "u823703154_estu";

$codigo=$_GET['codigo'];
$peso=$_GET['peso'];


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "INSERT INTO productos (codigo, peso_actual)
VALUES ($codigo, $peso)";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?> 