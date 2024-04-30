<?php
include('db_connection.php');

// Check if venue id is set
if(isset($_REQUEST['venue_id'])) {
    $venueid = $_REQUEST['venue_id'];
   
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM venue WHERE venue_id=?");
    $stmt->bind_param("i", $venueid);
     ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Delete Record</title>
        <script>
            function confirmDelete() {
                return confirm("Are you sure you want to delete this record?");
            }
        </script>
    </head>
    <body>
        <form method="post" onsubmit="return confirmDelete();">
            <input type="hidden" name="venueid" value="<?php echo $venueid; ?>">
            <input type="submit" value="Delete">
        </form>

        <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($stmt->execute()) {
        echo "Record deleted successfully.<br><br>
             <a href='venue.php'>OK</a>";
    } else {
        echo "Error deleting data: " . $stmt->error;
    }
}
?>
</body>
</html>
<?php

    $stmt->close();
} else {
    echo "venue id is not set.";
}

$connection->close();
?>
