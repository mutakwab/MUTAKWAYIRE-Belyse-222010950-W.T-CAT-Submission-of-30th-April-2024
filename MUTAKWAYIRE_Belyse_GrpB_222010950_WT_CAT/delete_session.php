<?php
include('db_connection.php');

// Check if session id is set
if(isset($_REQUEST['session_id'])) {
    $sessid = $_REQUEST['session_id'];
  
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM Session WHERE session_id=?");
    $stmt->bind_param("i", $sessid);
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
            <input type="hidden" name="sessid" value="<?php echo $sessid; ?>">
            <input type="submit" value="Delete">
        </form>

        <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($stmt->execute()) {
        echo "Record deleted successfully.<br><br>
             <a href='session.php'>OK</a>";
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
    echo "session id is not set.";
}

$connection->close();
?>
