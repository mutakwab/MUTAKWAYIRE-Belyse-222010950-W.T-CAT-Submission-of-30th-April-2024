<?php
include('db_connection.php');

// Check if venue_id is set
if(isset($_REQUEST['venue_id'])) {
    $venueid = $_REQUEST['venue_id'];
   //venue(venue_id, name, address, capacity
    $stmt = $connection->prepare("SELECT * FROM venue WHERE venue_id=?");
    $stmt->bind_param("i", $venueid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['venue_id'];
        $y = $row['name'];
        $z = $row['address'];
        $w = $row['capacity'];

    } else {
        echo "venue not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update venue</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update venue form -->
    <h2><u>Update Form of venue</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <label for="vename">name:</label>
        <input type="text" name="vename" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="address">venue address:</label>
        <input type="text" name="address" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>

        <label for="cpcty">capacity:</label>
        <input type="number" name="cpcty" value="<?php echo isset($w) ? $w : ''; ?>">
        <br><br>

        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $VenName = $_POST['vename'];
    $VenAdrs = $_POST['address'];
    $VenCapacity = $_POST['cpcty'];
    
    // Update the venue in the database
    $stmt = $connection->prepare("UPDATE venue SET name=?, address=?, capacity=? WHERE venue_id=?");
    $stmt->bind_param("sssi", $VenName, $VenAdrs, $VenCapacity, $venueid);
    $stmt->execute();
    
    // Redirect to venue.php
    header('Location: venue.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
