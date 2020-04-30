<?php
//Add your code here to open the XML file and retrieve the data for the selected restaurant
include "./Common/Header.php";
include "./Common/Functions.php";

$restaurant_reviews = getRestaurantXML();
$xml_array = [];
$confirmation = null;

//create array of restaurant value => name
$index=0;
$restaurant_array= [];
foreach ($restaurant_reviews->restaurant as $restaurant){
    $name = $restaurant->name->__toString();
    $restaurant_array[$index]=$name;
    $index++;	
}

if (isset($_POST['drpRestaurant'])){
    $selected_value = $_POST['drpRestaurant'];
    print($selected_value);

    if (isset($_POST['btnSave'])){
        print('THE SAVE BUTTON WAS PUSHED');
        $confirmation = "Success! Your changes have been saved! Good work :D";
        foreach($restaurant_reviews->restaurant as $restaurant){
            array_push($xml_array, $restaurant);
        }
        // var_dump($xml_array);
        // var_dump($selected_value);
        // var_dump($xml_array[$selected_value]);
   
        $xml_array[$selected_value]->location->street = $_POST['txtStreetAddress'];
        $xml_array[$selected_value]->location->city = $_POST['txtCity'];
        $xml_array[$selected_value]->location->provstate = $_POST['txtProvinceState'];
        $xml_array[$selected_value]->location->postalzipcode = $_POST['txtPostalZipCode'];
        $xml_array[$selected_value]->summary = $_POST['txtSummary'];
        $xml_array[$selected_value]->rating = $_POST['drpRating'];
        // $restaurant_reviews->asXML('restaurant_reviews.xml');
        $restaurant_reviews->asXML('restaurant_reviews.xml');
    }
}
?>
<div class="container"> 
     <div class="row vertical-margin">
        <div class="col-md-10 text-center"><h1>Online Restaurant Review</h1></div>
    </div>
    <form action="RestaurantReviews.php" method="post" id="restaurant-review-form">
        <div class="row vertical-margin">
            <div class="col-md-2"><label>Restaurant:</label></div>
            <div class="col-md-6">
                <select name="drpRestaurant" id="drpRestaurant" class="form-control" onchange="onRestaurantChanged();">
                    <option value="-1">Select ... </option>

                    <?php 
                    //Add your code here to display restaurant names
                    $i=0;
                    foreach ($restaurant_reviews->restaurant as $restaurant){
                        $name = $restaurant->name;
                        ?>
                        <option value="<?php echo $i;?>" <?php echo ($selected_value ==  $i) ? ' selected="selected"' : '';?>><?php echo $name;?></option>
                        
                        <?php
                        $i++;	
                    }
                    ?>

                </select>
            </div>
        </div>
        <div id="restaurant-info" >

	    <!-- Modify the HTML controls below to display the selected restaurant data -->
        <?php

//open it again since saving?
$restaurant_reviews = getRestaurantXML();
$txtStreetAddress = $txtCity = $txtProvinceState = $txtPostalZipCode = $txtSummary = $rating = null;

if (isset($_POST['drpRestaurant'])){
    // print($_POST['drpRestaurant']);
    $selected_value = $_POST['drpRestaurant'];
   
    foreach ($restaurant_reviews->restaurant as $restaurant){
        $name = $restaurant->name->__toString();

        if ($name == $restaurant_array[$selected_value]){
            $location = $restaurant->location;
            $txtStreetAddress = $location->street;
            $txtCity = $location->city;
            $txtProvinceState = $location->provstate;
            $txtPostalZipCode = $location->postalzipcode;
            $txtSummary = $restaurant->summary;
            $rating = $restaurant->rating;
        }
    }
}
        ?>
            
	    <div class="row vertical-margin">
                <div class="col-md-2"><label>Street Address:</label></div>
                <div class="col-md-6">
                    <input type="text" class="form-control"  style="width : 100%" name="txtStreetAddress"  value="<?php echo $txtStreetAddress ?>"/>
                </div>
            </div>
             <div class="row vertical-margin">
                <div class="col-md-2"><label>City:</label></div>
                <div class="col-md-6">
                    <input type="text" class="form-control" style="width : 100%" name="txtCity" value="<?php echo $txtCity ?>" />
                </div>
            </div>
             <div class="row vertical-margin">
                <div class="col-md-2"><label>Province/State:</label></div>
                <div class="col-md-6">
                    <input type="text" class="form-control"  style="width : 100%" name="txtProvinceState"  value="<?php echo $txtProvinceState ?>" />
                </div>
            </div>
            <div class="row vertical-margin">
                <div class="col-md-2"><label>Postal/Zip Code:</label></div>
                <div class="col-md-6">
                    <input type="text" class="form-control"  style="width : 100%" name="txtPostalZipCode"  value="<?php echo $txtPostalZipCode ?>" />
                </div>
            </div>
            <div class="row vertical-margin">
                <div class="col-md-2"><label>Summary:</label></div>
                <div class="col-md-6">
                    <textarea class="form-control" rows="6" style="width : 100%" name="txtSummary" ><?php echo $txtSummary ?></textarea> 
                </div>
            </div>
            <div class="row vertical-margin">
                <div class="col-md-2"><label>Rating:</label></div>
                <div class="col-md-6">
                    <select name="drpRating" class="form-control">
                        <option value ="" >Not rated</option>

                        <?php 
                           //Add your code here to display the rating of the selected restaurant 
                        for($r=1; $r<=5; $r++)
                        {
                            ?>
                            <option value="<?php echo $r;?>" <?php echo ($rating ==  $r) ? ' selected="selected"' : '';?>><?php echo $r;?></option>
                        <?php
                        }
                        ?>

                    </select>
                </div>
            </div>
            <div class="row vertical-margin">
                <div class="col-md-10 col-md-offset-2">
                    <input type='submit'  class="btn btn-primary btn-min-width" name='btnSave' value='Save Changes' />
                </div>
            </div>
            <div class="row" style="display: <?php print ($confirmation ?  'block' :'none' )?>" >
                <div class="col-md-8"><Label ID="lblConfirmation" class="form-control alert-success">
                    <?php print $confirmation ?></Label>
                </div>
            </div>
        </div>
    </form>
</div>
<br/>
<?php include "./Common/Footer.php"; ?>