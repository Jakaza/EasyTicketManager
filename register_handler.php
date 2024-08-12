<?php
include('dbcon.php'); // Include the PDO database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize form data
    $fname = htmlspecialchars($_POST['fname']);
    $lname = htmlspecialchars($_POST['lname']);
    $username = htmlspecialchars($_POST['registerUsername']);
    $email = htmlspecialchars($_POST['registerEmail']);
    $password = htmlspecialchars($_POST['registerPassword']);
    $agree = isset($_POST['registerAgree']) ? 1 : 0;

    // Validate required fields
    if (empty($fname) || empty($lname) || empty($username) || empty($email) || empty($password) || !$agree) {
        echo "<script>
            window.alert('All fields are required, and you must agree to the terms.');
            window.location = 'register.php';
        </script>";
        exit();
    } else {
        // Hash the password using MD5 with the same salt
        $safe_pass = md5($password);
        $salt = "a1Bz20ydqelm8m1wql";
        $final_pass = $salt . $safe_pass;

        // Check if the username already exists
        $query = $conn->prepare("SELECT * FROM useraccounts WHERE username = :username");
        $query->execute([':username' => $username]);
        $num_row = $query->rowCount();

        if ($num_row > 0) {
            echo "<script>
                window.alert('Username already exists. Please choose a different username.');
                window.location = 'register.php';
            </script>";
            exit();
        } else {
            // Insert the new user into the database
            $sql = "INSERT INTO useraccounts (reg_id, lname, fname, username, password, access, status)
                    VALUES (:reg_id, :lname, :fname, :username, :password, 'user', 'active')";
            $stmt = $conn->prepare($sql);

            if ($stmt->execute([
                ':reg_id' => 1,
                ':lname' => $lname,
                ':fname' => $fname,
                ':username' => $username,
                ':password' => $final_pass
            ])) {
                echo "<script>
                    window.alert('Registration successful! You can now log in.');
                    window.location = 'index.php';
                </script>";
            } else {
                echo "<script>
                    window.alert('Could not execute the query. Please try again.');
                    window.location = 'register.php';
                </script>";
            }
        }
    }
}
?>
