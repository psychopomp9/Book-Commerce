<?php
    if($_REQUEST['POST']){
        
    }
?>

<html>
    <head>
        <title>Book-Commerce: Check-out</title>
    </head>
    
    <body>
        <form action="check_out.php" method="POST">
            <p>First Name: <input type="text" name="first_name" required></p>
            <p>Last Name: <input type="text" name="last_name" required></p>
            <p>Phone: <input type="tel" name="contact" required></p>
            <p>Payment Options: </p>
                <p><input type="radio" name="payment_method" value="credit" checked>Credit Card</p>
                <p><input type="radio" name="payment_method" value="debit">Debit Card</p>
                <p><input type="radio" name="payment_method" value="interac">Interac</p>
            <p><input type="submit"></p>
        </form>
    </body>
</html>