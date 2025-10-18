<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sampledb2";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $conn->real_escape_string($_POST['id']);
    $fname = $conn->real_escape_string($_POST['fname']);
    $mname = $conn->real_escape_string($_POST['mname']);
    $lname = $conn->real_escape_string($_POST['lname']);
    $course = $conn->real_escape_string($_POST['course']);
    $level = $conn->real_escape_string($_POST['level']);
    $sex = $conn->real_escape_string($_POST['sex']);

    $sql = "UPDATE registration SET fname='$fname', mname='$mname', lname='$lname', course='$course', level='$level', sex='$sex' WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
                alert('Record updated successfully');
                window.location.href = 'home.html'; // Redirect to home after update
              </script>";
    } else {
        echo "<script>
                alert('Error updating record: " . $conn->error . "');
                window.location.href = 'home.html'; // Redirect to home even on error
              </script>";
    }
}

$conn->close();
?>
