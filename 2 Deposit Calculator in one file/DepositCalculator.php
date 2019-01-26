<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" href="main.css">
        <title>Results</title>
    </head>

    <body>

    <?php
    //initialize variables

    $valid = 0;
    $principal = $rate = $years = $name = $postalCode = $phone = $email = $contactMethod = "";
    $validPrincipal = $validRate = $validYears = $validName = $validPostalCode = $validPhone = $validEmail = $validContact = $confirmationMessage = "";

    $confirmationMessage = "";

//    $contactMethod = $morning = $afternoon = $evening = "";


    if (isset($_POST["btnSubmit"]))
    {
        //capture form fields into variables

        $principal = ($_POST["principal"]);
        $rate = ($_POST["rate"]);
        $years = ($_POST["years"]);
        $name = ($_POST["name"]);
        $postalCode = ($_POST["postalCode"]);
        $phone = ($_POST["phone"]);
        $email = ($_POST["email"]);

        //        $contactMethod = ($_POST["contactMethod"]);
        //        $morning = ($_POST["morning"]);
        //        $afternoon =  ($_POST["afternoon"]);
        //        $evening = ($_POST["evening"]);

//        run functions and put results into variables. error message or empty string is returned

        $validPrincipal = ValidatePrincipal($principal);
        $validRate= ValidateRate($rate);
        $validYears= ValidateYears($years);
        $validName = ValidateName($name);
        $validPostalCode = ValidatePostalCode($postalCode);
        $validPhone = ValidatePhone($phone);
        $validEmail = ValidateEmail($email);
        $validContact = ValidateContact();
        $valid = ValidateForm($validPrincipal, $validRate, $validYears, $validName, $validPostalCode, $validPhone, $validEmail, $validContact);

        $confirmationMessage = ConfirmationMessage($phone, $email);

    }


    if (!isset($_POST["btnSubmit"]) || $valid == 0) {

       ?>
       <h1>Deposit Calculator</h1>
       <hr>

       <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
           <div class="form-group row">
               <label for="principal" class="col-sm-2 col-form-label">Principal Amount</label>
               <div class="col-sm-10">
                   <input type="number" class="form-control" name="principal" id="principal" placeholder="0" value="<?php echo $principal; ?>">

                   <span class="text-danger"><?php echo $validPrincipal; ?></span>
               </div>
           </div>
           <div class="form-group row">
               <label for="rate" class="col-sm-2 col-form-label">Interest Rate (%)</label>
               <div class="col-sm-10">
                   <input type="number" class="form-control" name="rate" id="rate" placeholder="0%" value="<?php echo $rate; ?>">
                   <span class="text-danger"><?php echo $validRate; ?></span>

               </div>
           </div>
           <div class="form-group row">
               <label for="years" class="col-sm-2 col-form-label">Years to Deposit</label>
               <div class="dropown">
                   <select class="dropdown" name="years" id="years">
                       <option class="dropdown-item" value="0"<?php if(isset($years) && $years=="0") { echo " selected"; } ?>>0</option>
                       <option class="dropdown-item" value="1"<?php if(isset($years) && $years=="1") { echo " selected"; } ?>>1</option>
                       <option class="dropdown-item" value="2"<?php if(isset($years) && $years=="2") { echo " selected"; } ?>>2</option>
                       <option class="dropdown-item" value="3"<?php if(isset($years) && $years=="3") { echo " selected"; } ?>>3</option>
                       <option class="dropdown-item" value="4"<?php if(isset($years) && $years=="4") { echo " selected"; } ?>>4</option>
                       <option class="dropdown-item" value="5"<?php if(isset($years) && $years=="5") { echo " selected"; } ?>>5</option>
                       <option class="dropdown-item" value="6"<?php if(isset($years) && $years=="6") { echo " selected"; } ?>>6</option>
                       <option class="dropdown-item" value="7"<?php if(isset($years) && $years=="7") { echo " selected"; } ?>>7</option>
                       <option class="dropdown-item" value="8"<?php if(isset($years) && $years=="8") { echo " selected"; } ?>>8</option>
                       <option class="dropdown-item" value="9"<?php if(isset($years) && $years=="9") { echo " selected"; } ?>>9</option>
                       <option class="dropdown-item" value="10"<?php if(isset($years) && $years=="10") { echo " selected"; } ?>>10</option>
                       <option class="dropdown-item" value="11"<?php if(isset($years) && $years=="11") { echo " selected"; } ?>>11</option>
                       <option class="dropdown-item" value="12"<?php if(isset($years) && $years=="12") { echo " selected"; } ?>>12</option>
                       <option class="dropdown-item" value="13"<?php if(isset($years) && $years=="13") { echo " selected"; } ?>>13</option>
                       <option class="dropdown-item" value="14"<?php if(isset($years) && $years=="14") { echo " selected"; } ?>>14</option>
                       <option class="dropdown-item" value="15"<?php if(isset($years) && $years=="15") { echo " selected"; } ?>>15</option>
                       <option class="dropdown-item" value="16"<?php if(isset($years) && $years=="16") { echo " selected"; } ?>>16</option>
                       <option class="dropdown-item" value="17"<?php if(isset($years) && $years=="17") { echo " selected"; } ?>>17</option>
                       <option class="dropdown-item" value="18"<?php if(isset($years) && $years=="18") { echo " selected"; } ?>>18</option>
                       <option class="dropdown-item" value="19"<?php if(isset($years) && $years=="19") { echo " selected"; } ?>>19</option>
                       <option class="dropdown-item" value="20"<?php if(isset($years) && $years=="20") { echo " selected"; } ?>>20</option>
                   </select>
                   <span class="text-danger"><?php echo $validYears; ?></span>

               </div>


           </div>
           <hr>

           <fieldset class="form-group">
               <div class="form-group row">
                   <label for="name" class="col-sm-2 col-form-label">Name: </label>
                   <div class="col-sm-10">
                       <input type="text" class="form-control" name="name" id="name" placeholder="Full Name" value="<?php echo $name;?>">
                       <span class="text-danger"><?php echo $validName; ?></span>

                   </div>
               </div>
               <div class="form-group row">
                   <label for="postalCode" class="col-sm-2 col-form-label">Postal Code: </label>
                   <div class="col-sm-10">
                       <input type="text" class="form-control" name="postalCode" id="postalCode" placeholder="A1B2C3" value="<?php echo $postalCode;?>">
                       <span class="text-danger"><?php echo $validPostalCode; ?></span>

                   </div>
               </div>
               <div class="form-group row">
                   <label for="phone" class="col-sm-2 col-form-label">Phone Number: <br> (nnn-nnn-nnnn)</label>
                   <div class="col-sm-10">
                       <input type="text" class="form-control" name="phone" id="phone" placeholder="123-456-7890" value="<?php echo $phone;?>">
                       <span class="text-danger"><?php echo $validPhone; ?></span>

                   </div>
               </div>
               <div class="form-group row">
                   <label for="email" class="col-sm-2 col-form-label">Email Address: </label>
                   <div class="col-sm-10">
                       <input type="text" class="form-control" name="email" id="email" placeholder="yourname@email.com" value="<?php echo $email;?>">
                       <span class="text-danger"><?php echo $validEmail; ?></span>

                   </div>
               </div>


               <hr>


               <div class="form-group2">
                   <label class="control-label col-sm-2">Contact Method</label><br>

                   <div class="radio-inline">
                       <label>
                           <input type="radio" name="contactMethod" value="phone" <?php if (isset($_POST["contactMethod"]) && $_POST["contactMethod"]  == "phone" ) {echo 'checked="checked"';} ?>>Phone</label>
                   </div>
                   <div class="radio-inline">
                       <label>
                           <input type="radio" name="contactMethod" value="email" <?php if (isset($_POST["contactMethod"]) && $_POST["contactMethod"]  == "email" ) {echo 'checked="checked"';} ?>>Email</label>
                   </div>
               </div>
               <div class="form-group2">
                   <label class="control-label col-sm-2" for="phone">If phone is selected, when can we contact you?
                       (check all applicable)<br></label>

                   <div class="checkbox">
                       <label>
                           <input id="morning" type="checkbox" name="morning" value="morning"<?php if (isset($_POST["morning"])) {echo 'checked="checked"';} ?>/>Morning
                       </label>
                       <label>
                           <input id="afternoon" type="checkbox" name="afternoon" value="afternoon"<?php if (isset($_POST["afternoon"])) {echo 'checked="checked"';} ?>/>Afternoon
                       </label>
                       <label>
                           <input id="evening" type="checkbox" name="evening" value="evening"<?php if (isset($_POST["evening"])) {echo 'checked="checked"';} ?>/>Evening
                       </label>
                   </div>
                   <span class="text-danger"><?php echo $validContact; ?></span>
               </div>
               <div class="form-group row">
                   <input type="submit" name="btnSubmit" value="Calculate"/>
                   <span style="padding-left:3em"></span>
<!--                   <input type="submit" name="btnClear" value="Clear"/>-->
                   <input class="button is-warning is-fullwidth clearButton"
                          type="reset"
                          name="reset"
                          onclick="location.href='DepositCalculator.php'; " value="Reset">
               </div>

           </fieldset>
       </form>

       <?php
   }
   else
   {

       print <<<Mark
           <h1>Thank you, $name, for using our deposit calculator!</h1>
           <div align="center">

            <h4> $confirmationMessage </h4>
        
			<p>Following is the result of the calculation:</p>
					<table border="1">
						<tr><th>Year</th><th>Principal at Year Start</th><th>Interest for the Year</th></tr>
</div>

Mark;
       $runningPrincipal = $principal;
       for($i = 1; $i <= $years; ++$i)
       {
           $interest = $runningPrincipal * $rate * 0.01;
           printf ("<tr><td>%s</td><td>\$%.2f</td><td>\$%.2f</td></tr>", $i, $runningPrincipal, $interest);
           $runningPrincipal += $interest;
       }

       echo "</table>";


   }
    ?>

<!--    Bootstrap-->

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    <?php
    //functions here

    function ValidatePrincipal($principal) {
        $principal = trim($principal);
        if ( strlen($principal) == 0)
        {
            return "Principal Amount field can not be blank.<br/><br/>";
        }
        elseif ( !is_numeric($principal) )
        {
            return "Principal Amount must be a numeric number.<br/><br/>";
        }
        elseif ($principal <= 0)
        {
            return "Principal Amount must be greater than 0.<br/><br/>";
        }
        else
        {
            return "";
        }
    }


    function ValidateRate($rate) {
        $rate = trim($rate);

        if ( strlen($rate) == 0)
        {
            return "Interest Rate field can not be blank.<br/><br/>";
        }
        elseif ( !is_numeric($rate) )
        {
            return "Interest Rate must be a numeric number.<br/><br/>";
        }
        elseif ($rate < 0)
        {
            return "Interest Rate can not be negative.<br/><br/>";
        }
        else
        {
            return "";
        }
    }

    function ValidateYears($years) {
        $years = trim($years);


        if ( strlen($years) == 0 || !is_numeric($years) )
        {
            return "Must select number of years to deposit.<br/><br/>";
        }
        elseif ($years <= 0)
        {
            return "Number of years to deposit must be greater then 0.<br/><br/>";

        }
        elseif ($years > 20)
        {
            return "Number of years to deposit can not be greater then 20.<br/><br/>";

        }
        else
        {
            return "";
        }
    }

    function ValidateName($name) {
        $name = trim($name);

        if ( strlen($name) == 0)
        {
            return "Name field can not be blank.<br/><br/>";
        }
        else
        {
            return "";
        }
    }

    function ValidatePostalCode($postalCode) {
        $postalCode = trim($postalCode);

        $postalCodeRegex = "/[a-z][0-9][a-z]\s*[0-9][a-z][0-9]/i";

        //do I need $matches here at all?
        if (preg_match($postalCodeRegex, $postalCode, $matches))
        {
            return "";
        }
        else
        {
            return "Invalid post code! <br/><br/>";
        }

    }

    function ValidatePhone($phone) {
        $phone = trim($phone);

        $phoneRegex = "/^([1]-)?[2-9]{1}[0-9]{2}-[0-9]{3}-[0-9]{4}$/i";
        if (preg_match($phoneRegex, $phone, $matches))
        {
            return "";

        }
        else
        {
            return "Phone Number has been entered incorrectly!<br/><br/>";
        }

    }

    function ValidateEmail($email) {
        $email = trim($email);

        $emailRegex = "\"^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-zA-Z]{2,4})$\"";

        if (preg_match($emailRegex, $email))
        {
            return "";
        }
        else
        {
            return "Your email has been entered incorrectly!<br/><br/>";
        }
    }

    function ValidateContact()
    {
        //        $contactMethod = ($_POST["contactMethod"]);

        if (!isset($_POST["contactMethod"]))
        {
            return"You have not selected a contact method";
        }

        elseif (isset($_POST["contactMethod"]) && ($_POST["contactMethod"]) == "phone" and !isset($_POST["morning"]) && !isset($_POST["afternoon"]) && !isset($_POST["evening"]))
        {
            return "If you select phone, you must select a time to call!";
        }
        else
        {
            return "";
        }

    }

//    is there a more elegant way to do this?

    function ConfirmationMessage($phone, $email)
    {
        if (isset($_POST["contactMethod"]) && ($_POST["contactMethod"]) == "phone" && (isset($_POST["morning"])) && !isset($_POST["afternoon"]) && !isset($_POST["evening"]))
        {
            return "Our customer service representative will call you tomorrow morning at $phone";
        }
        elseif (isset($_POST["contactMethod"]) && ($_POST["contactMethod"]) == "phone" && (!isset($_POST["morning"])) && isset($_POST["afternoon"]) && !isset($_POST["evening"]))
        {
            return "Our customer service representative will call you tomorrow afternoon at $phone";
        }
        elseif (isset($_POST["contactMethod"]) && ($_POST["contactMethod"]) == "phone" && (!isset($_POST["morning"])) && !isset($_POST["afternoon"]) && isset($_POST["evening"]))
        {
            return "Our customer service representative will call you tomorrow night at $phone";
        }
        elseif (isset($_POST["contactMethod"]) && ($_POST["contactMethod"]) == "phone" && (isset($_POST["morning"])) && isset($_POST["afternoon"]) && !isset($_POST["evening"]))
        {
            return "Our customer service representative will call you tomorrow morning or afternoon at $phone";
        }
        elseif (isset($_POST["contactMethod"]) && ($_POST["contactMethod"]) == "phone" && (isset($_POST["morning"])) && !isset($_POST["afternoon"]) && isset($_POST["evening"]))
        {
            return "Our customer service representative will call you tomorrow morning or evening at $phone";
        }
        elseif (isset($_POST["contactMethod"]) && ($_POST["contactMethod"]) == "phone" && (!isset($_POST["morning"])) && isset($_POST["afternoon"]) && isset($_POST["evening"]))
        {
            return "Our customer service representative will call you tomorrow afternoon or evening at $phone";
        }
        elseif (isset($_POST["contactMethod"]) && ($_POST["contactMethod"]) == "phone" && isset($_POST["morning"]) && isset($_POST["afternoon"]) && isset($_POST["evening"]))
        {
            return "Our customer service representative will call you tomorrow morning, afternoon, or evening at $phone";
        }
        elseif (isset($_POST["contactMethod"]) && ($_POST["contactMethod"]) == "email")
        {
            return "Our customer service representative will email you tomorrow at $email";
        }
    }


    function ValidateForm($validPrincipal, $validRate, $validYears, $validName, $validPostalCode, $validPhone, $validEmail, $validContact)
    {
        if ($validPrincipal == "" && $validRate == "" && $validYears == "" && $validName == "" && $validPostalCode == "" && $validPhone == "" && $validEmail == "" && $validContact == "")
        {
            $valid = 1;
            return $valid;
        }
        else
        {
            $valid = 0;
            return $valid;
        }
    }

    ?>
    </body>
</html>
