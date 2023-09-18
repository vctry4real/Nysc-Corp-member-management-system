<?php 
require_once "../connection.php";

$statecode = $_GET["statecode"];

$sql = "DELETE FROM corper WHERE statecode = $statecode ";

if (mysqli_query($conn, $sql)) {
    echo "<script>
            alert('Corp Member Deleted Successfully');
            window.history.go(-1); // Go back to the previous page
          </script>";
} else {
    echo "Error deleting record: " . mysqli_error($conn);
}
?>
