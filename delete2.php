<?php
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['delete_id'])) {
    // Get the ID to delete
    $id_to_delete = $_POST['delete_id'];

    // SQL to delete a record
    $sql = "DELETE FROM preke WHERE prekes_nr = $id_to_delete";

    if ($conn->query($sql) === TRUE) {
        // After deletion, update IDs to ensure consecutive numbering
        $sql_update = "SET @num := 0;
                       UPDATE preke SET prekes_nr = @num := @num + 1;
                       ALTER TABLE preke AUTO_INCREMENT = 1;";
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