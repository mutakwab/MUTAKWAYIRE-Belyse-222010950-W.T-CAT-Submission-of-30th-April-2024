<?php
include('db_connection.php');

// Check if speaker_id is set
if(isset($_REQUEST['speaker_id'])) {
    $speakrid = $_REQUEST['speaker_id'];
    //speaker(speaker_id, attendee_id, name, bio, contact_email
    $stmt = $connection->prepare("SELECT * FROM speaker WHERE speaker_id=?");
    $stmt->bind_param("i", $speakrid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['speaker_id'];
        $y = $row['attendee_id'];
        $z = $row['name'];
        $w = $row['bio'];
        $v = $row['contact_email'];
    } else {
        echo "speaker not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update speaker</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update speaker form -->
    <h2><u>Update Form of speaker</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <label for="attid">attendee id:</label>
        <input type="number" name="attid" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="spkname">name:</label>
        <input type="text" name="spkname" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>

        <label for="spkbio">bio:</label>
        <input type="text" name="spkbio" value="<?php echo isset($w) ? $w : ''; ?>">
        <br><br>

        <label for="spkeml">email:</label>
        <input type="email" name="spkeml" value="<?php echo isset($v) ? $v : ''; ?>">
        <br><br>
        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $attendeeid = $_POST['attid'];
    $speakrname = $_POST['spkname'];
    $speakrbio = $_POST['spkbio'];
    $speakremail = $_POST['spkeml'];
    
    // Update the speaker in the database
    $stmt = $connection->prepare("UPDATE speaker SET attendee_id=?, name=?, bio=?, contact_email=? WHERE speaker_id=?");
    $stmt->bind_param("isssi", $attendeeid, $speakrname, $speakrbio,$speakremail, $speakrid);
    $stmt->execute();
    
    // Redirect to speaker.php
    header('Location: speaker.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
