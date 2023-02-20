<?php 
    session_start();
    if(isset($_SESSION['username'])){
    echo "Welcome ",$_SESSION['username'];

    echo "<br> <button><a href='logout.php'><h4>LOG-OUT</h4></a></button>";
    
?>
<?php 
    require_once("Include/DB.php");
    $SearchQueryParameter = $_GET["id"];
    if(isset($_POST["Submit"])){
        
            $EName = $_POST["EName"];
            $Email = $_POST["Email"];
            $Designation = $_POST["Designation"];
            $Age = $_POST["Age"];
            $ConnectingDB;
            $sql = "DELETE FROM emp_record WHERE id ='$SearchQueryParameter'";
            $Execute = $ConnectingDB->query($sql);
            if ($Execute){
                echo '<script>window.open("View_From_Database.php?id=Record Deleted Scuccessfully","_self")</script>';
                echo '<script>alert("Welcome to Geeks for Geeks")</script>';
            }
        

    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Data Into DataBase</title>
    <link rel="stylesheet" href="Include/style.css">
</head>
<body>
    <h1>Delete Employee</h1>
    <a href="View_From_Database.php">View Employee Details Page</a>
    <?php 
            global $ConnectingDB;
            $sql = "SELECT * FROM emp_record WHERE id='$SearchQueryParameter'";
            $stmt=$ConnectingDB->query($sql);
            while($DataRows =$stmt->fetch()){
                $Id             = $DataRows["id"];
                $EName          = $DataRows["ename"];
                $Email          = $DataRows["email"];
                $Designation    = $DataRows["designation"];
                $Age            = $DataRows["age"];
            }
    ?>
    <div class="">
            <form class="" action="Delete.php?id=<?php echo $SearchQueryParameter?>" method="post">
                <fieldset>
                    <span class="FieldInfo">Employee Name:</span>
                    <br>
                    <input type="text" name="EName" value="<?php echo $EName; ?>" readonly>
                    <br>
                    <span class="FieldInfo">Email:</span>
                    <br>
                    <input type="email" name="Email" value="<?php echo $Email; ?>" readonly>
                    <br>
                    <span class="FieldInfo">Designation:</span>
                    <br>
                    <input type="text" name="Designation" value="<?php echo $Designation; ?>" readonly>
                    <br>
                    <span class="FieldInfo">Age:</span>
                    <br>
                    <input type="number" name="Age" value="<?php echo $Age; ?>" readonly>
                    <br>
                    <input type="submit" name="Submit" value="Delete your record">
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