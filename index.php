<!doctype html>
<html>
	<head>
    	<title>Web App Hub</title>
        <link rel="stylesheet" href="css/style.css"/>
    </head>

    <body>
		<div id="temp_screen">
			<?php
			include("include/function.php");
			include("include/header.php");
			include("include/navbar.php");
			include("include/bodyleft.php");
			include("include/bodyright.php");
			include("include/footer.php");
			echo add_cart();
			echo u_signup();
			?>
		</div><!--end of temp_screen-->
    </body>

</html>
