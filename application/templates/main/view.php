<html>
	<head>
		<title>
		<?// for example
		if( !empty($PAGE_TITLE) )
			echo $PAGE_TITLE;
		else
			echo "Main";
		?>
		</title>
	</head>
	<body>
		<div class="box">
		Template<br>
			<?
			if(file_exists("application/views/".$content_view.".php"))
				include "application/views/".$content_view.".php";
			?>
		</div>
	</body>
</html>