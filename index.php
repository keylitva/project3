<!DOCTYPE html>
<html lang="en">
<head>
  <title>Parduotuve</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<style>
.color {
    background-color: #35374B;
    color: white;
    font-weight: 900;
    
}
.logohigh {
      display: inline-block; /* Ensure the link behaves like a block-level element */
      height: 10vh; /* Set the height of the link to 50 pixels */
      width: 10vh; /* Set the width of the link to 50 pixels */
      background-image: url('logo.png'); /* Set the background image */
      background-size: cover; /* Cover the entire area of the link with the background image */
      background-position: center; /* Center the background image within the link */
    }
</style>
<body>

<nav class="color navbar navbar-expand-sm"> <!-- Add the "color" class here -->
  <div class="container-fluid">
    <a class="navbar-brand logohigh"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
      <ul class="navbar-nav">
        <li class="nav-item">
          <form method="post">
            <input type="hidden" name="page" value="skaitytojas_list.php">
            <button class="nav-link" type="submit" name="submit" style="color: white">Pirkeju sarasas</button>
          </form>
        </li>
        <li class="nav-item">
          <form method="post">
            <input type="hidden" name="page" value="Knygos_list.php">
            <button class="nav-link" type="submit" name="submit" style="color: white">Prekiu sarasas</button>
          </form>
        </li>
        <li class="nav-item">
          <form method="post">
            <input type="hidden" name="page" value="Isduotos_knygos_list.php">
            <button class="nav-link" type="submit" name="submit" style="color: white">Ataskaitos</button>
          </form>
        </li>
        <li class="nav-item">
          <form method="post">
            <input type="hidden" name="page" value="add.php">
            <button class="nav-link" type="submit" name="submit" style="color: white">Add</button>
          </form>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="container-fluid mt-3">
  

  <?php
session_start();
include 'connect.php';

// Set the current page in session if it's a POST request
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['page'])) {
    $_SESSION['currentPage'] = $_POST['page'];
}

// Include the appropriate file based on the current page
if (isset($_SESSION['currentPage'])) {
    switch ($_SESSION['currentPage']) {
        case 'skaitytojas_list.php':
            include 'skaitytojas_list.php';
            break;
        case 'Knygos_list.php':
            include 'Knygos_list.php';
            break;
        case 'Isduotos_knygos_list.php':
            include 'Isduotos_knygos_list.php';
            break;
        case 'add.php':
            include 'add.php';
            break;
        default:
            echo 'Invalid page requested';
            break;
    }
} else {
    echo '<h2>Welcome to the Home Page</h2>';
}

?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>


