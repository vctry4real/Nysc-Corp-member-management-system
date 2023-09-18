<?php 
require_once "include/header.php";
?>
<?php

        // database connection
        require_once "../connection.php";

         $currentDay = date( 'Y-m-d', strtotime("today") );
         $tomarrow = date( 'Y-m-d', strtotime("+1 day") );

         $today_leave = 0;
         $tomarrow_leave = 0;
         $this_week = 0;
         $next_week = 0;
            $i = 1;
        // total admin
        $select_admins = "SELECT * FROM admin";
        $total_admins = mysqli_query($conn , $select_admins);

        // total employee
        $select_emp = "SELECT * FROM corper";
        $total_emp = mysqli_query($conn , $select_emp);

        // employee on leave
        $emp_leave  ="SELECT * FROM emp_leave";
        $total_leaves = mysqli_query($conn , $emp_leave);

        if( mysqli_num_rows($total_leaves) > 0 ){
            while( $leave = mysqli_fetch_assoc($total_leaves) ){
                $leave = $leave["start_date"];

                //daywise
                if($currentDay == $leave){
                    $today_leave += 1;
                }elseif($tomarrow == $leave){
                   $tomarrow_leave += 1;
                }


            }
        }else {
            echo "no leave found";
        }


        // highest paid employee
        $sql_ppa =  "SELECT * FROM corper ORDER BY ppa DESC";
        $corp_ = mysqli_query($conn , $sql_ppa);



?>

<div class="container">

    <div class="row mt-5">
        <div class="col-4">
            <div class="card shadow " style="width: 18rem;">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item text-center">Admins</li>
                    <li class="list-group-item">Total Admin : <?php echo mysqli_num_rows($total_admins); ?> </li>
                    <li class="list-group-item text-center"><a href="manage-admin.php"><b>View All Admins</b></a></li>
                </ul>
            </div>
        </div>
        <div class="col-4">
            <div class="card shadow " style="width: 18rem;">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item text-center">Corp Members</li>
                    <li class="list-group-item">Total Corp Members : <?php echo mysqli_num_rows($total_emp); ?></li>
                    <li class="list-group-item text-center"><a href="manage-employee.php"> <b>View All Corp Member</b></a></li>
                </ul>
            </div>
        </div>
        <div class="col-4">
            <div class="card shadow " style="width: 18rem;">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item text-center">Corp Member on  Leave (Daywise)</li>
                    <li class="list-group-item">Today :  <?php echo $today_leave; ?>  </li>
                    <li class="list-group-item">Tomarrow :  <?php echo $tomarrow_leave; ?> </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- <div class="row mt-5">
        <div class="col-4">       
        </div>

        <div class="col-4">
            <div class="card shadow " style="width: 18rem;">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item text-center">Employees on Leave (Weekwise) </li>
                    <li class="list-group-item">This Week : </li>
                    <li class="list-group-item">Next Week : </li>
                </ul>
            </div>
        </div>
    </div> -->
    <div class="row mt-5 bg-white shadow "> 
    <div class="col-12">
            <div class=" text-center my-3 "> <h4>Corp Member Serving In Ogbomosho</h4> </div>
            <table class="table  table-hover">
        <thead>
            <tr class="bg-dark">
            <th scope="col">S.No.</th>
            <th scope="col">State Code</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">PPA</th>
            </tr>
        </thead>
        <tbody>
        <?php while( $corp_info = mysqli_fetch_assoc($corp_) ){
                    $corp_id = $corp_info["statecode"];
                    $corp_name = $corp_info["name"];
                    $corp_email = $corp_info["email"];
                    $corp_ppa = $corp_info["ppa"];
                    ?>
            <tr>
            <th ><?php echo "$i. "; ?></th>
            <th ><?php echo $corp_id; ?></th>
            <td><?php echo $corp_name; ?></td>
            <td><?php echo $corp_email; ?></td>
            <td><?php echo $corp_ppa; ?></td>
            </tr>

          <?php  
          $i++; 
                } 
            ?>
        </tbody>
        </table>
    </div>
    </div>
</div>

<?php 
require_once "include/footer.php";
?>