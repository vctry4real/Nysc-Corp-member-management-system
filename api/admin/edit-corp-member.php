<?php 
    require_once "include/header.php";
?>

<?php 
    require_once "include/header.php";
?>
    
    <?php
    require_once "include/header.php";
?>


<?php  


        $statecode = $_GET["statecode"];
        require_once "../connection.php";

        $sql = "SELECT * FROM corper WHERE statecode = '$statecode'";
        $result = mysqli_query($conn , $sql);

        if(mysqli_num_rows($result) > 0 ){
        
            while($rows = mysqli_fetch_assoc($result) ){
                $name = $rows["name"];
                $email = $rows["email"];
                $dob = $rows["dob"];
                $gender = $rows["gender"];
                $statecode = $rows["statecode"];
                $ppa = $rows["ppa"];
                $pass = $rows["pass"];
            }
        }

        $nameErr = $emailErr = $passErr = $statecodeErr = $ppaErr ="";
        $pass = "";
      

        if( $_SERVER["REQUEST_METHOD"] == "POST" ){

            if( empty($_REQUEST["gender"]) ){
                $gender ="";
            }else {
                $gender = $_REQUEST["gender"];
            }


            if( empty($_REQUEST["dob"]) ){
                $dob = "";
            }else {
                $dob = $_REQUEST["dob"];
            }

            if( empty($_REQUEST["name"]) ){
                $nameErr = "<p style='color:red'> * Name is required</p>";
                $name = "";
            }else {
                $name = $_REQUEST["name"];
            }

            if( empty($_REQUEST["statecode"]) ){
                $statecodeErr = "<p style='color:red'> * State code is required</p>";
                $statecode = "";
            }else {
                $statecode = $_REQUEST["statecode"];
            }

            if( empty($_REQUEST["ppa"]) ){
                $ppaErr = "<p style='color:red'> * State code is required</p>";
                $ppa = "";
            }else {
                $ppa = $_REQUEST["ppa"];
            }

            if( empty($_REQUEST["email"]) ){
                $emailErr = "<p style='color:red'> * Email is required</p> ";
                $email = "";
            }else{
                $email = $_REQUEST["email"];
            }

            if( empty($_REQUEST["pass"]) ){
                $passErr = "<p style='color:red'> * Password is required</p> ";
                $pass = "";
            }else{
                $pass = $_REQUEST["pass"];
            }


            if( !empty($name) && !empty($email) && !empty($pass) && !empty($statecode) && !empty($ppa)){

                // database connection
                // require_once "../connection.php";

                $sql_select_query = "SELECT email FROM corper WHERE email = '$email' ";
                $r = mysqli_query($conn , $sql_select_query);

                if( mysqli_num_rows($r) > 0 ){
                    //$emailErr = "<p style='color:red'> * Email Already Register</p>";
                    
                    $sql = "UPDATE corper SET name = '$name' , email = '$email', password ='$pass' , dob='$dob', gender='$gender' , statecode='$statecode', ppa='$ppa' WHERE statecode = '$_GET[statecode]' ";
                    $result = mysqli_query($conn , $sql);
                    if($result){ 
                        echo "<script>
                        $(document).ready( function(){
                            $('#showModal').modal('show');
                            $('#modalHead').hide();
                            $('#linkBtn').attr('href', 'manage-corp-member.php');
                            $('#linkBtn').text('View Corp-members');
                            $('#addMsg').text('Profile Edit Successfully!');
                            $('#closeBtn').text('Edit Again?');
                        })
                     </script>
                     ";
                    }
                    
                }

            }
        }

?>



<div style=""> 
<div class="login-form-bg h-100">
        <div class="container  h-100">
            <div class="row justify-content-center h-100">
                <div class="col-xl-6">
                    <div class="form-input-content">
                        <div class="card login-form mb-0">
                            <div class="card-body pt-4 shadow">                       
                                    <h4 class="text-center">Edit Corp Member profile</h4>
                                <form method="POST" action=" <?php htmlspecialchars($_SERVER['PHP_SELF']) ?>">
                            
                                <div class="form-group">
                                    <label >Full Name :</label>
                                    <input type="text" class="form-control" value="<?php echo $name; ?>"  name="name" >
                                   <?php echo $nameErr; ?>
                                </div>


                                <div class="form-group">
                                    <label >Email :</label>
                                    <input type="email" class="form-control" value="<?php echo $email; ?>"  name="email" >     
                                    <?php echo $emailErr; ?>
                                </div>

                                <div class="form-group">
                                    <label >Password: </label>
                                    <input type="password" class="form-control" value="<?php echo $pass; ?>" name="pass" > 
                                    <?php echo $passErr; ?>           
                                </div>

                                <div class="form-group">
                                    <label >State code :</label>
                                    <input type="text" class="form-control" value="<?php echo $statecode; ?>" name="statecode" >  
                                    <?php echo $statecodeErr; ?>            
                                </div>

                                <div class="form-group">
                                    <label >PPA (Place Of Primary Assignment) :</label>
                                    <input type="text" class="form-control" value="<?php echo $ppa; ?>" name="ppa" >  
                                    <?php echo $ppaErr; ?>            
                                </div>

                                <div class="form-group">
                                    <label >Date-of-Birth :</label>
                                    <input type="date" class="form-control" value="<?php echo $dob; ?>" name="dob" >  
                                   
                                </div>

                                <div class="form-group form-check form-check-inline">
                                    <label class="form-check-label" >Gender :</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" <?php if($gender == "Male" ){ echo "checked"; } ?>  value="Male"  selected>
                                    <label class="form-check-label" >Male</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" <?php if($gender == "Female" ){ echo "checked"; } ?>  value="Female">
                                    <label class="form-check-label" >Female</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" <?php if($gender == "Other" ){ echo "checked"; } ?>  value="Other">
                                    <label class="form-check-label" >Other</label>
                                </div>

                               
                                <br>

                                <button type="submit" class="btn btn-primary btn-block">Update</button>
                                  </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
    require_once "include/footer.php";
?>


<?php 
    require_once "include/footer.php";
?>


<?php 
    require_once "include/footer.php";
?>