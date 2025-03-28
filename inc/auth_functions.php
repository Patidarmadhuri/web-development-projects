<?php

// Check if a user is logged in
function isUserLoggedIn()
{
    return isset($_SESSION["userId"]);
}

// Check if the logged-in user is an admin
function isUserAdmin()
{
    return isUserLoggedIn() && isset($_SESSION["userRole"]) && $_SESSION["userRole"] === "admin";
}

// Sign up a new user with the given email, username, and password
function userSignup($email, $userName, $passWord)
{
    global $conn;

    if (!$conn) {
        return ["success" => false, "message" => "Datenbankverbindung fehlgeschlagen."];
    }

    // Check if the email already exists
    $sql = "SELECT u_id FROM tblusers WHERE u_email = ?";
    $stmt = mysqli_prepare($conn, $sql);
    if (!$stmt) {
        return ["success" => false, "message" => "Fehler beim Überprüfen der E-Mail-Adresse."];
    }

    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        mysqli_stmt_close($stmt);
        return ["success" => false, "message" => "Die E-Mail-Adresse '$email' ist bereits registriert."];
    }
    mysqli_stmt_close($stmt);

    // Insert the new user
    $sql = "INSERT INTO tblusers (u_email, u_username, u_password) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    if (!$stmt) {
        return ["success" => false, "message" => "Fehler beim Erstellen des Benutzers."];
    }

    // Hash the password securely
    $hashedPassword = password_hash($passWord, PASSWORD_DEFAULT);
    mysqli_stmt_bind_param($stmt, "sss", $email, $userName, $hashedPassword);
    
    try {
        $success = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        if ($success) {
            return ["success" => true, "message" => "Registrierung erfolgreich!"];
        } else {
            return ["success" => false, "message" => "Fehler bei der Registrierung. Bitte versuchen Sie es erneut."];
        }
    } catch (mysqli_sql_exception $e) {
        mysqli_stmt_close($stmt);
        if ($e->getCode() == 1062) {
            return ["success" => false, "message" => "Ein unerwarteter Fehler ist aufgetreten: " . $e->getMessage()];
        }
        return ["success" => false, "message" => "Fehler bei der Registrierung: " . $e->getMessage()];
    }
}

// Log in a user with the given login input (email or username) and password
function userLogin($loginInput, $passWord)
{
    global $conn;

    if (!$conn) {
        return ["success" => false, "message" => "Datenbankverbindung fehlgeschlagen."];
    }

    $sql = "SELECT u_id, u_email, u_username, u_password, u_role 
            FROM tblusers 
            WHERE u_email = ? OR u_username = ?";
    $stmt = mysqli_prepare($conn, $sql);
    if (!$stmt) {
        return ["success" => false, "message" => "Fehler beim Abrufen des Benutzers."];
    }

    mysqli_stmt_bind_param($stmt, "ss", $loginInput, $loginInput);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) === 0) {
        mysqli_stmt_close($stmt);
        return ["success" => false, "message" => "E-Mail-Adresse oder Benutzername nicht gefunden."];
    }

    $user = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);

    if (password_verify($passWord, $user["u_password"])) {
        $_SESSION["userId"] = $user["u_id"];
        $_SESSION["userName"] = $user["u_username"];
        $_SESSION["userRole"] = $user["u_role"];
        return ["success" => true, "message" => "Anmeldung erfolgreich!"];
    } else {
        return ["success" => false, "message" => "Falsches Passwort."];
    }
}
?>