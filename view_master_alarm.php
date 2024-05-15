<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "external_alarm_master";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = '';

// Update record if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $port = $_POST['port'];
    $slogan = $_POST['slogan'];
    $severity = $_POST['severity'];
    $normallyopen = $_POST['normallyopen'];

    $sql = "UPDATE master_alarm SET slogan='$slogan', severity='$severity', normallyopen='$normallyopen' WHERE port='$port'";

    if ($conn->query($sql) === TRUE) {
        $message = "Record updated successfully";
    } else {
        $message = "Error updating record: " . $conn->error;
    }
}

// Fetch records from database
$sql = "SELECT * FROM master_alarm";
$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View and Edit Records</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        input[type="text"], input[type="number"] {
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 3px;
        }
        button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
        .edit-btn {
            background-color: #008CBA;
        }
        .edit-btn:hover {
            background-color: #007B9E;
        }
        .message {
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 3px;
            color: white;
        }
        .success {
            background-color: #4CAF50;
        }
        .error {
            background-color: #f44336;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Master Alarm List</h2>
        <table>
            <tr>
                <th>Port</th>
                <th>Slogan</th>
                <th>Severity</th>
                <th>Normally Open</th>
                <th>Action</th>
            </tr>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["port"] . "</td>";
                    echo "<td>" . $row["slogan"] . "</td>";
                    echo "<td>" . $row["severity"] . "</td>";
                    echo "<td>" . $row["normallyopen"] . "</td>";
                    echo '<td><button class="edit-btn" onclick="editRecord(\'' . $row["port"] . '\', \'' . $row["slogan"] . '\', \'' . $row["severity"] . '\', \'' . $row["normallyopen"] . '\')">Edit</button></td>';
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No records found</td></tr>";
            }
            ?>
        </table>

        <h2>Edit Record</h2>
        <?php if (!empty($message)) { ?>
            <div class="message <?php echo strpos($message, 'successfully') !== false ? 'success' : 'error'; ?>">
                <?php echo $message; ?>
            </div>
        <?php } ?>
        <form method="post" action="">
            <label for="port">Port:</label>
            <input type="text" id="port" name="port" readonly>
            <label for="slogan">Slogan:</label>
            <input type="text" id="slogan" name="slogan" required>
            <label for="severity">Severity:</label>
            <input type="text" id="severity" name="severity" required>
            <label for="normallyopen">Normally Open:</label>
            <input type="text" id="normallyopen" name="normallyopen" required>
            <button type="submit">Update</button>
        </form>
    </div>

    <script>
        function editRecord(port, slogan, severity, normallyopen) {
            document.getElementById('port').value = port;
            document.getElementById('slogan').value = slogan;
            document.getElementById('severity').value = severity;
            document.getElementById('normallyopen').value = normallyopen;
        }
    </script>
</body>
</html>