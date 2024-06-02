<?php
include 'connect.php';
$vardas = $_POST['vardas'];
$pavarde = $_POST['pavarde'];
$skaitytojoNr = $_POST['skaitytojoNr'];
$adresas = $_POST['adresas'];
$telefonas = $_POST['telefonas'];

// Your update query here (modify accordingly)
$sql = "UPDATE Skaitytojas SET Vardas=?, Pavarde=?, Skaitytojo_Nr=?, Adresas=?, Telefonas=? WHERE ID=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssissi", $vardas, $pavarde, $skaitytojoNr, $adresas, $telefonas, $idToUpdate);

$response = array();

if ($stmt->execute()) {
    $response['success'] = true;
} else {
    $response['success'] = false;
}

$stmt->close();
$conn->close();

// Send JSON response
header('Content-Type: application/json');
echo json_encode($response);
?>