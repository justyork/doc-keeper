<?php

require_once __DIR__ . '/../helpers/Auth.php';
require_once __DIR__ . '/../models/Upload.php';
require_once __DIR__ . '/../models/Subject.php';
require_once __DIR__ . '/../models/Standard.php';
require_once __DIR__ . '/../models/Subtopic.php';
require_once __DIR__ . '/../models/ResourceType.php';

class AdminController
{
    public function delete($id)
    {
        Auth::check();

        $uploadModel = new Upload();
        $uploadModel->delete($id);

        header('Location: /admin');
        exit;
    }

    public function showAll()
    {
        Auth::check();

        $uploadModel = new Upload();
        $data = $uploadModel->getAll();

        include __DIR__ . '/../views/admin.php';
    }

    public function edit($id)
    {
        Auth::check();

        $uploadModel = new Upload();
        $file = $uploadModel->getById($id);

        $subjects = (new Subject())->getAll();
        $subtopics = (new Subtopic())->getAll();
        $standards = (new Standard())->getAll();
        $resource_types = (new ResourceType())->getAll();

        include __DIR__ . '/../views/edit.php';
    }

    public function update($id, $data)
    {
        Auth::check();

        $uploadModel = new Upload();
        $uploadModel->update($id, $data);

        header('Location: /admin');
        exit;
    }
}