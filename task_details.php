<?php
include "task_session.php";


echo "<h2>Task Details</h2>";

if (isset($_SESSION["task_id"])) {

    echo "Currently active Task ID: " . $_SESSION["task_id"];

} else {

    echo "No active task found.";

}

?>