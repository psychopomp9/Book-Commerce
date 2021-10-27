<?php 
    require("mysqli_connect.php");

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $q1 = "SELECT * FROM item_inventory";
        $r1 = @mysqli_query($dbc, $q1);

        while($row = mysqli_fetch_array($r1)){
             if(isset($_POST["{$row['item_id']}"])){
                 setcookie("item", $row['item_id']);
             }  
        }
                    
        header('Location: check_out.php');
    }
?>

<html>
    <head>
        <title>Book-Commerce: Store</title>
    </head>
    <body>
        <h1>Books</h1>
        <form method="POST">
            <?php 
                $q = "SELECT * FROM item_inventory";
                $r = @mysqli_query($dbc, $q);

                while($row = mysqli_fetch_array($r)){
                    echo "<h3>{$row['item_name']}</h3>
                        <p>{$row['stock']}</p>
                        <input type='submit' name='{$row['item_id']}' value='Add To Cart'>";
                }
            ?>
        </form>
    </body>
</html>