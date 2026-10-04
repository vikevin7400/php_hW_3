<?php

session_start();

$_SESSION["task_id"] = 102;

echo "<h2>Task Session</h2>";
echo "Currently working on Task ID: " . $_SESSION["task_id"];

echo "<br><br>";
echo "<a href='task_details.php'>Go to Task Details</a>";

?>