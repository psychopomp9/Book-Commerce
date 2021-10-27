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
            $r1 = @mysqli_query($dbc, $q1);
        }
        
        $q2 = "SELECT user_id FROM user WHERE first_name = ? AND last_name = ?;";
        
        $stmt1 = mysqli_prepare($dbc, $q2);
        mysqli_stmt_bind_param($stmt1, 'ss', $first_name, $last_name);           mysqli_stmt_execute($stmt1);
            
        mysqli_stmt_bind_result($stmt1, $user_id);
        mysqli_stmt_fetch($stmt1);
            
        $q3 = "INSERT INTO order VALUES (null, '$payment_method', 1, $user_id, '{$_COOKIE['item']}');"; 
        $r3 = @mysqli_query($dbc, $q3);
            
        echo "Order placed for $first_name $last_name for item: <br>
                    redirecting to store page";
            
//            sleep(5);
//            header("Location: store.php");
    }
?>

<html>
    <head>
        <title>Book-Commerce: Check-out</title>
    </head>
    
    <body>
        <div <?php if($_SERVER['REQUEST_METHOD'] == 'POST'){ echo "style = 'display: none;'";} ?>>
            <h2>Please provide below information to submit your order: </h2>
            <form action="check_out.php" method="POST">
                <p>First Name: <input type="text" name="first_name" required></p>
                <p>Last Name: <input type="text" name="last_name" required></p>
<!--                <p>Phone: <input type="text" name="contact" pattern="[0-9]{10}" required></p>-->
                <p>Payment Options: </p>
                    <p><input type="radio" name="payment_method" value="credit" checked>Credit Card</p>
                    <p><input type="radio" name="payment_method" value="debit">Debit Card</p>
                    <p><input type="radio" name="payment_method" value="interac">Interac</p>
                <p><input type="submit" value="Pay"></p>
            </form>
        </div>
    </body>
</html>