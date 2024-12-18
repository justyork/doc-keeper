<?php

class Validator {
    public static function validateUpload($data) {
        $errors = [];
        if (strlen($data['title']) < 20) {
            $errors[] = "Title must be at least 20 characters.";
        }

        if (strlen($data['description']) < 100) {
            $errors[] = "Description must be at least 100 characters.";
        }

        if (!$data['file'] && !$data['file_url']) {
            $errors[] = "You must upload a file or provide a URL.";
        }

        if ($data['file'] && $data['file_url']) {
            $errors[] = "You can only upload a file OR provide a URL, not both.";
        }

        return $errors;
    }
}