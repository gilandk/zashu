<?php

session_start();

if (empty($_SESSION['id_user'])) {
	header("Location: ../index.php");
	exit();
}

require_once("../db.php");

if (isset($_POST)) {
	$to  = $_POST['to'];

	$subject = mysqli_real_escape_string($conn, $_POST['subject']);
	$message = mysqli_real_escape_string($conn, $_POST['description']);

	$sql = "INSERT INTO mailbox (id_fromuser, fromuser, id_touser, subject, message, AmsgRead, CmsgRead) VALUES ('$_SESSION[id_user]', 'user', '$to', '$subject', '$message', '1', '0')";

	if ($conn->query($sql) == TRUE) {
		header("Location: mailbox.php");
		exit();
	} else {
		echo $conn->error;
	}
} else {
	header("Location: mailbox.php");
	exit();
}