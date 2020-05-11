<?php

echo "<ul class='pagination'>";

if ($page > 1) {
    $output = '';

    $output .= "<li>";
        $output .= "<a href='#' title='Go to first page'>First</a>";
    $output .= "</li>";


    echo $output;
}

$totalPagesNum = ceil($totalItems / $itemsPerPage);

$rangeLimit = 3;

$initNum = $page - $rangeLimit;
$conditionNum = ($page + $initNum) + 1;

    for ( $i = $initNum; $i < $conditionNum; $i++) {

        if (($i > 0) && ($i <= $totalPagesNum)) {

            // puslapi, kuriame dabar esame paryskinti - uzdeti klase active
            if () {
                echo "<li class='page-item'><a href='#'>{$i}</a></li>";
            } else {

            }
        }

    }


echo "</ul>";
