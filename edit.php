<?php
include 'db.php';

if (!isset($_GET['id'])) {
    header("Location: students.php");
    exit;
}

$id = $_GET['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $room_number = $_POST['room_number'];
    $contact = $_POST['contact'];
    $course = $_POST['course'];
    $fees_paid = $_POST['fees_paid'];

    $stmt = $conn->prepare("UPDATE students SET name=?, room_number=?, contact=?, course=?, fees_paid=? WHERE id=?");
    $stmt->bind_param("ssssdi", $name, $room_number, $contact, $course, $fees_paid, $id);
    $stmt->execute();
    $stmt->close();

    header("Location: students.php");
    exit;
}

$stmt = $conn->prepare("SELECT * FROM students WHERE id=?");
$stmt->bind_param("i", $id);
stmt->execute();
$result = $stmt->get_result();
$student = $result->fetch_assoc();
$stmt->close();

if (!$student) {
    echo "Student not found.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Student</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <h2>Edit Student</h2>
    <form method="POST" action="">
        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" required class="form-control" value="<?= htmlspecialchars($student['name']); ?>" />
        </div>
        <div class="mb-3">
            <label>Room Number</label>
            <input type="text" name="room_number" required class="form-control" value="<?= htmlspecialchars($student['room_number']); ?>" />
        </div>
        <div class="mb-3">
            <label>Contact</label>
            <input type="text" name="contact" required class="form-control" value="<?= htmlspecialchars($student['contact']); ?>" />
        </div>
        <div class="mb-3">
            <label>Course</label>
            <input type="text" name="course" required class="form-control" value="<?= htmlspecialchars($student['course']); ?>" />
        </div>
        <div class="mb-3">
            <label>Fees Paid</label>
            <input type="number" step="0.01" name="fees_paid" required class="form-control" value="<?= $student['fees_paid']; ?>" />
        </div>
        <button type="submit" class="btn btn-primary">Update Student</button>
        <a href="students.php" class="btn btn-secondary">Back</a>
    </form>
</body>
</html>
