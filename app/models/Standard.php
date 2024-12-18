<?php
require_once __DIR__ . '/BaseModel.php';

class Standard extends BaseModel {
    protected function getTableName() {
        return 'standards';
    }

    public function getColumns() {
        return ['id', 'name'];
    }
}