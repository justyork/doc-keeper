<?php

class Upload {
    private $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function save($data) {
        $stmt = $this->db->prepare("
            INSERT INTO uploads (title, description, author, subject, subtopic, standard, resource_type, file_path, file_url, file_type)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
        ");
        if (!$stmt) {
            throw new Exception("Failed to prepare statement: " . $this->db->error);
        }

        if ($data['file'] && !$data['file']['full_path']) {
            $data['file'] = null;
        }

        $fileType = $data['file'] ? 'file' : 'url';
        $filePath = $data['file'] ? $this->handleFileUpload($data['file']) : $data['file_url'];

        $stmt->bind_param(
            'sssiiissss',
            $data['title'], $data['description'], $data['author'],
            $data['subject'], $data['subtopic'], $data['standard'],
            $data['resource_type'], $filePath, $data['file_url'], $fileType
        );

        if (!$stmt->execute()) {
            throw new Exception("Failed to execute statement: " . $stmt->error);
        }
    }

    public function getAll($filters = []) {
        $sql = "SELECT uploads.*, subjects.name as subject_name, subtopics.name as subtopic_name, standards.name as standard_name, resource_types.name as resource_type_name
            FROM uploads
            LEFT JOIN subjects ON uploads.subject = subjects.id
            LEFT JOIN subtopics ON uploads.subtopic = subtopics.id
            LEFT JOIN standards ON uploads.standard = standards.id
            LEFT JOIN resource_types ON uploads.resource_type = resource_types.id";
        $params = [];
        $types = '';
        $conditions = [];

        if (!empty($filters['subject'])) {
            $conditions[] = 'uploads.subject = ?';
            $params[] = $filters['subject'];
            $types .= 'i';
        }
        if (!empty($filters['subtopic'])) {
            $conditions[] = 'uploads.subtopic = ?';
            $params[] = $filters['subtopic'];
            $types .= 'i';
        }
        if (!empty($filters['standard'])) {
            $conditions[] = 'uploads.standard = ?';
            $params[] = $filters['standard'];
            $types .= 'i';
        }
        if (!empty($filters['resource_type'])) {
            $conditions[] = 'uploads.resource_type = ?';
            $params[] = $filters['resource_type'];
            $types .= 'i';
        }

        if ($conditions) {
            $sql .= ' WHERE ' . implode(' AND ', $conditions);
        }

        $stmt = $this->db->prepare($sql);
        if (!$stmt) {
            throw new Exception("Failed to prepare statement: " . $this->db->error);
        }

        if ($params) {
            $stmt->bind_param($types, ...$params);
        }

        if (!$stmt->execute()) {
            throw new Exception("Failed to execute statement: " . $stmt->error);
        }

        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM uploads WHERE id = ?");
        if (!$stmt) {
            throw new Exception("Failed to prepare statement: " . $this->db->error);
        }

        $stmt->bind_param('i', $id);
        if (!$stmt->execute()) {
            throw new Exception("Failed to execute delete statement: " . $stmt->error);
        }

        if ($stmt->affected_rows === 0) {
            throw new Exception("No rows were deleted.");
        }
    }

    private function handleFileUpload($file) {
        $config = include __DIR__ . '/../../config/config.php';
        $allowedExtensions = $config['allowed_extensions'];

        $fileExt = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        if (!in_array($fileExt, $allowedExtensions)) {
            throw new Exception("Invalid file extension: $fileExt");
        }

        if ($file['size'] > 3 * 1024 * 1024) {
            throw new Exception("File size exceeds the maximum limit of 3MB.");
        }

        $filePath = '/uploads/' . uniqid() . '.' . $fileExt;
        if (!move_uploaded_file($file['tmp_name'], __DIR__ . '/../../public' . $filePath)) {
            throw new Exception("Failed to move uploaded file.");
        }

        return $filePath;
    }

    public function update($id, $data) {
        $stmt = $this->db->prepare("
        UPDATE uploads
        SET title = ?, description = ?, author = ?, subject = ?, subtopic = ?, standard = ?, resource_type = ?, file_path = ?, file_url = ?, file_type = ?
        WHERE id = ?
    ");
        if (!$stmt) {
            throw new Exception("Failed to prepare statement: " . $this->db->error);
        }

        $fileType = isset($data['file']) ? 'file' : 'url';
        $filePath = isset($data['file']) ? $this->handleFileUpload($data['file']) : (isset($data['file_url']) ? $data['file_url'] : '');

        $stmt->bind_param(
            'sssiiissssi',
            $data['title'], $data['description'], $data['author'],
            $data['subject'], $data['subtopic'], $data['standard'],
            $data['resource_type'], $filePath, $data['file_url'], $fileType, $id
        );

        if (!$stmt->execute()) {
            throw new Exception("Failed to execute statement: " . $stmt->error);
        }
    }

    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM uploads WHERE id = ?");
        if (!$stmt) {
            throw new Exception("Failed to prepare statement: " . $this->db->error);
        }

        $stmt->bind_param('i', $id);
        if (!$stmt->execute()) {
            throw new Exception("Failed to execute statement: " . $stmt->error);
        }

        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
}