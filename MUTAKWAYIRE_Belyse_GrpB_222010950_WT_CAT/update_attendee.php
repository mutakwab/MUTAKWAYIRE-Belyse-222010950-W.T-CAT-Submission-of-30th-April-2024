<?php
include('db_connection.php');

// Check if attendee_id is set
if(isset($_REQUEST['attendee_id'])) {
    $attendid = $_REQUEST['attendee_id'];
    //attendee(attendee_id, organizer_id,  name,  email, registration_status
    $stmt = $connection->prepare("SELECT * FROM attendee WHERE attendee_id=?");
    $stmt->bind_param("i", $attendid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['attendee_id'];
        $y = $row['organizer_id'];
        $z = $row['name'];
        $w = $row['email'];
        $v = $row['registration_status'];
    } else {
        echo "attendee not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update attendee</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update attendee form -->
    <h2><u>Update Form of attendee</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <label for="orgid">organizer id:</label>
        <input type="number" name="orgid" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="attname">name:</label>
        <input type="text" name="attname" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>

        <label for="atteml">email:</label>
        <input type="email" name="atteml" value="<?php echo isset($w) ? $w : ''; ?>">
        <br><br>

        <label for="regstatus">registration status:</label>
        <input type="text" name="regstatus" value="<?php echo isset($v) ? $v : ''; ?>">
        <br><br>
        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $organid = $_POST['orgid'];
    $attendname = $_POST['attname'];
    $attendemail = $_POST['atteml'];
    $registstatus = $_POST['regstatus'];
    
    // Update the attendee in the database
    $stmt = $connection->prepare("UPDATE attendee SET organizer_id=?, name=?, email=?, registration_status=? WHERE attendee_id=?");
    $stmt->bind_param("isssi", $organid, $attendname, $attendemail,$registstatus, $attendid);
    $stmt->execute();
    
    // Redirect to attendee.php
    header('Location: attendee.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
