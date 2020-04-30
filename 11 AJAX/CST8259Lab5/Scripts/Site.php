<?php
//Receive and process the ajax calls from Site.js

$ajax_var = $_GET['fetch']; 

switch ($ajax_var) {
    case "names":
        get_names();
        break;
    case "restaurant":
        $selected_restaurant = $_GET['restaurant_name'];
        get_restaurant($selected_restaurant);
        break;
    case "update":
        $restaurant_details = $_GET['restaurant_object'];
        update_xml($restaurant_details);
        break;
}


function get_names(){
    $restaurant_reviews = simplexml_load_file('../Data/restaurant_reviews.xml'); 
    $restaurant_array= [];

    foreach ($restaurant_reviews->restaurant as $restaurant){
            
            $name = $restaurant->name->__toString();
            array_push($restaurant_array, $name);            
    }
    echo json_encode($restaurant_array);
}


function get_restaurant($selected_restaurant){ 
    $restaurant_reviews = simplexml_load_file('../Data/restaurant_reviews.xml'); 

    //create array of restaurant value => name
    $restaurant_array= [];
    
    foreach ($restaurant_reviews->restaurant as $restaurant){
            $name = $restaurant->name->__toString();
            if ($name === $selected_restaurant){
                $individual_restaurant = array(
                    $name => array(
                        "name" => $name,
                        "streetAddress" => $restaurant->location->street->__toString(),
                        "city" => $restaurant->location->city->__toString(),
                        "provinceState" => $restaurant->location->provstate->__toString(),
                        "postalZipCode" => $restaurant->location->postalzipcode->__toString(),
                        "summary" => $restaurant->summary->__toString(),
                        "rating" => $restaurant->rating->__toString(),
                ));

                array_push($restaurant_array, $individual_restaurant);
            }
    }

    echo json_encode($individual_restaurant);
}

function update_xml($restaurant_details){
    $xml_array = [];
    $restaurant_reviews = simplexml_load_file('../Data/restaurant_reviews.xml'); 
    $name = $restaurant_details["name"];

     foreach($restaurant_reviews->restaurant as $restaurant){
            if ($restaurant->name == $name){

                $restaurant->location->street = $restaurant_details["streetAddress"];
                $restaurant->location->city = $restaurant_details["city"];
                $restaurant->location->provstate = $restaurant_details["provinceState"];
                $restaurant->location->postalzipcode = $restaurant_details["postalZipCode"];
                $restaurant->summary = $restaurant_details["summary"];
                $restaurant->rating = $restaurant_details["rating"];
            
                $restaurant_reviews->asXML('../Data/restaurant_reviews.xml');

            }
        }
    echo "Successfully updated data for ".$name. "!";
}




function create_json (){ 
    $restaurant_reviews = simplexml_load_file('../Data/restaurant_reviews.xml'); 

    //create array of restaurant value => name
    $restaurant_array= [];
    
    foreach ($restaurant_reviews->restaurant as $restaurant){
            
            $name = $restaurant->name->__toString();

            $individual_restaurant = array(
                $name => array(
                    "name" => $name,
                    "streetAddress" => $restaurant->location->street->__toString(),
                    "city" => $restaurant->location->city->__toString(),
                    "provinceState" => $restaurant->location->provstate->__toString(),
                    "postalZipCode" => $restaurant->location->postalzipcode->__toString(),
                    "summary" => $restaurant->summary->__toString(),
                    "rating" => $restaurant->rating->__toString(),
            ));

            array_push($restaurant_array, $individual_restaurant);
        }

    echo json_encode($restaurant_array);

    $json_file = fopen('restaurant_reviews.json', 'w');
    fwrite($json_file, json_encode($restaurant_array));
    fclose($json_file);
}


?>