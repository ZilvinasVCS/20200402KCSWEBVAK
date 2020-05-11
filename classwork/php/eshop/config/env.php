<?php

// default settings
// TODO: move settings to config/env.php file

$page = isset($_GET['page']) ? $_GET['page'] : 1;

$itemsPerPage = 3;
// example. 20 items. we are in 3 page.
$fromNumCalc = ($itemsPerPage * $page) - $itemsPerPage;
