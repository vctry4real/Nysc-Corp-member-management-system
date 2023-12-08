<?php 
require_once "include/header.php";
?>

<?php 
require_once "include/header.php";
?>

<?php 

    // THINGS TO NOTES 
    // 1 : When you select edit corp members, it should retain the corp membe password(uneditable), and the date of birth too


//  database connection
require_once "../connection.php";

// Function to calculate age
function calculateAge($dateOfBirth) {
    $today = new DateTime();
    $dob = new DateTime($dateOfBirth);
    $age = $today->diff($dob);
    return $age->y;
}

$sql = "SELECT * FROM corper";
$result = mysqli_query($conn , $sql);

$i = 1;
$you = "";


?>

<style>
table, th, td {
  border: 1px solid black;
  padding: 15px;
}
table {
  border-spacing: 10px;
}
</style>

<div class="container bg-white shadow">
    <div class="py-4 mt-5"> 
    <div class='text-center pb-2'><h4>Manage Corp Member</h4></div>
    <table style="width:100%" class="table-hover text-center ">
    <tr class="bg-dark">
        <th>S.No.</th>
        <th>State Code</th>
        <th>Name</th>
        <th>Email</th> 
        <th>Gender</th>
        <th>Date of Birth</th>
        <th>Age in Years</th>
        <th>PPA</th>
        <th>Action</th>
    </tr>
    <?php 
    
    if( mysqli_num_rows($result) > 0){
        while( $rows = mysqli_fetch_assoc($result) ){
            $statecode = $rows["statecode"];
            $name= $rows["name"];
            $email= $rows["email"];
            $gender = $rows["gender"];
            $dob = $rows["dob"];
            $ppa = $rows["ppa"];
            if($gender == "" ){
                $gender = "Not Defined";
            } 
            
            $age = ""; // Define $age here

            if($dob == "" ){
                $dob = "Not Defined";
                $age = "Not Defined";
            }else{
                $dob = date('Y-m-d', strtotime($dob)); // Change the date format here
                $age = calculateAge($dob); // Calculate age using the function
            }

            if($ppa== "" ){
                $ppa= "Not Defined";
            }   
            
            ?>
        <tr>
        <td><?php echo "{$i}."; ?></td>
        <td><?php echo $statecode; ?></td>
        <td> <?php echo $name ; ?></td>
        <td><?php echo $email; ?></td>
        <td><?php echo $gender; ?></td>
        <td><?php echo $dob; ?></td>
        <td><?php echo $age; ?></td>
        <td><?php echo $ppa; ?></td>

        <td>  <?php 
        //I changed the Id to State code, in case there is an error
                $edit_icon = "<a href='edit-corp-member.php?statecode={$statecode}' class='btn-sm btn-primary float-right ml-3 '> <span ><i class='fa fa-edit '></i></span> </a>";
                $delete_icon = " <a href='delete-corp-member.php?statecode={$statecode}' statecode='bin' class='btn-sm btn-primary float-right'> <span ><i class='fa fa-trash '></i></span> </a>";
                echo $edit_icon . $delete_icon;
             ?> 
        </td>

      
        

    <?php 
            $i++;
            }
        }else{
            echo "<script>
            $(document).ready( function(){
                $('#showModal').modal('show');
                $('#linkBtn').attr('href', 'add-corp-member.php');
                $('#linkBtn').text('Add corp member');
                $('#addMsg').text('No Corp Member Found!');
                $('#closeBtn').text('Remind Me Later!');
            })
         </script>
         ";
        }
    ?>
     </tr>
    </table>
    </div>
</div>

<?php 
require_once "include/footer.php";
?>

<?php 
require_once "include/footer.php";
?>
