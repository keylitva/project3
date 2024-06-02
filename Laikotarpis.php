<!DOCTYPE html>
<html lang="en">
<head>
  <title>Nupirkti produktai</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>

<div class="container-fluid mt-3">
  <h2>Nupirkti produktai</h2>

  <!-- Form for name and surname selection -->
  <form method="post">
    <div class="mb-3">
      <label for="name" class="form-label">Vardas:</label>
      <input type="text" class="form-control" id="name" name="name">
    </div>
    <div class="mb-3">
      <label for="surname" class="form-label">Pavarde:</label>
      <input type="text" class="form-control" id="surname" name="surname">
    </div>
    <button type="submit" class="btn btn-primary">Rasti</button>
  </form>

<?php
include 'connect.php';
$sk = 0;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $surname = $_POST["surname"];

    // Modify the SQL query to retrieve products bought by the specified person
    $sql = "SELECT p.vardas, p.pavarde, pr.prekes_pavadinimas, np.data, np.transaction_id 
            FROM `nupirktos_prekes` np
            JOIN pirkejai p ON np.pirkejo_id = p.pirkejo_nr
            JOIN preke pr ON np.prekes_id = pr.prekes_nr";

    // Adjust the SQL query based on the provided name and/or surname
    if (!empty($name) && !empty($surname)) {
        // Both name and surname provided
        $sql .= " WHERE p.vardas = '$name' AND p.pavarde = '$surname'";
    } elseif (!empty($name)) {
        // Only name provided
        $sql .= " WHERE p.vardas = '$name'";
    } elseif (!empty($surname)) {
        // Only surname provided
        $sql .= " WHERE p.pavarde = '$surname'";
    }

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo '<div class="mt-3"></div>'; // Adding space
        echo '<table class="table table-striped table-bordered table-rounded">
              <thead>
                <tr>
                  <th>Vardas</th>
                  <th>Pavarde</th>
                  <th>Prekes Pavadinimas</th>
                  <th>Data</th>
                  <th>Transaction ID</th>
                </tr>
              </thead>
              <tbody>';

        while ($row = $result->fetch_assoc()) {
            echo '<tr> 
                <td>' . $row["vardas"] . '</td>
                <td>' . $row["pavarde"] . '</td>
                <td>' . $row["prekes_pavadinimas"] . '</td>
                <td>' . $row["data"] . '</td>
                <td>' . $row["transaction_id"] . '</td>
              </tr>';
        }

        echo '</tbody></table>';
    } else {
        echo "No results found for the specified name and/or surname.";
    }
}

$conn->close();
?>


</div>

</body>
</html>
