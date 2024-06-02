$sql = "UPDATE mokinys SET pavarde='Doe' WHERE id=2";
if ($conn->query($sql) === TRUE) {
 echo "Record updated successfully";
} else {
 echo "Error updating record: " . $conn->error;
}
$conn->close();