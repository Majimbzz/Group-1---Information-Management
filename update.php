<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Registration Details</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background: linear-gradient(120deg, #ffedbc 0%, #fff6e4 100%);
            margin: 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
        }
        .edit-card {
            background: rgba(255,255,240,0.98);
            border-radius: 26px;
            box-shadow: 0 14px 38px rgba(241,196,15,0.11);
            padding: 38px 38px 28px 38px;
            max-width: 540px;
            width: 97%;
            margin-top: 42px;
        }
        .edit-title {
            display: flex;
            align-items: center;
            font-size: 1.7em;
            color: #a57f22;
            font-weight: 700;
            gap: 12px;
            letter-spacing: 2px;
            margin-bottom: 20px;
            justify-content: center;
        }
        .edit-title i { animation: bounceEdit 1.4s infinite alternate; }
        @keyframes bounceEdit {
            0% { transform: translateY(0);}
            100% { transform: translateY(-7px);}
        }
        form {
            display: flex;
            flex-direction: column;
            gap: 10px;
            align-items: stretch;
        }
        label {
            color: #7f6632;
            font-size: 1.08em;
            font-weight: 600;
            margin-top: 8px;
        }
        input[type="text"] {
            border-radius: 8px;
            border: 1px solid #fae6b1;
            padding: 8px;
            font-size: 1em;
            background: #fffdfa;
        }
        input[type="submit"] {
            margin-top: 20px;
            background: linear-gradient(90deg,#ffc371,#ff5f6d 80%);
            color: white;
            font-weight: bold;
            border: none;
            border-radius: 12px;
            padding: 12px 0;
            box-shadow: 0 4px 18px rgba(240, 160, 70, 0.15);
            font-size: 1.08em;
            letter-spacing: 1px;
            cursor: pointer;
            transition: background 0.19s, box-shadow 0.17s;
        }
        input[type="submit"]:hover {
            background: linear-gradient(90deg,#ff5f6d, #ffc371 100%);
            box-shadow: 0 8px 27px rgba(235,180,40,0.12);
        }
        .no-record {
            font-size: 1.1em;
            color: #d78c44;
            text-align: center;
        }
        @media (max-width:600px) {
            .edit-card {
                padding: 16px 6px 11px 6px;
            }
            .edit-title {
                font-size: 1.08em;
            }
        }
    </style>
</head>
<body>
    <div class="edit-card">
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "sampledb2";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("<div style='color:red;'>Connection failed: " . $conn->connect_error . "</div>");
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $search_name = $conn->real_escape_string($_POST['search_name']);

            $sql = "SELECT * FROM registration WHERE fname LIKE '%$search_name%' OR lname LIKE '%$search_name%'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                echo "<div class='edit-title'><i class='fas fa-edit'></i>Edit Details for " . htmlspecialchars($row['fname']) . " " . htmlspecialchars($row['lname']) . "</div>";
                echo "<form action='update_action.php' method='POST'>
                        <input type='hidden' name='id' value='" . $row['id'] . "'>
                        <label><i class='fas fa-user'></i> First Name:</label><input type='text' name='fname' value='" . htmlspecialchars($row['fname']) . "' required>
                        <label><i class='fas fa-user'></i> Middle Name:</label><input type='text' name='mname' value='" . htmlspecialchars($row['mname']) . "'>
                        <label><i class='fas fa-user'></i> Last Name:</label><input type='text' name='lname' value='" . htmlspecialchars($row['lname']) . "' required>
                        <label><i class='fas fa-graduation-cap'></i> Course:</label><input type='text' name='course' value='" . htmlspecialchars($row['course']) . "'>
                        <label><i class='fas fa-layer-group'></i> Level:</label><input type='text' name='level' value='" . htmlspecialchars($row['level']) . "'>
                        <label><i class='fas fa-venus-mars'></i> Sex:</label><input type='text' name='sex' value='" . htmlspecialchars($row['sex']) . "'>
                        <input type='submit' value='Update'>
                    </form>";
            } else {
                echo "<div class='no-record'><i class='fas fa-exclamation-triangle'></i> No record found.</div>";
            }
        }
        $conn->close();
        ?>
    </div>
</body>
</html>
