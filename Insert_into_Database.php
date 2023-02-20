<?php 
    session_start();
    if(isset($_SESSION['username'])){
    echo "Welcome ",$_SESSION['username'];

    echo "<br> <button><a href='logout.php'><h4>LOG-OUT</h4></a></button>";
    
?>
<?php 
    require_once("Include/DB.php");
    $con = mysqli_connect("localhost","root","","emsphp");
    $sql = "SELECT * FROM `designation`";
    $all_categories = mysqli_query($con,$sql);
    if(isset($_POST["Submit"])){
        if(!empty($_POST["EName"])&&!empty($_POST["Email"])&&!empty($_POST["Designation"])&&!empty($_POST["Age"])){

            $EName = $_POST["EName"];
            $Email = $_POST["Email"];
            // $Designation = $_POST["Designation"];
            $Designation = mysqli_real_escape_string($con,$_POST['Designation']);
            $Age = $_POST["Age"];
            $ConnectingDB;
            $sql = "INSERT INTO emp_record(ename,email,designation,age)
            VALUES(:enamE,:emaiL,:designatioN,:agE)";
            $stmt = $ConnectingDB->prepare($sql);
            $stmt->bindValue('enamE',$EName);
            $stmt->bindValue('emaiL',$Email);
            $stmt->bindValue('designatioN',$Designation);
            $stmt->bindValue('agE',$Age);
            $Execute = $stmt->execute();
            if ($Execute){
                echo '<span class="success">Record has been added successfully</span>';
            }
        }else{
            echo '<span class="errorMsg">Pls fill all the fields</span>';
        }

    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Data Into DataBase</title>
    <link rel="stylesheet" href="Include/style.css">
</head>
<body>
    <h1>Add Employee</h1>
    <a href="View_From_Database.php">View Employee Details Page</a>
    <?php 

    ?>
    <div class="">
            <form class="" action="Insert_into_Database.php" method="post">
                <fieldset>
                    <span class="FieldInfo">Employee Name:</span>
                    <br>
                    <input type="text" name="EName" value="">
                    <br>
                    <span class="FieldInfo">Email:</span>
                    <br>
                    <input type="email" name="Email" value="">
                    <br>
                    <span class="FieldInfo">Designation:</span>
                    <br>
                    <!-- <input type="text" name="Designation" value=""> -->
                    
                    <!-- <select name="Designation" id="">
                        <option value="">---Select---</option>
                        <option value="A">A</option>
                        <option value="B">B</option>

                    </select> -->


                    <select name="Designation">
                    <option selected disabled>Select Designation Here</option>
                    <?php
                        // use a while loop to fetch data
                        // from the $all_categories variable
                        // and individually display as an option
                        while ($designation = mysqli_fetch_array(
                                $all_categories,MYSQLI_ASSOC)):;
                    ?>
                        <option value="<?php echo $designation["id"];
                            // The value we usually set is the primary key
                        ?>">
                            <?php echo $designation["designation"];
                                // To show the category name to the user
                            ?>
                        </option>
                    <?php
                        endwhile;
                        // While loop must be terminated
                    ?>
                </select>
                    <br><br>
                    <br>
                    <span class="FieldInfo">Age:(1 to 100)</span>
                    <br>
                    <input type="number" name="Age" min="1" max="100" oninput="validity.valid||(value='');">
                    <br>
                    <input type="submit" name="Submit" value="Submit your record">
                </fieldset> 
            </form>
    </div>
            
</body>
</html>

<?php 
}else{
     header("Location: index.php");
     exit();
}
 ?>