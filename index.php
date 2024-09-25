<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Book</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Attendance Book</h1>
        
        <!-- Attendance Form -->
        <form action="mark-attendance.php" method="post">
            <label for="student">Select Student:</label>
            <select id="student" name="student">
                <?php 
                    // Connect to database
                    $conn = mysqli_connect("localhost", "root", "", "attendance_db");
                    
                    // Check connection
                    if (!$conn) {
                        die("Connection failed: " . mysqli_connect_error());
                    }
                    
                    // Fetch students
                    $sql = "SELECT * FROM students";
                    $result = mysqli_query($conn, $sql);
                    
                    // Display students in dropdown
                    while($row = mysqli_fetch_assoc($result)) {
                        echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
                    }
                    
                    // Close connection
                    mysqli_close($conn);
                ?>
            </select>
            <br><br>
            <label for="status">Status:</label>
            <select id="status" name="status">
                <option value="present">Present</option>
                <option value="absent">Absent</option>
            </select>
            <br><br>
            <input type="submit" value="Mark Attendance">
        </form>

        <br>
        <h2>Attendance Record</h2>
        
        <!-- Attendance Table -->
        <table border="1">
            <tr>
                <th>Student Name</th>
                <th>Date</th>
                <th>Status</th>
            </tr>
            <?php
                // Connect to database
                $conn = mysqli_connect("localhost", "root", "", "attendance_db");
                
                // Check connection
                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }
                
                // Fetch attendance record
                $sql = "SELECT s.name, a.date, a.status FROM attendance a 
                        JOIN students s ON a.student_id = s.id 
                        ORDER BY a.date DESC";
                $result = mysqli_query($conn, $sql);
                
                // Display attendance record
                while($row = mysqli_fetch_assoc($result)) {
                    echo "<tr><td>" . $row['name'] . "</td><td>" . $row['date'] . "</td><td>" . ucfirst($row['status']) . "</td></tr>";
                }
                
                // Close connection
                mysqli_close($conn);
            ?>
        </table>
    </div>
</body>
</html>
