<?php

abstract class BaseModel {
    protected $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    abstract protected function getTableName();
    abstract public function getColumns();

    public function getAll($filters = []) {
        $query = "SELECT * FROM " . $this->getTableName();
        if (!empty($filters)) {
            $whereClause = implode(" AND ", array_map(fn($key) => "$key = ?", array_keys($filters)));
            $query .= " WHERE $whereClause";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param(str_repeat('s', count($filters)), ...array_values($filters));
        } else {
            $stmt = $this->db->prepare($query);
        }

        if (!$stmt) {
            throw new Exception("Failed to prepare statement: " . $this->db->error);
        }

        if (!$stmt->execute()) {
            throw new Exception("Failed to execute statement: " . $stmt->error);
        }

        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM " . $this->getTableName() . " WHERE id = ?");
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

    public function save($data) {
        $columns = implode(", ", array_keys($data));
        $placeholders = implode(", ", array_fill(0, count($data), '?'));
        $types = str_repeat('s', count($data));

        $stmt = $this->db->prepare("INSERT INTO " . $this->getTableName() . " ($columns) VALUES ($placeholders)");
        if (!$stmt) {
            throw new Exception("Failed to prepare statement: " . $this->db->error);
        }

        $stmt->bind_param($types, ...array_values($data));
        if (!$stmt->execute()) {
            throw new Exception("Failed to execute statement: " . $stmt->error);
        }
    }

    public function update($id, $data) {
        $setClause = implode(", ", array_map(fn($key) => "$key = ?", array_keys($data)));
        $types = str_repeat('s', count($data)) . 'i';

        $stmt = $this->db->prepare("UPDATE " . $this->getTableName() . " SET $setClause WHERE id = ?");
        if (!$stmt) {
            throw new Exception("Failed to prepare statement: " . $this->db->error);
        }

        $params = array_merge(array_values($data), [$id]);
        $stmt->bind_param($types, ...$params);
        if (!$stmt->execute()) {
            throw new Exception("Failed to execute statement: " . $stmt->error);
        }
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM " . $this->getTableName() . " WHERE id = ?");
        if (!$stmt) {
            throw new Exception("Failed to prepare statement: " . $this->db->error);
        }

        $stmt->bind_param('i', $id);
        if (!$stmt->execute()) {
            throw new Exception("Failed to execute statement: " . $stmt->error);
        }

        if ($stmt->affected_rows === 0) {
            throw new Exception("No rows were deleted.");
        }
    }
}