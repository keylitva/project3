<?php
session_start();
include 'connect.php';

// Assuming $id contains the identifier of the record to be updated
$id = $_GET['id'];

// Handling submission for editing purchased product (nupirktos_prekes)
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['submit_purchased_product'])) {
    $pirkejo_id = $_POST['pirkejo_id'];
    $prekes_id = $_POST['prekes_id'];
    $data = $_POST['data'];

    $sql = "UPDATE nupirktos_prekes SET pirkejo_id = '$pirkejo_id', prekes_id = '$prekes_id', data = '$data' WHERE transaction_id = $id";
    if ($conn->query($sql) === TRUE) {
        echo "Purchased product edited successfully";
        // Redirect to clear POST data
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Retrieving current purchase information from the database
$sql = "SELECT * FROM nupirktos_prekes WHERE transaction_id = $id";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $currentBuyerId = $row['pirkejo_id'];
    $currentProductId = $row['prekes_id'];
    $currentDate = $row['data'];
} else {
    echo "No purchase found with the specified ID";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Purchase Info</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container-fluid mt-3">
    <h2>Edit Purchase Information</h2>
    <form method="post" action="">
        <div class="mb-3">
            <label for="pirkejo_id" class="form-label">Select Buyer:</label>
            <select class="form-select" id="pirkejo_id" name="pirkejo_id">
                <?php
                $sql = "SELECT * FROM pirkejai";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        // Check if the current option matches the current value from the database
                        $selected = ($row['pirkejo_nr'] == $currentBuyerId) ? "selected" : "";
                        echo "<option value='" . $row['pirkejo_nr'] . "' $selected>" . $row['vardas'] . " " . $row['pavarde'] . "</option>";
                    }
                }
                ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="prekes_id" class="form-label">Select Product:</label>
            <select class="form-select" id="prekes_id" name="prekes_id">
                <?php
                $sql = "SELECT * FROM preke";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        // Check if the current option matches the current value from the database
                        $selected = ($row['prekes_nr'] == $currentProductId) ? "selected" : "";
                        echo "<option value='" . $row['prekes_nr'] . "' $selected>" . $row['prekes_pavadinimas'] . "</option>";
                    }
                }
                ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="data" class="form-label">Date:</label>
            <input type="date" class="form-control" id="data" name="data" value="<?php echo $currentDate; ?>">
        </div>
        <button type="submit" name="submit_purchased_product" class="btn btn-primary">Edit Purchase</button>
        <a href="index.php" class="btn btn-secondary">Grįžti į pradinį puslapį</a>
    </form>
</div>
</body>
</html>
