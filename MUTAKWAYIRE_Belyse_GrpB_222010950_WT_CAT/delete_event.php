<?php
include('db_connection.php');

// Check if event id is set
if(isset($_REQUEST['event_id'])) {
    $eventid = $_REQUEST['event_id'];
   
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM event WHERE event_id=?");
    $stmt->bind_param("i", $eventid);
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
            <input type="hidden" name="eventid" value="<?php echo $eventid; ?>">
            <input type="submit" value="Delete">
        </form>

        <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($stmt->execute()) {
        echo "Record deleted successfully.<br><br>
             <a href='event.php'>OK</a>";
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
    echo "event id is not set.";
}

$connection->close();
?>
