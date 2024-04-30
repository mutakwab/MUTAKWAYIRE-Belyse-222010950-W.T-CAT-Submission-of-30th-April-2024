<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Linking to external stylesheet -->
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <!-- Defining character encoding -->
  <meta charset="utf-8">
  <!-- Setting viewport for responsive design -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Event entity Page</title>
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
  <h1><u> Event Form </u></h1>
    <form method="post" onsubmit="return confirmInsert();">
       <!--event_id title   description date    location-->     
        <label for="evenid">event id:</label>
        <input type="number" id="evenid" name="evenid"><br><br>

        <label for="evtitle">title:</label>
        <input type="text" id="evtitle" name="evtitle" required><br><br>

        <label for="descrp">description:</label>
        <input type="text" id="descrp" name="descrp" required><br><br>

        <label for="date">EventDate:</label>
        <input type="date" id="date" name="date" required><br><br>

        <label for="lctn">location:</label>
        <input type="text" id="lctn" name="lctn" required><br><br>

        <input type="submit" name="add" value="Insert">
      

    </form>

<?php
include('db_connection.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepare and bind the parameters
    $stmt = $connection->prepare("INSERT INTO event(event_id, title, description, date, location) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $event_id, $title, $description, $date, $location);
    // Set parameters and execute
    $event_id = $_POST['evenid'];
    $title = $_POST['evtitle'];
    $description = $_POST['descrp'];
    $date = $_POST['date'];
    $location = $_POST['lctn'];
   
    if ($stmt->execute() == TRUE) {
        echo "New record has been added successfully";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}
$connection->close();
?>

<?php
include('db_connection.php');

// SQL query to fetch data from the event table
$sql = "SELECT * FROM event";
$result = $connection->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail information Of event</title>
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
    <center><h2>Table of event</h2></center>
    <table border="5">
        <tr>
            <th>event_id</th>
            <th>title</th>
            <th>description</th>
            <th>date</th>
            <th>location</th>
            <th>Delete</th>
            <th>Update</th>
        </tr>
      <?php
      include('db_connection.php');

        // Prepare SQL query to retrieve all events
        $sql = "SELECT * FROM event";
        $result = $connection->query($sql);

        // Check if there are any event
        if ($result->num_rows > 0) {
            // Output data for each row
            while ($row = $result->fetch_assoc()) {
                $evenid = $row['event_id']; // Fetch the event_Id
                echo "<tr>
                    <td>" . $row['event_id'] . "</td>
                    <td>" . $row['title'] . "</td>
                    <td>" . $row['description'] . "</td>
                    <td>" . $row['date'] . "</td>
                    <td>" . $row['location'] . "</td>
                    <td><a style='padding:4px' href='delete_event.php?event_id=$evenid'>Delete</a></td> 
                    <td><a style='padding:4px' href='update_event.php?event_id=$evenid'>Update</a></td> 
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
