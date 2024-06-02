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

$sql = "SELECT * FROM `pirkejai`";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
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
            margin-bottom: 20px; 
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
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <h2 class="text-center mt-3 mb-4">Buyers List</h2>
        <?php
        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                $sk = $sk + 1;
                echo '<div class="info-box">
                      <div class="line-box"><strong style="color:#000;">ID:</strong> ' . $row["pirkejo_nr"] . '</div>
                      <div class="line-box"><hr id="line"><strong style="color:#000;">Vardas: </strong>' . $row["vardas"] . '</div>
                      <div class="line-box"><hr id="line"><strong style="color:#000;">Pavardė: </strong>' . $row["pavarde"] . '</div>
                      <div class="line-box"><hr id="line"><strong style="color:#000;">Adresas: </strong>' . $row["adresas"] . '</div>
                      <div class="line-box"><hr id="line"><strong style="color:#000;">Telefonas: </strong>' . $row["telefonas"] . '</div>
                      <div class="line-box">
                          <a href="Keitimas.php?id=' . $row["pirkejo_nr"] . '" class="btn btn-info">Redaguoti</a>
        				  <form method="post" action="Delete1.php" class="d-inline-block delete-form">
           				  <input type="hidden" name="delete_id" value="' . $row["pirkejo_nr"] . '">
           				  <input type="submit" class="btn btn-danger" value="Trinti">
       					  </form>
                      </div>
                      </div>';
            }
        } else {
            echo "<div class='info-box'>0 results</div>";
        }
        ?>
    </div>
</div>


<!-- Add jQuery library (if not already included) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
            if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
$(document).ready(function(){
    
    $(".delete-form").submit(function(e){
        e.preventDefault(); 
        
        
        var formData = $(this).serialize();
        
        
        $.ajax({
            url: "Delete1.php",
            type: "POST",
            data: formData,
            success: function(response){
                if (response === "success") {
                    
                    alert("Record deleted successfully!");
                    
                    location.reload();
                } else {
                    
                    var errorMessage = response.split(': ')[1]; 
                    alert("Error deleting record: " + errorMessage);
                }
            },
            error: function(xhr, status, error){
                
                alert("Error: " + error);
            }
        });
    });
});
</script>



</body>
</html>



