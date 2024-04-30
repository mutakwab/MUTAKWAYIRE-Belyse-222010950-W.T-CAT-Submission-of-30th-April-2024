<?php
include('db_connection.php');

// Check if event_id is set
if(isset($_REQUEST['event_id'])) {
    $eventid = $_REQUEST['event_id'];
    // event(event_id, title, description, date, location
    $stmt = $connection->prepare("SELECT * FROM event WHERE event_id=?");
    $stmt->bind_param("i", $eventid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['event_id'];
        $y = $row['title'];
        $z = $row['description'];
        $w = $row['date'];
        $v = $row['location'];
    } else {
        echo "event not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update event</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update event form -->
    <h2><u>Update Form of event</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <label for="title">event title:</label>
        <input type="text" name="title" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="dscrptn">description:</label>
        <input type="text" name="dscrptn" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>

        <label for="date">event date:</label>
        <input type="date" name="date" value="<?php echo isset($w) ? $w : ''; ?>">
        <br><br>

        <label for="lctn">location:</label>
        <input type="text" name="lctn" value="<?php echo isset($v) ? $v : ''; ?>">
        <br><br>
        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $evtitle = $_POST['title'];
    $evdescription = $_POST['dscrptn'];
    $evdate = $_POST['date'];
    $evlocation = $_POST['lctn'];
    
    // Update the event in the database
    $stmt = $connection->prepare("UPDATE event SET title=?, description=?, date=?, location=? WHERE event_id=?");
    $stmt->bind_param("ssssi", $evtitle, $evdescription, $evdate,$evlocation, $eventid);
    $stmt->execute();
    
    // Redirect to event.php
    header('Location: event.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
