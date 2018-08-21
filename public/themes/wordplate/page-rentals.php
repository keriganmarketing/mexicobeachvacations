<?php

use KeriganSolutions\Search\Search;

$units = Search::getUnits($_GET);

bladerunner('views.pages.rentals',[
    'units' => $units,
]);
