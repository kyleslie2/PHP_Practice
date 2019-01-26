<?php
include "functions.php";

$imageFilePath = "images/076.jpg";

if (isset($_GET['btnRight_x'])) 
{
	rotateImage($imageFilePath, -90);
        header("location: RotateImage.php");
}
else if (isset($_GET['btnLeft_x']))
{
	rotateImage($imageFilePath, 90);
        header("location: RotateImage.php");
}
?>

<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
    <title>Upload File</title>
	<link rel = "stylesheet" type = "text/css" href = "styles.css" />
</head>
<body> 
	<div class="centered">
		<img src="<?php echo $imageFilePath."?rnd=".rand();?>" />
		<br/>
		<br/>
		<form action="RotateImage.php" method="get">
			<input type="image" name="btnLeft" src="leftRotate.jpg" width="40" height="40" value="left"/>
			&nbsp; &nbsp; &nbsp;<input type="image" name="btnRight" src="RightRotate.jpg" width="40" height="40" value="right"/>
		</form> 
   </div>

</body>
</html>
