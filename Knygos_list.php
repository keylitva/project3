<?php

include 'connect.php';

// Check if the delete form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['delete_id'])) {
    $id_to_delete = $_POST['delete_id'];
echo 'id_to_delete='.$id_to_delete;

if (isset($_GET['success']) && $_GET['success'] == 1) {
    echo '<div class="alert alert-success alert-dismissible fade show text-center" role="alert">
            Record deleted successfully!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
}
}

$sk = 0;

$sql = "SELECT * FROM `preke`";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Prekiu edit</title>
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
        margin-bottom: 3%; /* Add margin-bottom to create space between boxes */
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

        .btn-info, .btn-danger {
            color: #fff; 
            margin-top: 10px; 
        }
@media screen and (max-width: 992px) {
        /* Apply styles for screens smaller than 992px (medium devices) */
        .info-box {
            width: 85%; /* Adjust width for medium screens */
        }
    </style>
<body>

<div class="container">
    <h2 class="text-center mt-3 mb-4">Product List</h2>
    <div class="table-responsive">
        <table class="table table-bordered">
            <tbody>
            <?php
            if ($result->num_rows > 0) {
                // output data of each row
                while ($row = $result->fetch_assoc()) {
                    $sk = $sk + 1;
                    echo '<div class="info-box">
                          <div class="line-box"><strong style="color:#000;">ID:</strong> ' . $row["prekes_nr"] . '</div>
                          <div class="line-box"><hr id="line"><strong style="color:#000;">Vardas: </strong>' . $row["prekes_pavadinimas"] . '</div>
                          <div class="line-box"><hr id="line"><strong style="color:#000;">Gamintojas: </strong>' . $row["prekes_gamintojas"] . '</div>
                          <div class="line-box"><hr id="line"><strong style="color:#000;">Rusis: </strong>' . $row["prekes_rusis"] . '</div>
                          <div class="line-box"><hr id="line"><strong style="color:#000;">Kaina: </strong>' . $row["prekes_kaina"] . '</div>
                          <div class="line-box"><hr id="line"><strong style="color:#000;">Data: </strong>' . $row["prekes_data"] . '</div>
                          
                    
                        <div class="line-box">
                          <a href="Keitimaspr.php?id=' . $row["prekes_nr"] . '" class="btn btn-info">Redaguoti</a>
        				  <form method="post" action="delete2.php" class="d-inline-block delete-form">
           				  <input type="hidden" name="delete_id" value="' . $row["prekes_nr"] . '">
           				  <input type="submit" class="btn btn-danger" value="Trinti">
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
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
$(document).ready(function(){
    // Submit deletion request via AJAX
    $(".delete-form").submit(function(e){
        e.preventDefault(); // Prevent form submission
        
        // Get form data
        var formData = $(this).serialize();
        
        // Send AJAX request
        $.ajax({
            url: "delete2.php",
            type: "POST",
            data: formData,
            success: function(response){
                if (response === "success") {
                    // Show success pop-up
                    alert("Record deleted successfully!");
                    // Reload the page to reflect changes
                    location.reload();
                } else {
                    // Show error pop-up
                    var errorMessage = response.split(': ')[1]; // Extracting the relevant part of the error message
                    alert("Error deleting record: " + errorMessage);
                }
            },
            error: function(xhr, status, error){
                // Show error pop-up
                alert("Error: " + error);
            }
        });
    });
});
</script>



</body>
</html>



