<?php
  header('Content-Type: application/json');
  $servername = "localhost";
  $username = "TheBeast";
  $password = "WeLoveCOP4331";
  $dbname = "COP4331";
  
  // Creates connection
  $conn = new mysqli($servername, $username, $password, $dbname);
  
  // Checks connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }
  
  session_start();
  $id = $_GET['id'];
  $query = "DELETE FROM Contacts WHERE ID = '$id' AND UserID = '{$_SESSION['user_id']}'";
  if ($conn->query($query) === TRUE) {
      echo json_encode(['message' => 'Contact deleted successfully']);
  } else {
      echo json_encode(['message' => 'Failed to delete contact']);
  }
  
  $conn->close();
?>
