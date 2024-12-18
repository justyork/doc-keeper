<?php

require_once __DIR__ . '/../helpers/Validator.php';
require_once __DIR__ . '/../models/Upload.php';
require_once __DIR__ . '/../models/Subject.php';
require_once __DIR__ . '/../models/Standard.php';
require_once __DIR__ . '/../models/Subtopic.php';
require_once __DIR__ . '/../models/ResourceType.php';

class UploadController {
    public function handleUpload(): void {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $recaptchaSecret = '6LcUrJ8qAAAAAJyaQulVX5fwYmJ7RoKvvINzOdlo'; //getenv("RECAPTCHA_SECRET");

            $response = $_POST['g-recaptcha-response'];
            $remoteIp = $_SERVER['REMOTE_ADDR'];

            $verify = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$recaptchaSecret}&response={$response}&remoteip={$remoteIp}");

            $captchaSuccess = json_decode($verify);

//            if (!$captchaSuccess->success) {
//                die('reCAPTCHA validation failed. Please try again.');
//            }

            $data = [
                'title' => $_POST['title'] ?? '',
                'description' => $_POST['description'] ?? '',
                'author' => $_POST['author'] ?? '',
                'subject' => $_POST['subject'] ?? '',
                'subtopic' => $_POST['subtopic'] ?? '',
                'standard' => $_POST['standard'] ?? '',
                'resource_type' => $_POST['resource_type'] ?? '',
                'file' => $_FILES['file'] ?? null,
                'file_url' => $_POST['file_url'] ?? null,
            ];

            // Валидация данных
            $errors = Validator::validateUpload($data);
            if ($errors) {
                include __DIR__ . '/../views/upload.php';
                return;
            }

            // Сохранение данных
            try {
                $upload = new Upload();
                $upload->save($data);
                header('Location: /view');
                exit;
            } catch (Exception $e) {
                $errors[] = "Failed to save the data: " . $e->getMessage();
                include __DIR__ . '/../views/upload.php';
                return;
            }
        }
    }

    public function render(array $filters = []): void {
        try {
            $uploadModel = new Upload();
            $data = [
                'subjects' => (new Subject())->getAll(),
                'subtopics' => (new Subtopic())->getAll(),
                'standards' => (new Standard())->getAll(),
                'resource_types' => (new ResourceType())->getAll(),
            ];
            include __DIR__ . '/../views/upload.php';
        } catch (Exception $e) {
            echo "Error rendering page: " . htmlspecialchars($e->getMessage());
        }
    }
}