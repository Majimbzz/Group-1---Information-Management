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
    $delete_name = $conn->real_escape_string($_POST['delete_name']);

    $sql = "DELETE FROM registration WHERE fname LIKE '%$delete_name%' OR lname LIKE '%$delete_name%'";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
                alert('Record deleted successfully');
                window.location.href = 'delete.html'; // Redirect back to the delete form page or another page
              </script>";
    } else {
        echo "<script>
                alert('Error deleting record: " . $conn->error . "');
                window.location.href = 'delete.html'; // Redirect back to the delete form page or another page
              </script>";
    }
}

$conn->close();
?>
