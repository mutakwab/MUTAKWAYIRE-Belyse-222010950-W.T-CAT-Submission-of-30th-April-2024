<?php
include('db_connection.php');

// Check if attendee id is set
if(isset($_REQUEST['attendee_id'])) {
    $attid = $_REQUEST['attendee_id'];
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM attendee WHERE attendee_id=?");
    $stmt->bind_param("i", $attid);
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
            <input type="hidden" name="attid" value="<?php echo $attid; ?>">
            <input type="submit" value="Delete">
        </form>

        <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if ($stmt->execute()) {
        echo "Record deleted successfully.<br><br>
             <a href='attendee.php'>OK</a>";
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
    echo "attendee id is not set.";
}

$connection->close();
?>
