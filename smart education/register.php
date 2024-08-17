<?php


if ($_SERVER["REQUEST METHOD"] = "POST") {

$name htmlspecialchars($_POST['name']);

$r_no htmlspecialchars($ POST['r_no']);

$email htmlspecialchars($_POST['email']);

$password htmlspecialchars($_POST['password']);

$department htmlspecialchars($_POST['department']);

$year htmlspecialchars($_POST['year']);

$conn new mysqli('localhost', 'root', '', 'smart_education');
}

if ($conn->connect_error) { 

die ("Connection failed: " $conn->connect_error);
}

$sql "INSERT INTO students (name,  r_no, email, password) VALUES ('$name', '$r_no', '$email', '$password','$department','$year');



if ($conn->query($sql) === TRUE) {
        
header("Location: index.html");
exit();

else {

echo "Error:". $sql . "<br>" . $conn->error;

}

$conn->close();

}

?>
