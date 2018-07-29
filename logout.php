<?php
ob_start();
session_start();
session_reset();
session_unset();
ob_end_flush();
header("Location: index.php");