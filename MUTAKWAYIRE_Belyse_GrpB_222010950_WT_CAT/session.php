<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Linking to external stylesheet -->
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <!-- Defining character encoding -->
  <meta charset="utf-8">
  <!-- Setting viewport for responsive design -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Session entity Page</title>
  <style>
    /* Normal link */
    a {
      padding: 10px;
      color: yellow;
      background-color: green;
      text-decoration: none;
      margin-right: 15px;
    }

    /* Visited link */
    a:visited {
      color: orange;
    }
    /* Unvisited link */
    a:link {
      color: brown; /* Changed to lowercase */
    }
    /* Hover effect */
    a:hover {
      background-color: dimgray;
    }

    /* Active link */
    a:active {
      background-color: yellow;
    }

    /* Extend margin left for search button */
    button.btn {
      margin-left: 15px; /* Adjust this value as needed */
      margin-top: 4px;
      background-color: yellow;
    }
    /* Extend margin left for search button */
    input.form-control {
      margin-left: 1250px; /* Adjust this value as needed */

      padding: 8px;
     
    }
    header{
    background-color:pink;
    padding: 20px;
}

section{
    padding:28px;
    border-bottom: 1px solid #ddd;
}
footer{
    text-align: center;
    padding: 15px;
    background-color:pink;
}
  </style>
   <!-- JavaScript validation and content load for insert data-->
        <script>
            function confirmInsert() {
                return confirm('Are you sure you want to insert this record?');
            }
        </script>
  </head>

  <header>

<body bgcolor="lightblue">
  <form method="GET" class="d-flex" role="search" action="search.php">
      <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="query">
      <button class="btn btn-outline-success" type="submit">Search</button>
    </form>
  <ul style="list-style-type: none; padding: 0;">
    <li style="display: inline; margin-right: 10px;">
    <img src="./image/logevent.png" width="90" height="70" alt="Logo">
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./home.html">HOME</a></li>

    <li style="display: inline; margin-right: 10px;"><a href="./about.html">ABOUT</a></li>

    <li style="display: inline; margin-right: 10px;"><a href="./contact.html">CONTACT</a></li>

    <li style="display: inline; margin-right: 10px;"><a href="./event.php">EVENT</a></li>

    <li style="display: inline; margin-right: 10px;"><a href="./attendee.php">ATTENDEE</a></li>

    <li style="display: inline; margin-right: 10px;"><a href="./session.php">SESSION</a></li>

    <li style="display: inline; margin-right: 10px;"><a href="./organizer.php">ORGANIZER</a></li>

    <li style="display: inline; margin-right: 10px;"><a href="./venue.php">VENUE</a></li>

    <li style="display: inline; margin-right: 10px;"><a href="./speaker.php">SPEAKER</a></li>
    
  
    <li class="dropdown" style="display: inline; margin-right: 10px;">
      <a href="#" style="padding: 10px; color: white; background-color: skyblue; text-decoration: none; margin-right: 15px;">Settings</a>
      <div class="dropdown-contents">
        <!-- Links inside the dropdown menu -->
        <a href="login.html">Login</a>
        <a href="register.html">Register</a>
        <a href="logout.php">Logout</a>
      </div>
    </li><br><br>
    
    
    
  </ul>

</header>
<section>
  <center>
 
        <h1><u>Session Form</u></h1>
    <form method="post" onsubmit="return confirmInsert();">
        <label for="sessid">Session ID:</label>
        <input type="number" id="sessid" name="sessid"><br><br>

        <label for="stitle">Title:</label>
        <input type="text" id="stitle" name="stitle" required><br><br>

        <label for="startT">Start Time:</label>
        <input type="datetime-local" id="startT" name="startT" required><br><br>

        <label for="endT">End Time:</label>
        <input type="datetime-local" id="endT" name="endT" required><br><br>

        <label for="evid">Event ID:</label>
        <input type="number" id="evid" name="evid" required><br><br>

        <input type="submit" name="add" value="Insert">
    </form>

    <?php
    // Include database connection
    include('db_connection.php');

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Prepare and bind the parameters
        $stmt = $connection->prepare("INSERT INTO Session (session_id, title, start_time, end_time, event_id) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("isssi", $sessionid, $title, $startTime, $endTime, $eventId);
        
        // Set parameters and execute
        $sessionid = $_POST['sessid'];
        $title = $_POST['stitle'];
        $startTime = date('Y-m-d H:i:s', strtotime($_POST['startT'])); // Format start time
        $endTime = date('Y-m-d H:i:s', strtotime($_POST['endT'])); // Format end time
        $eventId = $_POST['evid'];

        if ($stmt->execute() === TRUE) {
            echo "New record has been added successfully";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    }

    // Close database connection
    $connection->close();
    ?>


<?php
include('db_connection.php');

// SQL query to fetch data from the session table
$sql = "SELECT * FROM organizer";
$result = $connection->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail information Of session</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <center><h2>Table of session</h2></center>
    <table border="5">
        <tr>
            <th>session id</th>
            <th>title</th>
            <th>start time</th>
            <th>end time</th>
            <th>event id</th>
            <th>Delete</th>
            <th>Update</th>
        </tr>
      <?php
      include('db_connection.php');

        // Prepare SQL query to retrieve all session
        $sql = "SELECT * FROM session";
        $result = $connection->query($sql);

        // Check if there are any session
        if ($result->num_rows > 0) {
            // Output data for each row
            while ($row = $result->fetch_assoc()) {
                $orgid = $row['session_id']; // Fetch the session_Id
                echo "<tr>
                    <td>" . $row['session_id'] . "</td>
                    <td>" . $row['title'] . "</td>
                    <td>" . $row['start_time'] . "</td>
                    <td>" . $row['end_time'] . "</td>
                    <td>" . $row['event_id'] . "</td>
                    <td><a style='padding:4px' href='delete_session.php?session_id=$orgid'>Delete</a></td> 
                    <td><a style='padding:4px' href='update_session.php?session_id=$orgid'>Update</a></td> 
                </tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No data found</td></tr>";
        }
        // Close the database connection
        $connection->close();
        ?>
    </table>
  </body>
</section>


  
<footer>
  <center> 
    <b><h2>UR CBE BIT &copy for 2024, Designer by: MUTAKWAYIRE Belyse</h2></b>
  </center>
</footer>
  
</body>
</html>
