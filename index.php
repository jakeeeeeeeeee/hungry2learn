<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="style.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<title>Crud Method</title>
</head>
    
    <?php 
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "triplex";
    
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
     
    }
    catch(PDOException $e)
    {
        echo "Error : " .$e->getMessage();
    }
    
    session_start();
    
    
    if(isset($_POST['btnSubmit']))
    {
        $prod_id = uniqid('U');
        $prod_name = $_POST['prod_name'];
        $prod_quantity = $_POST['prod_quantity'];
        $prod_price = $_POST['prod_price'];
        $prod_location = $_POST['prod_location'];
        
        $query = $conn->prepare("INSERT INTO tblProduct(prod_id,prod_name,prod_quantity,prod_price,prod_location)VALUES(:prod_id, :prod_name, :prod_quantity, :prod_price, :prod_location)");
        $query->bindParam(":prod_id", $prod_id);
        $query->bindParam(":prod_name", $prod_name);
        $query->bindParam(":prod_quantity", $prod_quantity);
        $query->bindParam(":prod_price", $prod_price);
        $query->bindParam(":prod_location", $prod_location);
        $query->execute();
        
        header("Location: view.php");
   
        
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
        <li class="active"><a href="index.php">Home</a></li>
        <li><a href="view.php">View</a></li> 
        <li><a href="#">Customer</a></li> 
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
        <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
      </ul>
    </div>
  </div>
</nav>
    <div class="wrap">
    <form method="post">
    <h1>Create Item </h1>
    <br>
    <li class="prod_info">Product Name:</li>
    <input type="text" class="form-control" name="prod_name">
    <li class="prod_info">Product Quantity:</li>
    <input type="text" class="form-control" name="prod_quantity">
    <li class="prod_info">Product Price:</li>
    <input type="text" class="form-control" name="prod_price">
    <li class="prod_info">Location</li>
    <input type="text" class="form-control" name="prod_location">
    <br>
     <input type="submit" name="btnSubmit" class="btn btn-danger" value="Submit">   
    </form>
    </div>  

   
    
</body>

</html>