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

        $config = include __DIR__ . '/../../config/config.php';
        $allowedExtensions = array_map(fn($el) => '.' . $el, $config['allowed_extensions']);

        $uploadModel = new Upload();
        $file = $uploadModel->getById($id);

        $subjects = (new Subject())->getAll();
        $subtopics = (new Subtopic())->getAll(['subject_id' => $file['subject']]);
        $standards = (new Standard())->getAll(['subtopic_id' => $file['subtopic']]);
        $resource_types = (new ResourceType())->getAll();

        include __DIR__ . '/../views/edit.php';
    }

    public function update($id)
    {
        Auth::check();

        $data = [
            'title' => $_POST['title'] ?? '',
            'email' => $_POST['email'] ?? '',
            'description' => $_POST['description'] ?? '',
            'author' => $_POST['author'] ?? '',
            'subject' => $_POST['subject'] ?? '',
            'subtopic' => $_POST['subtopic'] ?? '',
            'standard' => $_POST['standard'] ?? '',
            'resource_type' => $_POST['resource_type'] ?? '',
            'file' => $_FILES['file'] ?? null,
            'file_url' => $_POST['file_url'] ?? null,
        ];

        $uploadModel = new Upload();
        $uploadModel->update($id, $data);

        header('Location: /admin');
        exit;
    }
}