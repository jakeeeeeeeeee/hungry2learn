<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    
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
    echo "Not connected!" . $e->getMessage();
}

    
 //USING $_GET TO GET THE ID IN ANOTHER FORM   
$productId = $_GET['idd'];
$get_data = $conn->prepare("SELECT * FROM tblProduct WHERE prod_id = :idd");
$get_data->bindParam(":idd", $productId);
$get_data->execute();
    
    foreach($get_data as $rows) {
    /*    
    $quantity = $rows['prod_quantity'];
    $formQuantity = number_format($quantity);
    
    $price = $rows['prod_price'];
    $formPrice = number_format($price);
*/


//UPDATE DATA
if(isset($_POST['btnSubmit1']))
    {
    $prodName = $_POST['prod_name'];
    $prodQuantity = $_POST['prod_quantity'];
    $prodPrice = $_POST['prod_price'];
    $prodLocation = $_POST['prod_location'];

    $query = $conn->prepare("UPDATE tblProduct SET prod_name = :prodName, prod_quantity = :prodQuantity, prod_price = :prodPrice, prod_location = :prodLocation WHERE prod_id = :prodId");
    $query->bindParam(":prodId", $productId);
    $query->bindParam(":prodName", $prodName);
    $query->bindParam(":prodQuantity", $prodQuantity);
    $query->bindParam(":prodPrice", $prodPrice);
    $query->bindParam(":prodLocation", $prodLocation);
    $query->execute();

    header("location: view.php");
    }
        
?>

<body>
    <div class="container">
    
        <div class="wrap">
        <form method = "POST">   
            
        <h1>Edit :</h1>   
        <label>Product Name:</label>
        <input type="text" name="prod_name" class="form-control" value="<?php echo $rows['prod_name'];?>">
        <label>Quantity</label>
        <input type="text" name="prod_quantity" class="form-control" value="<?php echo $rows['prod_quantity']; ?>">
        <label>Price</label>
        <input type="text" name="prod_price" class="form-control" value="<?php echo $rows['prod_price']; ?>">
        <label>Warehouse</label>
        <input type="text" name="prod_location" class="form-control" value="<?php echo $rows['prod_location']; ?>">
        <br>
        <br>
        <input type="submit" name="btnSubmit1" class="btn btn-danger" value="Save">
        
        
        <?php } ?>
        </div>
        </form>
    </div>
</body>
</html>