<?php
header("Content-disposition: attachment; filename=Manual.pdf");
header("Content-type: application/pdf");
readfile("Manual.pdf");
?>