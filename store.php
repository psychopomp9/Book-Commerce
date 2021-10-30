<?php 
    require("mysqli_connect.php");

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $q1 = "SELECT * FROM item_inventory";
        $r1 = mysqli_query($dbc, $q1);

        while($row = mysqli_fetch_array($r1)){
             if(isset($_POST["{$row['item_id']}"])){
                 setcookie("item", $row['item_id']);
                 setcookie("item_name", $row['item_name']);
             }  
        }
                    
        header('Location: check_out.php');
    }
?>

<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
        
        <title>Book-Commerce: Store</title>
        
        
        <style>
            div{
                text-align: center;
                padding: 10px;
            }
        </style>
        
    </head>
    <body>
        <div class="container">
            <h1>Books</h1>
            <form method="POST">
                <div class="row">
                    <?php 
                        $q = "SELECT * FROM item_inventory";
                        $r = mysqli_query($dbc, $q);

                        while($row = mysqli_fetch_array($r)){
                            if($row['stock'] == 0){
                                echo "<div class='col-md-4 col-sm-6'>
                                    <img src='images/{$row['image']}' height='300px' width='200px'>
                                    <h3>{$row['item_name']}</h3>
                                    <p>currently unavailable</p>
                                    </div>";
                            }else{
                                echo "<div class='col-md-4 col-sm-6'>
                                    <img src='images/{$row['image']}' height='300px' width='200px'>
                                    <h3>{$row['item_name']}</h3>
                                    <p>left: {$row['stock']}</p>
                                    <input type='submit' name='{$row['item_id']}' value='Purchase'>
                                    </div>";
                            }
                        }
                    ?>
                </div>
            </form>
        </div>
    </body>
</html>