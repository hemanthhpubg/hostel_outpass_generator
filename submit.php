<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "example";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['name']) && isset($_POST['pass'])) {
    $username = $_POST['name'];
    $password = $_POST['pass'];
    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);

    $sql = "SELECT * FROM student WHERE name='$username' AND pass='$password'";
    $result = mysqli_query($conn, $sql);

    if ($result === false) {
        die("Query failed: " . mysqli_error($conn));
    }

    if (mysqli_num_rows($result) == 1) {
        session_start();
        $_SESSION['username'] = $username;
        $reg = $username;
        header('Location: show.html');
    } else {
        echo "Invalid username or password.";
    }
    

    mysqli_free_result($result);
}

mysqli_close($conn);
?>
