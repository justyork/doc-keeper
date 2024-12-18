<?php
require_once __DIR__ . '/BaseModel.php';
class Subject extends BaseModel {
    protected function getTableName() {
        return 'subjects';
    }

    public function getColumns() {
        return ['id', 'name'];
    }
}