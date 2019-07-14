<div id="code">
	<div id="code-st"><?php
		session_start();
		if(session_destroy())
		{
			header("Location:  index.php");
		}
		?></div>
	</div>