<?php 
    session_start();
    if(isset($_SESSION['username'])){
    echo "Welcome ",$_SESSION['username'];

    echo "<br> <button><a href='logout.php'><h4>LOG-OUT</h4></a></button>";
    
?>
<?php 
    // require_once("Include/DB.php");
    // $SearchQueryParameter = $_GET["id"];
    // if(isset($_POST["Submit"])){
        
    //         $EName = $_POST["EName"];
    //         $Email = $_POST["Email"];
    //         $Designation = $_POST["Designation"];
    //         $Age = $_POST["Age"];
    //         $ConnectingDB;
    //         $sql = "UPDATE emp_record SET ename='$EName', email='$Email', 
    //         designation='$Designation', age='$Age' WHERE id ='$SearchQueryParameter'";
    //         $Execute = $ConnectingDB->query($sql);
    //         if ($Execute){
    //             echo '<script>window.open("View_From_Database.php?id=Record Updated Scuccessfully","_self")</script>';
    //         }
        

    // }
?>
<?php 
    require_once("Include/DB.php");
    $SearchQueryParameter = $_GET["id"];
    $con = mysqli_connect("localhost","root","","emsphp");
    $sql = "SELECT * FROM `designation`";
    $all_categories = mysqli_query($con,$sql);
    if(isset($_POST["Submit"])){
        if(!empty($_POST["EName"])&&!empty($_POST["Email"])&&!empty($_POST["Designation"])&&!empty($_POST["Age"])){

            $EName = $_POST["EName"];
            $Email = $_POST["Email"];
            $Designation = $_POST["Designation"];
            // $Designation = mysqli_real_escape_string($con,$_POST['Designation']);
            // $Designation = mysqli_fetch_all($con,$_POST['Designation']);
            $Age = $_POST["Age"];
            global $ConnectingDB;
            // $sql = "INSERT INTO emp_record(ename,email,designation,age)
            // VALUES(:enamE,:emaiL,:designatioN,:agE)";
            $sql = "UPDATE `emp_record` SET `ename`='$EName',
            `email`='$Email',`designation`='$Designation',`age`='$Age' WHERE id='$SearchQueryParameter'";
            $Execute = $ConnectingDB->query($sql);
            // $stmt->bindValue('enamE',$EName);
            // $stmt->bindValue('emaiL',$Email);
            // $stmt->bindValue('designatioN',$Designation);
            // $stmt->bindValue('agE',$Age);
            // $Execute = $stmt->execute();
            // $Execute = $stm->execute(
            //     array(":enamE" => $EName, 
            //           ":emaiL" => $Email, 
            //           ":designatioN" => $Designation,
            //           ":agE" => $Age)
            // );
            if ($Execute){
                echo '<span class="success">Record has been added successfully</span>';
                echo '<script>window.open("View_From_Database.php?id=Record
                Updated Successfully","_self")</script>';
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
    <title>Update Data Into DataBase</title>
    <link rel="stylesheet" href="Include/style.css">
</head>
<body>
    <h1>Update Employee</h1>
    <a href="View_From_Database.php">View Employee Details Page</a>
    <?php 
            global $ConnectingDB;
            // $sql = "SELECT * FROM emp_record WHERE id='$SearchQueryParameter'";
            $sql = "SELECT emp_record.id,
            emp_record.ename,
            emp_record.email,
            designation.designation,
            emp_record.age FROM emp_record INNER JOIN designation on 
            emp_record.designation = designation.id WHERE emp_record.id='$SearchQueryParameter'";
            $stmt=$ConnectingDB->query($sql);
            while($DataRows=$stmt->fetch()){
                $Id             = $DataRows["id"];
                $EName          = $DataRows["ename"];
                $Email          = $DataRows["email"];
                $Designation    = $DataRows["designation"];
                $Age            = $DataRows["age"];
            }
    ?>
    <div class="">
            <form class="" action="Update.php?id=<?php echo $SearchQueryParameter; ?>" method="post">
                <fieldset>
                    <span class="FieldInfo">Employee Name:</span>
                    <br>
                    <input type="text" name="EName" value="<?php echo $EName; ?>">
                    <br>
                    <span class="FieldInfo">Email:</span>
                    <br>
                    <input type="email" name="Email" value="<?php echo $Email; ?>">
                    <br>
                    <span class="FieldInfo">Designation:</span>
                    <br>
                    
                    <select name="Designation">
                       
                    <!-- <option disabled>Select Designation Here</option> -->
                    <?php
                    while ($row = mysqli_fetch_assoc($all_categories)) {
                        $selected = ($row['designation'] == $Designation) ? 'selected' : '';
                        echo '<option value="' . $row['id'] . '" ' . $selected . '>' . $row['designation'] . '</option>';
                    }
                    ?>
                </select>
                    <br>
                    <span class="FieldInfo">Age:</span>
                    <br>
                    <input type="number" value="<?php echo $Age; ?>" name="Age" min="1" max="100" oninput="validity.valid||(value='');">
                    <br>
                    <input type="submit" name="Submit" value="Update your record">
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