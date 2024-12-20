<?php

require_once __DIR__ . '/CrudController.php';
require_once __DIR__ . '/../models/ResourceType.php';

class ResourceTypeController extends CrudController
{
    public function __construct()
    {
        parent::__construct('ResourceType', 'resource-types');
    }
}