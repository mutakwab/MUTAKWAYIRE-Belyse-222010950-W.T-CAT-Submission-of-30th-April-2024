<?php
include('db_connection.php');

// Check if organizer_id is set
if(isset($_REQUEST['organizer_id'])) {
    $organid = $_REQUEST['organizer_id'];
    //organizer(organizer_id, name, contact_email, billing_info
    $stmt = $connection->prepare("SELECT * FROM organizer WHERE organizer_id=?");
    $stmt->bind_param("i", $organid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['organizer_id'];
        $y = $row['name'];
        $z = $row['contact_email'];
        $w = $row['billing_info'];
    
    } else {
        echo "organizer not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update organizer</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update organizer form -->
    <h2><u>Update Form of organizer</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <label for="orgname">name:</label>
        <input type="text" name="orgname" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="orgeml">contact email:</label>
        <input type="email" name="orgeml" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>

        <label for="billinfo">billing info:</label>
        <input type="text" name="billinfo" value="<?php echo isset($w) ? $w : ''; ?>">
        <br><br>

        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $organame = $_POST['orgname'];
    $contEmail = $_POST['orgeml'];
    $billInfo = $_POST['billinfo'];
    
    // Update the organizer in the database
    $stmt = $connection->prepare("UPDATE organizer SET name=?, contact_email=?, billing_info=? WHERE organizer_id=?");
    $stmt->bind_param("sssi", $organame, $contEmail, $billInfo, $organid);
    $stmt->execute();
    
    // Redirect to organizer.php
    header('Location: organizer.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
