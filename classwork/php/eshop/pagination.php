<?php

echo "<ul class='pagination'>";

if ($page > 1) {
    $output = '';
    
    $output .= "<li class='page-item'>";
        $output .= "<a href='#' class='page-link' title='Go to first page'>First</a>";
    $output .= "</li>";
    
    
    echo $output;
}

$totalPagesNum = ceil($totalItems / $itemsPerPage);

// TODO: check calculation logic - being in 1 or 2 page next 3 in front not visible
$rangeLimit = 3;

$initNum = $page - $rangeLimit;
$conditionNum = ($page + $initNum) + 2;

    for ( $i = $initNum; $i < $conditionNum; $i++) {
        
        if (($i > 0) && ($i <= $totalPagesNum)) {
            
            // puslapi, kuriame dabar esame paryskinti - uzdeti klase active
            if ($i == $page) {
                echo "<li class='page-item active'><a href='#' class='page-link'>{$i}</a></li>";
            } else {
                echo "<li class='page-item'><a href='{$pageUrl}page={$i}' class='page-link'>{$i}</a></li>";
            }
        }
        
    }

if ($page < $totalPagesNum) {
    echo "<li class='page-item'><a href='{$pageUrl}page={$totalPagesNum}' class='page-link'>Last</a></li>";
    
}

echo "</ul>";