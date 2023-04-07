<?php

$conn = new mysqli("localhost", "root", "", "phpvueform");
 
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$out = array('error' => false, 'email'=> false, 'password' => false);

$action = 'read';

if(isset($_GET['action'])){
	$action = $_GET['action'];
}


if($action == 'read'){
	$sql = "select * from users";
	$query = $conn->query($sql);
	$users = array();

	while($row = $query->fetch_array()){
		array_push($users, $row);
	}

	$out['users'] = $users;
}

if($action == 'register'){

	function check_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}

    $firstname = check_input($_POST['firstname']);
    $lastname = check_input($_POST['lastname']);
	$email = check_input($_POST['email']);
	$password = check_input($_POST['password']);

    if($firstname==''){
        $out['firstname'] = true;
        $out['message'] = "Firstname is required";
    }

    elseif($lastname==''){
        $out['lastname'] = true;
        $out['message'] = "Lastname is required";
    }

    elseif($email==''){
		$out['email'] = true;
		$out['message'] = "Email is required";
	}
	
	elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
		$out['email'] = true;
		$out['message'] = "Invalid Email Format";
	}

	elseif($password==''){
		$out['password'] = true;
		$out['message'] = "Password is required";
	}

	else{
		$sql="select * from users where email='$email'";
		$query=$conn->query($sql);
		
		if($query->num_rows > 0){
			$out['email'] = true;
			$out['message'] = "Email already exist";
		}

		else{
			$sql = "insert into users (firsname, lastname, email, password) values ('$firstname', '$lastname', '$email', '$password')";
			$query = $conn->query($sql);

			if($query){
				$out['message'] = "User Added Successfully";
			}
			else{
				$out['error'] = true;
				$out['message'] = "Could not add User";
			}
		}
	}
}

$conn->close();

header("Content-type: application/json");
echo json_encode($out);
die();


?>