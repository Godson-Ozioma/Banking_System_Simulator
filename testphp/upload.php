<?php

// Configuration (adjust these to your requirements)
$allowedTypes = ['image/jpeg', 'image/png', 'application/pdf'];
$maxSize = 2 * 1024 * 1024; // 2 MB
$uploadDir = '/path/to/uploads/'; // Outside the web root

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['uploadedFile']) && $_FILES['uploadedFile']['error'] === UPLOAD_ERR_OK) {
        $fileInfo = $_FILES['uploadedFile'];

        // 1. Check File Type
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $fileType = finfo_file($finfo, $fileInfo['tmp_name']);
        finfo_close($finfo);

        if (!in_array($fileType, $allowedTypes)) {
            die('Invalid file type.');
        }

        // 2. Check File Size
        if ($fileInfo['size'] > $maxSize) {
            die('File size exceeds limit.');
        }

        // 3. Sanitize and Generate New File Name
        $originalName = pathinfo($fileInfo['name'], PATHINFO_FILENAME);
        $sanitizedName = preg_replace('/[^A-Za-z0-9\-]/', '_', $originalName);
        $extension = pathinfo($fileInfo['name'], PATHINFO_EXTENSION);
        $newFileName = $sanitizedName . '_' . bin2hex(random_bytes(10)) . '.' . $extension;

        // 4. Move File to Secure Location
        $destination = $uploadDir . $newFileName;
        if (move_uploaded_file($fileInfo['tmp_name'], $destination)) {
            // Success: Do something with $destination (e.g., store it in a database)
            echo "File uploaded successfully!";
        } else {
            die('Error moving uploaded file.');
        }
    } else {
        die('Upload error.');
    }
}