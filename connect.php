<?php
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$gender = $_POST['gender'];
	$email = $_POST['email'];
	$password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password
	$number = $_POST['number'];

	// Database connection
	$conn = new mysqli('localhost','root','','practice');
	if($conn->connect_error){
		echo "$conn->connect_error";
		die("Connection Failed : ". $conn->connect_error);
	} else {
		$stmt = $conn->prepare("insert into registration(firstname, lastname, gender, email, password, number) values(?, ?, ?, ?, ?, ?)");
		$stmt->bind_param("ssssis", $firstname, $lastname, $gender, $email, $password, $number);
		$execval = $stmt->execute();
		if ($execval) {
			echo "Registered succesfully";
		} else {
			echo "Error: " . $stmt->error;
		}
		$stmt->close();
		$conn->close();
	}
?>
