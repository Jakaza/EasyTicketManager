<?php
include('dbcon.php');
session_start();

if (isset($_POST['update_password'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $user_id = trim($_POST['user_id']);

    // Check if the username or password is empty or only whitespace
    if (empty($username) || empty($password)) {
        echo "<script>
            alert('Username and Password are required.');
            window.location = '/qrcode/home.php';
        </script>";
        exit();
    }

    // Encrypt the password
    $safe_pass = md5($password);
    $salt = "a1Bz20ydqelm8m1wql";
    $final_pass = $salt . $safe_pass;

    // Check if the user exists
    $query = $conn->prepare("SELECT * FROM useraccounts WHERE user_id = :user_id");
    $query->bindParam(':user_id', $user_id, PDO::PARAM_STR);
    $query->execute();
    $row = $query->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        // Update the password
        $update_query = $conn->prepare("UPDATE useraccounts SET password = :password WHERE username = :username");
        $update_query->bindParam(':password', $final_pass, PDO::PARAM_STR);
        $update_query->bindParam(':username', $username, PDO::PARAM_STR);
        $update_query->execute();

        $_SESSION['useraccess'] = $row['access'];
        $_SESSION['id'] = $row['user_id'];

        if ($row['access'] === 'Administrator') {
            echo "<script>window.location = 'home.php';</script>";
        } else {
            echo "<script>window.location = 'home.php';</script>";
        }
    } else {
        echo "<script>
            alert('User not found.');
            window.location = 'index.php';
        </script>";
    }
}
?>
