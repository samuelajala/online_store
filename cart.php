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

			?>
			<div class="cart">
				<form method="post" enctype="multipart/form-data">
						<?php echo cart_display(); ?>
					</table>
				</form>
			</div>
		<?php include("include/footer.php"); ?>
		</div><!--end of temp_screen-->
    </body>

</html>
