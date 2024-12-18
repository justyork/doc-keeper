<?php

require_once __DIR__ . '/CrudController.php';
require_once __DIR__ . '/../models/Standard.php';

class StandardController extends CrudController {
    public function __construct() {
        parent::__construct('Standard', 'standards');
    }
}