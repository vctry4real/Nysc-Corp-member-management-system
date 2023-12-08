<?php 
require_once "../connection.php";

$statecode = $_GET["statecode"];
$escapedStatecode = mysqli_real_escape_string($conn, $statecode); // Escape the value to prevent SQL injection

$sql = "DELETE FROM corper WHERE statecode = '$escapedStatecode'"; // Enclose statecode in single quotes

if (mysqli_query($conn, $sql)) {
    echo "<script>
            alert('Corp Member Deleted Successfully');
            window.history.go(-1); // Go back to the previous page
          </script>";
} else {
    echo "Error deleting record: " . mysqli_error($conn);
}
?>
