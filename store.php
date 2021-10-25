<?php 
    require("mysqli_connect.php");

    
?>

<html>
    <head>
        <title>Book-Commerce: Store</title>
    </head>
    <body>
        <h1>Books</h1>
        <?php 
            $q = "SELECT * FROM item_inventory";
            $r = @mysqli_query($dbc, $q);
        
            while($row = mysqli_fetch_array($r)){
                echo "<h3>{$row['item_name']}</h3>
                    <p>{$row['stock']}</p>
                    <button>Add To Cart</button>";
            }
        ?>
    </body>
</html>