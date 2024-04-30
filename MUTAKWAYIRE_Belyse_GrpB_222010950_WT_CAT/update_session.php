<?php
include('db_connection.php');

// Check if session_id is set
if(isset($_REQUEST['session_id'])) {
    $sessionid = $_REQUEST['session_id'];
    // Session (session_id, title, start_time, end_time, event_id
    $stmt = $connection->prepare("SELECT * FROM Session WHERE session_id=?");
    $stmt->bind_param("i", $sessionid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['session_id'];
        $y = $row['title'];
        $z = $row['start_time'];
        $w = $row['end_time'];
        $v = $row['end_time'];

    } else {
        echo "session not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update session</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update session form -->
    <h2><u>Update Form of session</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <label for="stitle">tittle:</label>
        <input type="text" name="stitle" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="startT">start time:</label>
        <input type="datetime-local" name="startT" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>

        <label for="endT">end time:</label>
        <input type="datetime-local" name="endT" value="<?php echo isset($w) ? $w : ''; ?>">
        <br><br>

        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $sesstitle = $_POST['stitle'];
    $startTime = $_POST['startT'];
    $endTime = $_POST['endT'];
    
    // Update the session in the database
    $stmt = $connection->prepare("UPDATE Session SET session_id=?, title=?, start_time=?, end_time=? WHERE session_id=?");
    $stmt->bind_param("sbbi", $sesstitle, $startTime, $endTime, $sessionid);
    $stmt->execute();
    
    // Redirect to session.php
    header('Location: session.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
