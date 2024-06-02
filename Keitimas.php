<?php
include 'connect.php';

// Function to update user information
function updateInfo($conn) {
    // Check if form is submitted
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // Get the values from the form
        $vardas = $_POST['vardas'];
        $pavarde = $_POST['pavarde'];
        $adresas = $_POST['adresas'];
        $telefonas = $_POST['telefonas'];


        if (empty($vardas) || empty($pavarde) || empty($adresas) || empty($telefonas)) {
            echo '<div class="alert alert-danger" role="alert">Please fill in all fields.</div>';
            return;
        }


        $id = $_GET['id'];

        $sql = "UPDATE pirkejai SET vardas = '$vardas', pavarde = '$pavarde', adresas = '$adresas', telefonas = '$telefonas' WHERE pirkejo_nr = $id";
        if ($conn->query($sql) === TRUE) {
            echo '<div class="alert alert-success" role="alert">Update successful!</div>';
        } else {
            echo '<div class="alert alert-danger" role="alert">Update failed. Please try again.</div>';
        }
    }
}


updateInfo($conn);


$id = $_GET['id'];
$sql = "SELECT * FROM pirkejai WHERE pirkejo_nr = $id";
$result = $conn->query($sql);

// Check if user data exists
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    echo "User not found.";
    exit;
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
    <h2>User Information</h2>
    <form method="post" action="">
        <div class="mb-3">
            <label for="vardas" class="form-label">Vardas:</label>
            <input type="text" class="form-control" id="vardas" name="vardas" value="<?php echo $row['vardas']; ?>">
        </div>
        <div class="mb-3">
            <label for="pavarde" class="form-label">Pavardė:</label>
            <input type="text" class="form-control" id="pavarde" name="pavarde" value="<?php echo $row['pavarde']; ?>">
        </div>
        <div class="mb-3">
            <label for="adresas" class="form-label">Adresas:</label>
            <input type="text" class="form-control" id="adresas" name="adresas" value="<?php echo $row['adresas']; ?>">
        </div>
        <div class="mb-3">
            <label for="telefonas" class="form-label">Telefonas:</label>
            <input type="text" class="form-control" id="telefonas" name="telefonas" value="<?php echo $row['telefonas']; ?>">
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