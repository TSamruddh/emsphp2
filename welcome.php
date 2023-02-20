<?php 
    session_start();
    echo "Welcome ",$_SESSION['username'];

    echo "<br> <a href='logout.php'>logout</a>";
?>
<?php 
    require_once("Include/DB.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Data Into DataBase</title>
    <link rel="stylesheet" href="Include/style.css">
</head>
<body>

    <h2 class="success"> <?php echo @$_GET["id"];  ?> </h2>

    <div class="">
        <fieldset>
            <form action="View_From_Database.php" class="" method="GET">
                <input type="text" name="Search" value="" placeholder="Search by Employee Name">
                <input type="submit" name="SearchButton" value="Search Record">
            </form>
        </fieldset>
    </div>

    <?php 
            if(isset($_GET["SearchButton"])){
                global $ConnectingDB;
                $Search = $_GET["Search"];
                $sql = "SELECT * FROM emp_record WHERE ename=:searcH";
                $stmt = $ConnectingDB->prepare($sql);
                $stmt->bindValue(':searcH',$Search);
                $stmt->execute();
                while ($DataRows = $stmt->fetch()){
                    $Id =           $DataRows["id"];
                    $EName =        $DataRows["ename"];
                    $Email =        $DataRows["email"];
                    $Designation =  $DataRows["designation"];
                    $Age =          $DataRows["age"];
                
    ?>
    <div>
            <table width="1000" border="5" align="center">
                <caption>Search Result</caption>
                <tr>
                    <th>Id</th>
                    <th>Employee Name</th>
                    <th>Email</th>
                    <th>Designation</th>
                    <th>Age</th>
                    <th>Search Again</th>
                </tr>
                <tr>
                    <td><?php echo $Id; ?></td>
                    <td><?php echo $EName; ?></td>
                    <td><?php echo $Email; ?></td>
                    <td><?php echo $Designation; ?></td>
                    <td><?php echo $Age; ?></td>
                    <td><a href="View_Form_Databse.php">Search Again</a></td>
                </tr>
            </table>
    </div>

            <?php }//Ending of While loop
            } //Ending of Submit button

            ?>

    <div>
    <h1>View Employee</h1>
    <a href="Insert_into_Database.php">Add Employee Details Page</a>
    <table width="1000" border="5" align="center">
        <caption>View Employee Detils</caption>
        <tr>
            <th>ID</th>
            <th>Employee Name</th>
            <th>Email</th>
            <th>Designation</th>
            <th>Age</th>
            <th>Update</th>
            <th>Delete</th>
        </tr>

   
    <?php 
        global $ConnectingDB;
        $sql = "SELECT * FROM emp_record";
        $stmt  = $ConnectingDB->query($sql);
        while($DataRows=$stmt->fetch()){
            $Id             = $DataRows["id"];
            $EName          = $DataRows["ename"];
            $Email          = $DataRows["email"];
            $Designation    = $DataRows["designation"];
            $Age            = $DataRows["age"];
        
    ?>
    <tr>
        <td><?php echo $Id; ?></td>
        <td><?php echo $EName; ?></td>
        <td><?php echo $Email; ?></td>
        <td><?php echo $Designation; ?></td>
        <td><?php echo $Age; ?></td>
        <td><a href="Update.php?id=<?php echo $Id; ?>">Update</td>
        <td><a href="Delete.php?id=<?php echo $Id; ?>">Delete</td>


    </tr>
    <?php } ?>
    </table>
    </div>
    <a href="logout.php">Logout</a>    
</body>
</html>