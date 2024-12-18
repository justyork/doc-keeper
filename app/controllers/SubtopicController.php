<?php

require_once __DIR__ . '/CrudController.php';
require_once __DIR__ . '/../models/Subtopic.php';

class SubtopicController extends CrudController {
    public function __construct() {
        parent::__construct('Subtopic', 'subtopics');
    }
}