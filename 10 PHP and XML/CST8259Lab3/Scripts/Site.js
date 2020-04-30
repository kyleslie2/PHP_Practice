function onRestaurantChanged( )
{  
     
    if (showRestaurantInfo())
    {   var reviewForm = document.getElementById('restaurant-review-form');
        reviewForm.submit();
    } 
}

function showRestaurantInfo()
{
    var selectedRestaurant = document.getElementById('drpRestaurant').value;
    if (selectedRestaurant === "-1")
    {
        document.getElementById('restaurant-info').style.display = 'none';
        return false; 
    }
    else
    {
         document.getElementById('restaurant-info').style.display = 'block';
         return true;
    }
}
