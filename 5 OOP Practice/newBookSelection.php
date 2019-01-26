<?php
session_start(); 	// start PHP session!

//include list of books
include "BookList.php";

extract($_POST);

//initialize variables
$errorMessage="";
$valid = 0;

//when they click buy...
if (isset ($buy))
{
    //increment $i, for each element of the $copies array
    for ($i = 0; $i < sizeof($copies); $i++)
    {
        //if the copies array has more than 0 elements, put it in a session and go to next page
        //exit to stop this page from continuing + clear error message
        if ($copies[$i] > 0)
        {
            $errorMessage = "";
            $_SESSION['copies'] = $copies;
            header("Location: newConfirmation.php");
            exit();
        }
        else
        {
            //if there are 0 elements in the array, display error and don't redirect
            $errorMessage = "You must select at least 1 copy of 1 book";
        }
    }

}
//if the $back button was clicked at this point, put the copies session/ array into a variable
elseif (isset($back))
{
    $copies = $_SESSION['copies'];

}


?>

<html>
<head>
    <title>Algonquin College Bookstore</title>
    <link rel="stylesheet" type="text/css" href="Contents/BookStore.css" />
</head>

<body>


<h3>Select the number of copies for books you want to buy and click Buy button</h3>
<!--display either empty string or error message depending-->
<h4 style="color: darkred"> <?php echo $errorMessage; ?></h4>


<!--ERROR CHECKING-->
<!--<h2>--><?php
//    if(isset($copies))
//    {
//        echo "SESSION is: ";
//        print_r($copies);
//    }
//    ?><!--</h2>-->
<!--///////////////-->


<form action="newBookSelection.php" method="post">
    <table border="1">
        <tr>
            <th>Title</th>
            <th>Price</th>
            <th>Copies</th>
        </tr>
        <?php

        // index items of array
        $i = 0;
        //foreach item as: 'Head First PHP & MySQL' => 64.35,
        foreach ($bookList as $title => $price) {
            echo "<tr>";
            echo "<td>$title</td><td>$price</td>";
            //This line was from Wei Gong's lecture/ demonstration
            echo "<td align='center'><input type='number' name='copies[]' value='".(isset($copies) ? $copies[$i] : '')."' size='2'/></td>";
            // if copies is set, the value is... the element of copies we are at or it's empty. also append this to the list
            echo "</tr>";
            //increment index
            $i++;

        }

        ?>
    </table>

    <br/>
    <input type='submit' class='button' name='buy' value='buy'/>
</form>

</body>

<?php
//not useful functions
//function ValidateCopies ($c) {
//
//
//    //checking to see if one of the values in the array is above 0
//    if(min($c)<0){
//        return "At least one book's number of copy should be greater than 0";
//    }else{
//        return "";
//    }
//
//}
//
//function ValidateForm($errorMessage)
//{
//    if ($errorMessage == "")
//    {
//        //valid
//        return 1;
//    }
//    else
//    {
//        //invalid
//        return 0;
//    }
//}
//
//
//?>
</html>