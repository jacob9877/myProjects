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

  // Retrieves the search query from GET request
  $search = $_GET['query'];

  // Prepares the SQL statement
  $stmt = $conn->prepare("SELECT * FROM Contacts WHERE Name LIKE ? OR Phone LIKE ? OR Email LIKE ?");
  $likeSearch = "$search%"; // Adjusted to search for contacts starting with the search query
  $stmt->bind_param("sss", $likeSearch, $likeSearch, $likeSearch);

  // Executes the statement
  if ($stmt->execute()) {
      $result = $stmt->get_result();
      $contacts = [];

      if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
              $contacts[] = $row;
          }
          echo json_encode($contacts);
      } else {
          echo json_encode(['message' => 'No contacts found']);
      }
  } else {
      echo json_encode(['message' => 'Query failed: ' . $stmt->error]);
  }

  // Closes the statement and connection
  $stmt->close();
  $conn->close();
?>
