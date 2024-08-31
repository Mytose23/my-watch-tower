<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $purok = $_POST['purok'];
    $barangay = $_POST['barangay'];
    $city = $_POST['city'];
    $province = $_POST['province'];
    $voter_status = $_POST['voter_status'];
    $created_by = $_SESSION['user_id'];

    $sql = "INSERT INTO voters (purok, barangay, city, province, voter_status, created_by) 
            VALUES ('$purok', '$barangay', '$city', '$province', '$voter_status', '$created_by')";

    $conn->query($sql);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Welcome!</h2>
        <a href="logout.php" class="btn btn-danger">Logout</a>

        <h3 class="mt-4">Add Voter Data</h3>
        <form method="POST">
            <div class="form-group">
                <label for="purok">Purok:</label>
                <input type="text" class="form-control" id="purok" name="purok" required>
            </div>
            <div class="form-group">
                <label for="barangay">Barangay:</label>
                <input type="text" class="form-control" id="barangay" name="barangay" required>
            </div>
            <div class="form-group">
                <label for="city">City:</label>
                <input type="text" class="form-control" id="city" name="city" required>
            </div>
            <div class="form-group">
                <label for="province">Province:</label>
                <input type="text" class="form-control" id="province" name="province" required>
            </div>
            <div class="form-group">
                <label for="voter_status">Voter Status:</label>
                <select class="form-control" id="voter_status" name="voter_status" required>
                    <option value="Botante">Botante</option>
                    <option value="Hindi Botante">Hindi Botante</option>
                    <option value="Undecided">Undecided</option>
                    <option value="Swinger">Swinger</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Add Voter Data</button>
        </form>

        <h3 class="mt-4">Your Voter Data</h3>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Purok</th>
                    <th>Barangay</th>
                    <th>City</th>
                    <th>Province</th>
                    <th>Voter Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $user_id = $_SESSION['user_id'];
                $sql = "SELECT * FROM voters WHERE created_by='$user_id'";
                $result = $conn->query($sql);

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>{$row['purok']}</td>";
                    echo "<td>{$row['barangay']}</td>";
                    echo "<td>{$row['city']}</td>";
                    echo "<td>{$row['province']}</td>";
                    echo "<td>{$row['voter_status']}</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
