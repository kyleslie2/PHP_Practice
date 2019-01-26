<?php
session_start(); 	// start PHP session!

include 'BookList.php';

//if the session doesn't exists, send them back to first page (no need to exit)
if(!isset($_SESSION['copies']))
{
    header("Location: newBookSelection.php");
}
?>

<html>
<head>
    <title>Confirmation</title>
    <link rel="stylesheet" type="text/css" href="Contents/BookStore.css" />
</head>
<body>
<h2>Thank you, please review your selection</h2>

<table border="1">
    <tr><th>Title</th><th>Price</th><th>Copies</th><th>Total</th></tr>
    <?php
    //These lines were from Wei Gong's lecture/ demonstration

    $i = 0;
    $copies = $_SESSION['copies'];
    $total = 0;
    foreach($bookList as $title => $price)
    {
        //$copies[$i] = how many copies were selected
       if ($copies[$i] > 0)
       {
           //subtotal = book price x number of copies for that index
           $subTotal = $price * $copies[$i];
           //
           echo "<tr><td>$title</td><td>$$price</td><td>$copies[$i]</td><td>$$subTotal</td></tr>";
           $total += $price * $copies[$i];
       }
       $i++;
    }
    echo "<tr><th colspan='3' style='text-align: right'>Grand Total: </th><td>\$$total</td></tr>";
    ///////////////////////////////////////////////////////////
?>
</table>
<!--ERROR CHECKING-->
<!--<h2>--><?php
//    if(isset($copies))
//    {
//        echo "SESSION is: ";
//        print_r($copies);
//    }
//    ?><!--</h2>-->
<!--///////////////-->
</br></br>

<!--make sure button is in a form. Post to selection page, not this one $back will be set when you do this-->
<form action="newBookSelection.php" method="post">
    <input type='submit'  class='button' name='back' value='Back'/>

</form>
</body>
</html>


