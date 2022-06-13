<?php
require '../../vendor/autoload.php';

$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();

function check_loggedin($pdo, $redirect_file = 'index.php')
{
    // Update last seen
    if (isset($_SESSION['loggedin'])) {
        $date = date('Y-m-d\TH:i:s');
        $stmt = $pdo->prepare('UPDATE accounts SET last_seen = ? WHERE id = ?');
        $stmt->execute([$date, $_SESSION['id']]);
    }

    // Check for remember me cookie variable and loggedin session variable
    if (isset($_COOKIE['rememberme']) && !empty($_COOKIE['rememberme']) && !isset($_SESSION['loggedin'])) {
        // If the remember me cookie matches one in the database then we can update the session variables.
        $stmt = $pdo->prepare('SELECT * FROM accounts WHERE rememberme = ?');
        $stmt->execute([$_COOKIE['rememberme']]);
        $account = $stmt->fetch(PDO::FETCH_ASSOC);
        // If account exists...
        if ($account) {
            // Found a match, update the session variables and keep the user logged-in
            session_regenerate_id();
            $_SESSION['loggedin'] = true;
            $_SESSION['name'] = $account['username'];
            $_SESSION['id'] = $account['id'];
            $_SESSION['role'] = $account['role'];
            // Update last seen date
            $date = date('Y-m-d\TH:i:s');
            $stmt = $pdo->prepare('UPDATE accounts SET last_seen = ? WHERE id = ?');
            $stmt->execute([$date, $account['id']]);
        } else {
            // If the user is not remembered redirect to the login page.
            header('Location: ' . __DIR__ . "/pages/auth/inloggen.php");
            exit;
        }
    } else if (!isset($_SESSION['loggedin'])) {
        // If the user is not logged in redirect to the login page.
        header('Location: ' . __DIR__ . "/pages/auth/inloggen.php");
        exit;
    }
}

function send_activation_email($email, $code)
{
    $mail = new PHPMailer(true);

    $mail->setFrom("inschrijvingen@k-eventsvzw.be");
    $mail->addAddress($email);
    $activate_link = $activation_link . '?email=' . $email . '&code=' . $code;
    $body = str_replace('%link%', $activate_link, file_get_contents('activation-email-template.html'));
    $mail->isHTML(true);
    $mail->Subject = 'Account verificatie vereist';
    $mail->Body = $body;
    $mail->send();
}