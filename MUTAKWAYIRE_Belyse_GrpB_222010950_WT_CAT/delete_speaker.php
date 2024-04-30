<?php
include('db_connection.php');

// Check if speaker id is set
if(isset($_REQUEST['speaker_id'])) {
    $speakerid = $_REQUEST['speaker_id'];
   
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM speaker WHERE speaker_id=?");
    $stmt->bind_param("i", $speakerid);
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
            <input type="hidden" name="speakerid" value="<?php echo $speakerid; ?>">
            <input type="submit" value="Delete">
        </form>

        <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($stmt->execute()) {
        echo "Record deleted successfully.<br><br>
             <a href='speaker.php'>OK</a>";
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
    echo "speaker id is not set.";
}

$connection->close();
?>
