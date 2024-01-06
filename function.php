<?php
ob_start();
error_reporting(0);
$page = $_GET['pages'];

// Dashboard
if ($page=='dashboard'){
	include "dashboard.php";
}
// Report
elseif ($page=='report'){
    include "pages/report/report.php";
}
elseif ($page=='make-report'){
    include "pages/report/make-report.php";
}
else{
    include "pages-error-404.php";
}
?>