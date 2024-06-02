<?php
include 'connect.php';

// Check if ID is provided in the URL
if(isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch user information based on ID
    $sql = "SELECT * FROM `preke` WHERE `prekes_nr` = $id";
    $result = $conn->query($sql);

    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // You can use the fetched data to pre-fill the form fields
        $prekes_nr = $row['prekes_nr'];
        $prekes_pavadinimas = $row['prekes_pavadinimas'];
        $prekes_gamintojas = $row['prekes_gamintojas'];
        $prekes_rusis = $row['prekes_rusis'];
        $prekes_kaina = $row['prekes_kaina'];
        $prekes_data = $row['prekes_data'];
    } else {
        echo "User not found";
        exit; // Exit if user not found
    }
} else {
    echo "Invalid request";
    exit; // Exit if ID is not provided
}

// If form is submitted
if($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve data from the form
    $prekes_pavadinimas = $_POST['prekes_pavadinimas'];
    $prekes_gamintojas = $_POST['prekes_gamintojas'];
    $prekes_rusis = $_POST['prekes_rusis'];
    $prekes_kaina = $_POST['prekes_kaina'];
    $prekes_data = $_POST['prekes_data'];

    // Update user information in the database
    $sql = "UPDATE `preke` SET `prekes_pavadinimas`='$prekes_pavadinimas', `prekes_gamintojas`='$prekes_gamintojas', `prekes_rusis`='$prekes_rusis', `prekes_kaina`='$prekes_kaina', `prekes_data`='$prekes_data' WHERE `prekes_nr`='$id'";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>


<div class="container-fluid mt-3">
    <h2>Product Information</h2>
    <form method="post" action="">
        <div class="mb-3">
            <label for="prekes_pavadinimas" class="form-label">Prekės Pavadinimas:</label>
            <input type="text" class="form-control" id="prekes_pavadinimas" name="prekes_pavadinimas" value="<?php echo $row['prekes_pavadinimas']; ?>">
        </div>
        <div class="mb-3">
            <label for="prekes_gamintojas" class="form-label">Prekės Gamintojas:</label>
            <input type="text" class="form-control" id="prekes_gamintojas" name="prekes_gamintojas" value="<?php echo $row['prekes_gamintojas']; ?>">
        </div>
        <div class="mb-3">
            <label for="prekes_rusis" class="form-label">Prekės Rūšis:</label>
            <input type="text" class="form-control" id="prekes_rusis" name="prekes_rusis" value="<?php echo $row['prekes_rusis']; ?>">
        </div>
        <div class="mb-3">
            <label for="prekes_kaina" class="form-label">Prekės Kaina:</label>
            <input type="text" class="form-control" id="prekes_kaina" name="prekes_kaina" value="<?php echo $row['prekes_kaina']; ?>">
        </div>
        <div class="mb-3">
            <label for="prekes_data" class="form-label">Prekės Data:</label>
            <input type="text" class="form-control" id="prekes_data" name="prekes_data" value="<?php echo $row['prekes_data']; ?>">
        </div>
        <button type="submit" class="btn btn-primary">Atnaujinti</button>
        <a href="index.php" class="btn btn-secondary">Grįžti į pradinį puslapį</a>
    </form>
</div>

</body>
</html>

<?php
// Close the database connection
$conn->close();
?>