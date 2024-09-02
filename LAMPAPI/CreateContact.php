<?php

function getRequestInfo()
{
    return json_decode(file_get_contents('php://input'), true);
}

function sendResultInfoAsJson($obj)
{
    header('Content-type: application/json');
    echo $obj;
}

function returnWithError($err)
{
    $retValue = '{"id":0,"error":"' . $err . '"}';
    sendResultInfoAsJson($retValue);
}

function returnWithInfo($id)
{
    $retValue = '{"id":' . $id . ',"error":""}';
    sendResultInfoAsJson($retValue);
}

$inData = getRequestInfo();

// Trim whitespace from the name field
$name = trim($inData["name"]);

if (empty($name)) {
    returnWithError("Name cannot be empty");
    exit();
}

$conn = new mysqli("localhost", "TheBeast", "WeLoveCOP4331", "COP4331");

if( $conn->connect_error )
{
    returnWithError( $conn->connect_error );
}
else
{
    $dateCreated = date("Y-m-d H:i:s");

    $stmt = $conn->prepare("INSERT INTO Contacts (Name, Phone, Email, UserID, DateCreated) VALUES (?, ?, ?, ?, ?)");

    $stmt->bind_param("sssis", $name, $inData["phone"], $inData["email"], $inData["userId"], $dateCreated);

    $stmt->execute();

    if ($stmt->affected_rows > 0)
    {
        $id = $stmt->insert_id;
        returnWithInfo($id);
    }
    else
    {
        returnWithError("Error Creating Contact");
    }

    $stmt->close();
    $conn->close();
}

?>
