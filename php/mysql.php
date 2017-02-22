<?php
// sanitize input
function clean_input($db, $input)
{
	return trim(mysqli_real_escape_string($db, $input));
}
?>