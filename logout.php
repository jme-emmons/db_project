<?php
session_start();
session_destroy();
header("Location: http://www.cs.virginia.edu/~jme3tp/db_project/sign_in.html");
?>