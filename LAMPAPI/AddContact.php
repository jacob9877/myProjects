<?php
  header('Content-Type: application/json');

  // Database connection parameters
  $servername = "localhost";
  $username = "TheBeast";
  $password = "WeLoveCOP4331";
  $dbname = "COP4331";
  
  // Creates connection
  $conn = new mysqli($servername, $username, $password, $dbname);
  
  // Checks connection
  if ($conn->connect_error) {
      die(json_encode(['message' => 'Connection failed: ' . $conn->connect_error]));
  }

  // Prepares and executes the SQL statement
  $sql = "INSERT INTO Contacts (Name, Phone, Email, UserID, DateCreated) VALUES (?, ?, ?, ?, ?)";
  $stmt->bind_param("i", $id);

  // Executes the statement and checks if successful
  if ($stmt->execute()) {
      echo json_encode(['message' => 'Contact added successfully']);
  } else {
      echo json_encode(['message' => 'Failed to add contact']);
  }

  // Closes the statement and connection
  $stmt->close();
  $conn->close();
?>
