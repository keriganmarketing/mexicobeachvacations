
<?php
$unitId = isset($_GET['unit_id']) && $_GET['unit_id'] !== '' ? $_GET['unit_id'] : null;

bladerunner('views.pages.book', ['unitId' => $unitId]);
