<?php
if (isset($_SESSION['loggedin'])) {
    header('Location: home.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registreren</title>
  <link rel="stylesheet" href="../../styles/css/main.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
</head>

<body>
  <div class="wrapper-auth">
    <div class="register">
      <h1>Registreren</h1>
      <div class="links">
        <a href="inloggen.php">Inloggen</a>
        <a href="registreren.php" class="active">Registreren</a>
      </div>
      <form action="authenticate.php" method="post">
        <label for="username">
          <i class="fas fa-user"></i>
        </label>
        <input type="text" name="username" placeholder="Email" id="username" required>
        <label for="password">
          <i class="fas fa-lock"></i>
        </label>
        <input type="password" name="password" placeholder="Wachtwoord" id="password" required>
        <label for="password">
          <i class="fas fa-lock"></i>
        </label>
        <input type="password" name="password" placeholder="Hehaal Wachtwoord" id="password" required>
        <div class="msg"></div>
        <input type="submit" value="Registreren">
      </form>
    </div>
  </div>
</body>

</html>