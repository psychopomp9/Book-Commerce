<?php
//    echo $_COOKIE['item'];
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        require('mysqli_connect.php');
        
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $payment_method = $_POST['payment_method'];
        
        $q = "SELECT * FROM user WHERE first_name = ? AND last_name = ?;";
        
        $stmt = mysqli_prepare($dbc, $q);
        mysqli_stmt_bind_param($stmt, 'ss', $first_name, $last_name);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        
        if(mysqli_stmt_num_rows($stmt) != 1){
            $q1 = "INSERT INTO user VALUES (null, '$first_name', '$last_name');";
            $r1 = mysqli_query($dbc, $q1);
        }
        
        mysqli_stmt_close($stmt);
        
        $q2 = "SELECT user_id FROM user WHERE first_name = ? AND last_name = ?;";
        
        $stmt1 = mysqli_prepare($dbc, $q2);
        mysqli_stmt_bind_param($stmt1, 'ss', $first_name, $last_name);           
        mysqli_stmt_execute($stmt1);
            
        mysqli_stmt_bind_result($stmt1, $user_id);
        mysqli_stmt_fetch($stmt1);
            
        mysqli_stmt_close($stmt1);
        $q3 = "INSERT INTO orders VALUES (null, '$payment_method', 1, $user_id, {$_COOKIE['item']});";
        
        $r3 = mysqli_query($dbc, $q3);
        
        $q4 = "UPDATE item_inventory SET stock=stock-1 WHERE item_id={$_COOKIE['item']};";
        $r4 = mysqli_query($dbc, $q4);
        
        echo "<div class='container'>
                    <h3>Order placed for <b>$first_name $last_name</b></h3>
                    <h4>Item: <b>{$_COOKIE['item_name']}</b></h4> <br>
                    <a href='store.php'>go back to store</a>
              </div>";
            
//            sleep(5);
//            header("Location: store.php");
    }
?>

<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
        
        <style>
            div{
                text-align: center;
                padding: 10px;
            }
            
            #nav{
                text-align: left;
            }
        </style>
        
        <title>Book-Commerce: Check-out</title>
    </head>
    
    <body>
        <div class="container">
            <div <?php if($_SERVER['REQUEST_METHOD'] == 'POST'){ echo "style = 'display: none;'";} ?>>
                <a href="store.php">Back to Store</a><br><br>
                <h2>Please provide below information to place your order: </h2><br>
                <form action="check_out.php" method="POST">
                    <p><b>First Name:</b> <input type="text" name="first_name" required></p>
                    <p><b>Last Name:</b> <input type="text" name="last_name" required></p>
    <!--                <p>Phone: <input type="text" name="contact" pattern="[0-9]{10}" required></p>-->
                    <p><b>Payment Options:</b> </p>
                        <p><input type="radio" name="payment_method" value="credit" checked> Credit Card</p>
                        <p><input type="radio" name="payment_method" value="debit"> Debit Card</p>
                        <p><input type="radio" name="payment_method" value="interac"> Interac</p>
                    <p><input type="submit" value="Pay"></p>
                </form>
            </div>
        </div>
    </body>
</html>