<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inloggen</title>
  <link rel="stylesheet" href="../../styles/css/main.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
</head>

<body>
  <div class="wrapper-auth">
    <div class="login">
      <h1>Inloggen</h1>
      <div class="links">
        <a href="inloggen.php" class="active">Inloggen</a>
        <a href="registreren.php">Registreren</a>
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
        <label id="rememberme">
          <input type="checkbox" name="rememberme">Onthoud mijn account
        </label>
        <div class="msg"></div>
        <input type="submit" value="Inloggen">
      </form>
    </div>
  </div>
</body>

</html>