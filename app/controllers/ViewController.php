<?php
require_once __DIR__ . '/../models/Upload.php';
require_once __DIR__ . '/../models/Subject.php';
require_once __DIR__ . '/../models/Standard.php';
require_once __DIR__ . '/../models/Subtopic.php';
require_once __DIR__ . '/../models/ResourceType.php';

class ViewController
{
    public function getDropdownData()
    {
        $db = Database::getConnection();

        $tables = ['subjects', 'subtopics', 'standards', 'resource_types'];
        $result = [];

        foreach ($tables as $table) {
            $query = "SELECT id, name FROM $table";
            $stmt = $db->prepare($query);
            $stmt->execute();
            $data = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            $result[$table] = $data;
        }

        header('Content-Type: application/json');
        echo json_encode($result);
    }

    public function render($filters = [])
    {
        $uploadModel = new Upload();
        $data = $uploadModel->getAll($filters);

        $subjects = (new Subject())->getAll();
        $subtopics = (new Subtopic())->getAll(['subject_id' => $filters['subject'] ?? null]);
        $standards = (new Standard())->getAll(['subtopic_id' => $filters['subtopic'] ?? null]);
        $resource_types = (new ResourceType())->getAll();

        include __DIR__ . '/../views/view.php';
    }

}