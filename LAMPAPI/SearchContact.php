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
  if (!isset($_SESSION['userId'])) {
      echo json_encode(['message' => 'User not logged in']);
      exit;
  }
  $user_id = $_SESSION['userId'];
  $search = $_GET['query'];
  
  $query = "SELECT * FROM Contacts WHERE UserID = '$user_id' AND (Name LIKE '%$search%' OR Phone LIKE '%$search%' OR Email LIKE '%$se>
  $result = $conn->query($query);
  
  if (!$result) {
      echo json_encode(['message' => 'Query failed: ' . $conn->error]);
      exit;
  }
  
  $contacts = [];
  if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
          $contacts[] = $row;
      }
  } else {
      echo json_encode(['message' => 'No contacts found']);
      exit;
  }
  
  echo json_encode($contacts);
  $conn->close();
?>
