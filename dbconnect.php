<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sampledb2"; // updated database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fname = $conn->real_escape_string($_POST['fname']);
    $mname = $conn->real_escape_string($_POST['mname']);
    $lname = $conn->real_escape_string($_POST['lname']);
    $course = $conn->real_escape_string($_POST['course']);
    $level = $conn->real_escape_string($_POST['level']);
    $sex = $conn->real_escape_string($_POST['sex']);

    $sql = "INSERT INTO registration (fname, mname, lname, course, level, sex) VALUES ('$fname', '$mname', '$lname', '$course', '$level', '$sex')";
    
    if ($conn->query($sql) === TRUE) {
        echo "<script>
                alert('New record inserted successfully');
                // window.location.href = 'registration.html'; // Uncomment to redirect after insert
              </script>";
    } else {
        echo "<script>
                alert('Error inserting record: " . $conn->error . "');
                // window.location.href = 'registration.html'; // Uncomment to redirect after error
              </script>";
    }
}

$conn->close();
?>
