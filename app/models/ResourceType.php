<?php
require_once __DIR__ . '/BaseModel.php';

class ResourceType extends BaseModel {
    protected function getTableName() {
        return 'resource_types';
    }

    public function getColumns() {
        return ['id', 'name'];
    }
}