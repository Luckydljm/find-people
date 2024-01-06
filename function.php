<?php
ob_start();
error_reporting(0);
$page = $_GET['pages'];

// Dashboard
if ($page=='dashboard'){
	include "dashboard.php";
}
// Profile
elseif ($page=='profile'){
    include "pages/profile/profile.php";
}
// Summary
elseif ($page=='summary'){
    include "pages/summary/summary.php";
}
// Institution
elseif ($page=='institution'){
    include "pages/institution/institution.php";
}
else{
    include "pages-error-404.php";
}
?>