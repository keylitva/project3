<?php
include 'connect.php';

// Check if the delete form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['delete_id'])) {
    $id_to_delete = $_POST['delete_id'];

    // Check if confirmation is received from the user
    if (isset($_POST['confirm_delete']) && $_POST['confirm_delete'] === 'yes') {
        // Perform deletion of the record
        // Proceed with deletion logic here
        echo 'Record deleted successfully!';
        // Redirect to prevent resubmission on page refresh
        header("Location: {$_SERVER['PHP_SELF']}?success=1");
        exit();
    } else {
        // Display a message indicating deletion cancellation
        echo 'Deletion canceled.';
    }
}

$sk = 0;

$sql = "SELECT p.vardas, p.pavarde, pr.prekes_pavadinimas,  np.data, np.transaction_id FROM `nupirktos_prekes` np
join pirkejai p on np.pirkejo_id=p.pirkejo_nr
JOIN preke pr on np.prekes_id=pr.prekes_nr;";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Bought products</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<style>
    body {
        background-color: #344955;
        color: #fff;
    }

    .info-box {
        background-color: #50727B;
        border-radius: 25px;
        width: 70%;
        border: 7px solid #50727B;
        padding: 20px;
        margin-bottom: 3%;
        /* Add margin-bottom to create space between boxes */
        margin-right: auto;
        margin-left: auto;
    }

    .table td {
        background-color: #50727B;
        color: #fff;
        border: 3px solid #344955;
    }

    .line-box {

        margin-top: 1em;
        word-wrap: break-word;
    }

    #line {
        border-top: 2px solid #000;
        width: 100%;
        margin: 0;
    }

    .btn-info,
    .btn-danger {
        color: #fff;
        margin-top: 10px;
    }

    @media screen and (max-width: 992px) {
        /* Apply styles for screens smaller than 992px (medium devices) */
        .info-box {
            width: 85%;
            /* Adjust width for medium screens */
        }
    }
</style>

<body>

    <div class="container">
        <h2 class="text-center mt-3 mb-4">Bought product List</h2>
        <?php
        echo '<div class="d-flex justify-content-center mb-3">';
        echo '<form method="post" action="Laikotarpis.php">';
        echo '<button class="btn btn-primary rounded-pill px-4" type="submit" name="submit">Ieskoti</button>';
        echo '</form></div>';
        ?>
        <div class="table-responsive">
            <table class="table table-bordered">
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        // output data of each row
                        while ($row = $result->fetch_assoc()) {
                            $sk = $sk + 1;
                            echo '<div class="info-box">
                      <div class="line-box"><strong style="color:#000;">ID:</strong> ' . $row["transaction_id"] . '</div>
                      <div class="line-box"><hr id="line"><strong style="color:#000;">Vardas: </strong>' . $row["vardas"] . '</div>
                      <div class="line-box"><hr id="line"><strong style="color:#000;">Pavardė: </strong>' . $row["pavarde"] . '</div>
                      <div class="line-box"><hr id="line"><strong style="color:#000;">Pavadinimas: </strong>' . $row["prekes_pavadinimas"] . '</div>
                      <div class="line-box"><hr id="line"><strong style="color:#000;">Data: </strong>' . $row["data"] . '</div>
                      <div class="line-box">
                          <a href="keitimas3.php?id=' . $row["transaction_id"] . '" class="btn btn-info">Redaguoti</a>
        				  <form method="post" action="delete3.php" class="d-inline-block delete-form">
                              <input type="hidden" name="delete_id" value="' . $row["transaction_id"] . '">
                              <input type="hidden" name="confirm_delete" value="no">
                              <button type="submit" class="btn btn-danger" onclick="return confirm(\'Are you sure you want to delete this record?\')">Trinti</button>
       					  </form>
                      </div>
                      </div>';
                        }
                    } else {
                        echo "<tr><td colspan='7'>0 results</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>


    <!-- Add jQuery library (if not already included) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>

</body>

</html>
