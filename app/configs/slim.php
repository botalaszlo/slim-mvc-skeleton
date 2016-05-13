<?php

/**
 * This file is part of the Slim Skeleton application.
 */

$mode = ENV === 'DEV' ? 'development' : 'production';

return array(
    'mode' => $mode,
    'debug' => ENV === 'DEV',
    'displayErrorDetails' => true,
);
