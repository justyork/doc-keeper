<?php
require_once __DIR__ . '/BaseModel.php';

class Subtopic extends BaseModel {
    protected function getTableName() {
        return 'subtopics';
    }

    public function getColumns() {
        return ['id', 'name'];
    }
}