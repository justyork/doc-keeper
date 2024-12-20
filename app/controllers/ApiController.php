<?php

require_once __DIR__ . '/../helpers/Auth.php';
require_once __DIR__ . '/../models/Upload.php';
require_once __DIR__ . '/../models/Subject.php';
require_once __DIR__ . '/../models/Standard.php';
require_once __DIR__ . '/../models/Subtopic.php';
require_once __DIR__ . '/../models/ResourceType.php';

class ApiController
{

    public function subtopics(int $id)
    {
        $data = (new Subtopic())->getAll(['subject_id' => $id]);
        echo json_encode($data);
    }

    public function standards(int $id)
    {
        $data = (new Standard())->getAll(['subtopic_id' => $id]);
        echo json_encode($data);
    }
}