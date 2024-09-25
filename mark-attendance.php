<?php 
    // Connect to database
    $conn = mysqli_connect("localhost", "root", "", "attendance_db");
    
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    
    // Check if form data has been submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get student ID and status
        $student_id = mysqli_real_escape_string($conn, $_POST['student']);
        $status = mysqli_real_escape_string($conn, $_POST['status']);
        
        // Get current date
        $date = date('Y-m-d');
        
        // Insert attendance record
        $sql = "INSERT INTO attendance (student_id, date, status) VALUES ('$student_id', '$date', '$status')";
        
        // Execute query
        if (mysqli_query($conn, $sql)) {
            echo "Attendance marked successfully!";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }

    // Close connection
    mysqli_close($conn);
?>
