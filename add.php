<?php
session_start();
include 'connect.php';

// Handling submission for adding a new buyer (pirkejas)
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['submit_buyer'])) {
    $vardas = $_POST['vardas'];
    $pavarde = $_POST['pavarde'];
    $adresas = $_POST['adresas'];
    $telefonas = $_POST['telefonas'];

    $sql = "INSERT INTO pirkejai (vardas, pavarde, adresas, telefonas) VALUES ('$vardas', '$pavarde', '$adresas', '$telefonas')";
    if ($conn->query($sql) === TRUE) {
        echo "New buyer added successfully";
        // Redirect to clear POST data
        header("Location: {$_SERVER['PHP_SELF']}");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Handling submission for adding a new product (preke)
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['submit_product'])) {
    $prekes_pavadinimas = $_POST['prekes_pavadinimas'];
    $prekes_gamintojas = $_POST['prekes_gamintojas'];
    $prekes_rusis = $_POST['prekes_rusis'];
    $prekes_kaina = $_POST['prekes_kaina'];
    $prekes_data = $_POST['prekes_data'];

    $sql = "INSERT INTO preke (prekes_pavadinimas, prekes_gamintojas, prekes_rusis, prekes_kaina, prekes_data) VALUES ('$prekes_pavadinimas', '$prekes_gamintojas', '$prekes_rusis', '$prekes_kaina', '$prekes_data')";
    if ($conn->query($sql) === TRUE) {
        echo "New product added successfully";
        // Redirect to clear POST data
        header("Location: {$_SERVER['PHP_SELF']}");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Handling submission for adding a purchased product (nupirktos_prekes)
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['submit_purchased_product'])) {
    $pirkejo_id = $_POST['pirkejo_id'];
    $prekes_id = $_POST['prekes_id'];
    $data = $_POST['data'];

    $sql = "INSERT INTO nupirktos_prekes (pirkejo_id, prekes_id, data) VALUES ('$pirkejo_id', '$prekes_id', '$data')";
    if ($conn->query($sql) === TRUE) {
        echo "Purchased product added successfully";
        // Redirect to clear POST data
        header("Location: {$_SERVER['PHP_SELF']}");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add New Record</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
 
<body>

<div class="container-fluid mt-3">
    <h2>Add New Buyer</h2>
    <form method="post" action="">
        <div class="mb-3">
            <label for="vardas" class="form-label">Vardas:</label>
            <input type="text" class="form-control" id="vardas" name="vardas">
        </div>
        <div class="mb-3">
            <label for="pavarde" class="form-label">Pavardė:</label>
            <input type="text" class="form-control" id="pavarde" name="pavarde">
        </div>
        <div class="mb-3">
            <label for="adresas" class="form-label">Adresas:</label>
            <input type="text" class="form-control" id="adresas" name="adresas">
        </div>
        <div class="mb-3">
            <label for="telefonas" class="form-label">Telefonas:</label>
            <input type="text" class="form-control" id="telefonas" name="telefonas">
        </div>
        <button type="submit" name="submit_buyer" class="btn btn-primary">Add Buyer</button>
    </form>
</div>

<div class="container-fluid mt-3">
    <h2>Add New Product</h2>
    <form method="post" action="">
        <div class="mb-3">
            <label for="prekes_pavadinimas" class="form-label">Prekės Pavadinimas:</label>
            <input type="text" class="form-control" id="prekes_pavadinimas" name="prekes_pavadinimas">
        </div>
        <div class="mb-3">
            <label for="prekes_gamintojas" class="form-label">Prekės Gamintojas:</label>
            <input type="text" class="form-control" id="prekes_gamintojas" name="prekes_gamintojas">
        </div>
        <div class="mb-3">
            <label for="prekes_rusis" class="form-label">Prekės Rūšis:</label>
            <input type="text" class="form-control" id="prekes_rusis" name="prekes_rusis">
        </div>
        <div class="mb-3">
            <label for="prekes_kaina" class="form-label">Prekės Kaina:</label>
            <input type="text" class="form-control" id="prekes_kaina" name="prekes_kaina">
        </div>
        <div class="mb-3">
            <label for="prekes_data" class="form-label">Prekės Data:</label>
            <input type="text" class="form-control" id="prekes_data" name="prekes_data">
        </div>
        <button type="submit" name="submit_product" class="btn btn-primary">Add Product</button>
    </form>
</div>

<div class="container-fluid mt-3">
    <h2>Add Purchased Product</h2>
    <form method="post" action="">
        <div class="mb-3">
            <label for="pirkejo_id" class="form-label">Select Buyer:</label>
            <select class="form-select" id="pirkejo_id" name="pirkejo_id">
                <?php
                $sql = "SELECT * FROM pirkejai";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row['pirkejo_nr'] . "'>" . $row['vardas'] . " " . $row['pavarde'] . "</option>";
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
                        echo "<option value='" . $row['prekes_nr'] . "'>" . $row['prekes_pavadinimas'] . "</option>";
                    }
                }
                ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="data" class="form-label">Date:</label>
            <input type="date" class="form-control" id="data" name="data">
        </div>
        <button type="submit" name="submit_purchased_product" class="btn btn-primary">Add Purchased Product</button>
    </form>
</div>

</body>
</html>
