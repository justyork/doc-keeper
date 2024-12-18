<?php

require_once __DIR__ . '/../helpers/Auth.php';

abstract class CrudController {
    protected $model;
    protected $modelName;
    protected $templatePath = 'crud';
    protected $viewPath;

    public function __construct($model, $viewPath) {
        $this->modelName = $model;
        $this->model = new $model();
        $this->viewPath = $viewPath;
    }

    public function index() {
        Auth::check();

        $title = $this->modelName;
        $items = $this->model->getAll();
        $columns = $this->model->getColumns();
        $viewPath = $this->viewPath;
        include __DIR__ . '/../views/' . $this->templatePath . '/index.php';
    }

    public function create() {
        Auth::check();

        $title = $this->modelName;
        $fields = $this->model->getColumns();
        $viewPath = $this->viewPath;
        include __DIR__ . '/../views/' . $this->templatePath . '/create.php';
    }

    public function store($data) {
        Auth::check();

        $this->model->save($data);
        header('Location: /' . $this->viewPath);
        exit;
    }

    public function edit($id) {
        Auth::check();

        $title = $this->modelName;
        $item = $this->model->getById($id);
        $fields = $this->model->getColumns();
        $viewPath = $this->viewPath;
        include __DIR__ . '/../views/' . $this->templatePath . '/edit.php';
    }

    public function update($id, $data) {
        Auth::check();

        $this->model->update($id, $data);
        header('Location: /' . $this->viewPath);
        exit;
    }

    public function delete($id) {
        Auth::check();

        $this->model->delete($id);
        header('Location: /' . $this->viewPath);
        exit;
    }
}