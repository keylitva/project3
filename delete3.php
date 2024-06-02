<?php
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['delete_id'])) {
    // Get the ID to delete
    $id_to_delete = $_POST['delete_id'];

    // SQL to delete a record
    $sql = "DELETE FROM nupirktos_prekes WHERE transaction_id = $id_to_delete";

    if ($conn->query($sql) === TRUE) {
        // After deletion, update IDs to ensure consecutive numbering
        $sql_update = "SET @num := 0;
                       UPDATE nupirktos_prekes SET transaction_id = @num := @num + 1;
                       ALTER TABLE nupirktos_prekes AUTO_INCREMENT = 1;";
        $conn->query($sql_update);

        // Return success message
        echo "success";
    } else {
        // Return error message
        echo "Error deleting record: " . $conn->error;
    }
}

$conn->close();
?>