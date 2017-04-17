<?php
	$servername = "localhost";
	$username = "root";
	$password = "adeoluking";
	$dbname = "caesar";
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 

	$email = $conn->real_escape_string($_GET['email']);
	$code = $conn->real_escape_string($_GET['ref']);
	$full = "http://graybot.dev/voting/activate.php?email=". $email . "&ref=" . $code;


	if(empty($email) || empty($code)){
		echo "One or more required parameters are missing please retry the link from your email";
	} else {
		$sql = "SELECT * FROM peanuts where email = '{$email}' and activationLink = '{$full}'";
		$userRow = $conn->query($sql);
		if($userRow->num_rows > 0){
			if($result = $userRow->fetch_assoc()){
				if($result['activated'] == 1){
					echo "account already activated";
				} else{
					//echo "not yet activated";
					$id = $result['_id'];
					$usrEmail = $result['email'];

					$activQuery = "UPDATE peanuts SET activated = '1' WHERE _id = '{$id}' and email = '{$email}'";
					$activate = $conn->query($activQuery);

					if($activate == true){
						echo "Successfully activated!";
					} else {
						echo "Sorry an error occured while trying to activate!";
					}
				}
			}
		}
	}
$conn->close();
?>