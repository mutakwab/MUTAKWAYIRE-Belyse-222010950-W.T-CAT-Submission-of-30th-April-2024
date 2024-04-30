<?php
include('db_connection.php');

// Check if organizer id is set
if(isset($_REQUEST['organizer_id'])) {
    $organid = $_REQUEST['organizer_id'];
   
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM organizer WHERE organizer_id=?");
    $stmt->bind_param("i", $organid);
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
            <input type="hidden" name="orgid" value="<?php echo $orgid; ?>">
            <input type="submit" value="Delete">
        </form>

        <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($stmt->execute()) {
        echo "Record deleted successfully.<br><br>
             <a href='organizer.php'>OK</a>";
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
    echo "organizer id is not set.";
}

$connection->close();
?>
