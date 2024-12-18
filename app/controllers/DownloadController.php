<?php
require_once __DIR__ . '/../models/Upload.php';

class DownloadController {
    public function render($id) {
        $uploadModel = new Upload();
        $file = $uploadModel->getById($id);

        if (!$file) {
            die('File not found.');
        }

        include __DIR__ . '/../views/download.php';
    }

    public function download($id) {
        $uploadModel = new Upload();
        $file = $uploadModel->getById($id);

        if (!$file) {
            die('File not found.');
        }

        // Проверяем, файл или URL
        if ($file['file_type'] === 'file') {
            $filePath = __DIR__ . '/../../public' . $file['file_path'];
            if (!file_exists($filePath)) {
                die('File not found on server.');
            }

            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');
            readfile($filePath);
        } elseif ($file['file_type'] === 'url') {
            header('Location: ' . $file['file_url']);
        } else {
            die('Invalid file type.');
        }
    }
}