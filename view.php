<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="style.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<title>View</title>

<script>
  function checkDelete() {
    return confirm('Are you sure?')
  }
</script>

</head>
    
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "triplex";
    
try
{
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
}
catch(PDOException $e)
{
    $e->getMessage("not connected");
}
    

?>
    
<body>
    <nav class="navbar navbar-default">
          <div class="container-fluid">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span> 
              </button>
              <a class="navbar-brand" href="#">Triplex</a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
              <ul class="nav navbar-nav">
                <li><a href="index.php">Home</a></li>
                <li class="active"><a href="view.php">View</a></li> 
                <li><a href="#">Customer</a></li> 
              </ul>
              <ul class="nav navbar-nav navbar-right">
                <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
              </ul>
            </div>
          </div>
        </nav>    
    
    
<div class="container">
    <H1>Product's Information</H1>
    <br>
    <br>    
    <table class="table table-hover">
    <thead>
      <tr>
        <th>Product Name</th>
        <th>Quantity</th>
        <th>Price</th>
        <th>Warehouse</th>
        <th>Edit</th>
        <th>Delete</th>
      </tr>
    </thead>
    <tbody>
    <?php 
    $query = $conn->query("SELECT prod_id, prod_name, prod_quantity, prod_price, prod_location FROM tblproduct"); 
    foreach($query as $rows) 
    {
    
    $num = $rows['prod_price'];
    $formPrice = number_format($num);
        
    $num1 = $rows['prod_quantity'];
    $formQuantity = number_format($num1); 

    if(isset($_GET['idd']))
    {
    $prodId = $_GET['idd'];
    $deleteData = $conn->prepare("DELETE FROM tblProduct WHERE prod_id = :prodId");
    $deleteData->bindParam(":prodId", $prodId);
    $deleteData->execute();
    
    header('location: view.php');
  
    }

    ?>
      <tr>
        <td><?php echo $rows["prod_name"]; ?></td>
        <td><?php echo $formQuantity; ?></td>
        <td>₱ <?php echo $formPrice; ?></td>
        <td><?php echo $rows['prod_location']; ?></td>
        <td><a href="edit.php?idd=<?php echo $rows['prod_id']; ?>" class="btn btn-info" role="button" name="btnEdit"><span class="glyphicon glyphicon-edit"></span></a></td>
        <td><a href="view.php?idd=<?php echo $rows['prod_id']; ?>" onclick="return confirm('Are yo sure yo want to delete?')" class="btn btn-danger" role="button" name="btnDelete"><span class="glyphicon glyphicon-trash"></span></a></td>
      </tr> 

    </tbody>
    <?php } ?>
  </table>
</div>

    
    

</body>

</html>