<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $room_number = $_POST['room_number'];
    $contact = $_POST['contact'];
    $course = $_POST['course'];
    $fees_paid = $_POST['fees_paid'];

    $stmt = $conn->prepare("INSERT INTO students (name, room_number, contact, course, fees_paid) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssd", $name, $room_number, $contact, $course, $fees_paid);
    $stmt->execute();
    $stmt->close();

    header("Location: students.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Register Student</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <h2>Add New Student</h2>
    <form method="POST" action="">
        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" required class="form-control" />
        </div>
        <div class="mb-3">
            <label>Room Number</label>
            <input type="text" name="room_number" required class="form-control" />
        </div>
        <div class="mb-3">
            <label>Contact</label>
            <input type="text" name="contact" required class="form-control" />
        </div>
        <div class="mb-3">
            <label>Course</label>
            <input type="text" name="course" required class="form-control" />
        </div>
        <div class="mb-3">
            <label>Fees Paid</label>
            <input type="number" step="0.01" name="fees_paid" required class="form-control" />
        </div>
        <button type="submit" class="btn btn-primary">Register Student</button>
        <a href="index.php" class="btn btn-secondary">Back</a>
    </form>
</body>
</html>
