<?php

require_once __DIR__ . '/CrudController.php';
require_once __DIR__ . '/../models/Subject.php';

class SubjectController extends CrudController {
    public function __construct() {
        parent::__construct('Subject', 'subjects');
    }
}