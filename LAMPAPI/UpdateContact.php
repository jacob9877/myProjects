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
        $data = json_decode(file_get_contents('php://input'), true);
        $name = $data['name'];
        $phone = $data['phone'];
        $email = $data['email'];

        $query = "UPDATE Contacts SET Name = '$name', Phone = '$phone', Email = '$email' WHERE ID = '$id' AND UserID = '{$_SESSION[>
        if ($conn->query($query) === TRUE) {
         echo json_encode(['message' => 'Contact updated successfully']);
        } else {
        echo json_encode(['message' => 'Failed to update contact']);
        }

        $conn->close();
?>
