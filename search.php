<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Search Results</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background: linear-gradient(120deg,#e0c3fc 0%,#8ec5fc 100%);
            margin: 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
        }
        .results-card {
            background: rgba(255,255,255,0.97);
            border-radius: 24px;
            box-shadow: 0 14px 38px rgba(55,80,160,0.12);
            padding: 36px 38px 20px 38px;
            max-width: 650px;
            width: 96%;
            margin-top: 44px;
        }
        .results-title {
            display: flex;
            align-items: center;
            font-size: 2em;
            color: #7e57c2;
            justify-content: center;
            gap: 10px;
            font-weight: 700;
            margin-bottom: 28px;
            letter-spacing: 2px;
        }
        .results-title i { font-size: 1.2em; animation: bounceResults 1.2s infinite alternate; }
        @keyframes bounceResults {
            0% { transform: translateY(0); }
            100% { transform: translateY(-11px); }
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
            background: #faf8fc;
            box-shadow: 0 2px 9px rgba(55,80,160,0.07);
            border-radius: 14px;
            overflow: hidden;
        }
        th, td {
            padding: 13px 10px;
            text-align: center;
        }
        th {
            background-color: #8ec5fc;
            color: #50444a;
            font-size: 1.04em;
        }
        td {
            background: #fff;
            color: #3d246c;
        }
        tr:nth-child(even) td {
            background: #f6f0fa;
        }
        .results-footer {
            margin-top: 18px;
            text-align: center;
            font-size: 1.03em;
            color: #7e57c2;
        }
        @media (max-width:620px) {
            .results-card { padding: 10px 4px 8px 4px; }
            .results-title { font-size: 1em; }
            th, td { font-size: 0.95em; padding: 7px 2px; }
        }
    </style>
</head>
<body>
    <div class="results-card">
        <div class="results-title"><i class="fas fa-search"></i>Search Results</div>
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

            $sql = "SELECT * FROM registration WHERE fname LIKE '%$search_name%' OR mname LIKE '%$search_name%' OR lname LIKE '%$search_name%'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo "<script>alert('Record(s) found: " . $result->num_rows . " record(s)');</script>";

                echo "<table>
                        <tr>
                            <th><i class='fas fa-user'></i> First Name</th>
                            <th><i class='fas fa-user'></i> Middle Name</th>
                            <th><i class='fas fa-user'></i> Last Name</th>
                            <th><i class='fas fa-graduation-cap'></i> Course</th>
                            <th><i class='fas fa-layer-group'></i> Level</th>
                            <th><i class='fas fa-venus-mars'></i> Sex</th>
                        </tr>";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . htmlspecialchars($row['fname']) . "</td>
                            <td>" . htmlspecialchars($row['mname']) . "</td>
                            <td>" . htmlspecialchars($row['lname']) . "</td>
                            <td>" . htmlspecialchars($row['course']) . "</td>
                            <td>" . htmlspecialchars($row['level']) . "</td>
                            <td>" . htmlspecialchars($row['sex']) . "</td>
                          </tr>";
                }
                echo "</table>";
                echo "<div class='results-footer'>
                        <i class='fas fa-info-circle'></i> End of search results
                      </div>";
            } else {
                echo "<script>
                        alert('No records found for \"$search_name\"');
                        window.location.href = 'search.html';
                      </script>";
            }
        }

        $conn->close();
        ?>
    </div>
</body>
</html>
