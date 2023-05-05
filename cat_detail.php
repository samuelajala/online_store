<!doctype html>
<html>
	<head>
    	<title>Web App Hub</title>
        <link rel="stylesheet" href="css/style.css"/>
    </head>

    <body>
			<?php
			include("include/function.php");
			include("include/header.php");
			include("include/navbar.php");
			echo "<div id='bodyleft'><ul>"; cat_detail(); sub_cat_detail(); high_card(); medium_card(); low_card(); all_about_high(); all_about_medium(); all_about_low(); echo"</ul></div>";
			if(isset($_GET['cat_id']) or isset($_GET['sub_cat_id'])){
				echo "<div class='bodyright' id='bodyright'>
							<ul>"; viewall_sub_cat(); viewall_cat(); echo"</ul>
						</div><br clear='all' />";
			}else{
				include("include/bodyright.php");
			}
			include("include/footer.php");
			?>
    </body>

</html>
