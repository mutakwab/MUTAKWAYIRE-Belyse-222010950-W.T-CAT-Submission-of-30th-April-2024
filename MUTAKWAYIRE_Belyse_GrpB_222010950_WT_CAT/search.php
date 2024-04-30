<?php
include('db_connection.php');

// Check if a search term was provided
if (isset($_GET['query']) && !empty($_GET['query'])) {
    $searchTerm = $connection->real_escape_string($_GET['query']);

    // Define the SQL queries to search across multiple tables
    $queries = [
        "attendee" => "SELECT attendee_id FROM attendee WHERE attendee_id LIKE '%$searchTerm%'",
        "event" => "SELECT title FROM event WHERE title LIKE '%$searchTerm%'",
        "organizer" => "SELECT name FROM organizer WHERE name LIKE '%$searchTerm%'",
        "session" => "SELECT session_id FROM session WHERE session_id LIKE '%$searchTerm%'",
        "speaker" => "SELECT name FROM speaker WHERE name LIKE '%$searchTerm%'"
    ];

    // Output search results
    echo "<h2><u>Search Results:</u></h2>";

    foreach ($queries as $table => $sql) {
        $result = $connection->query($sql);
        echo "<h3>Table of $table:</h3>";
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<p>" . $row[array_keys($row)[0]] . "</p>";
            }
        } else {
            echo "<p>No results found in $table matching the search term: '$searchTerm'</p>";
        }
    }

    // Close the connection
    $connection->close();
} else {
    echo "<p>No search term was provided.</p>";
}
?>
