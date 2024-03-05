<?php

class ClassUploader {
    private $targetDirectory = "../../../../pages/Teacher/Course/uploads/";
    private $maxFileSize = 5000000; // 5MB
    private $allowedTypes = ['jpg' => 'image/jpeg', 'png' => 'image/png', 'gif' => 'image/gif'];
    private $fileName;
    private $imageFileType;
    private $fileTempName;
    private $newWidth;
    private $newHeight;

    public function __construct($file, $newWidth) {
        $this->fileName = basename($file["name"]);
        $this->imageFileType = strtolower(pathinfo($this->fileName, PATHINFO_EXTENSION));
        $this->fileTempName = $file["tmp_name"];
        $this->newWidth = $newWidth;
        //$this->newHeight = $newHeight;
    }

    public function upload() {
        // Check if image file is a actual image or fake image
        $check = getimagesize($this->fileTempName);
        if($check === false) {
            return "File is not an image.";
        }

        // Check file size
        if ($_FILES["CourseImage"]["size"] > $this->maxFileSize) {
            return "Sorry, your file is too large.";
        }

        // Allow certain file formats
        if(!array_key_exists($this->imageFileType, $this->allowedTypes)) {
            return "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        }

        // Check if file already exists
        if (file_exists($this->targetDirectory . $this->fileName)) {
            return "Sorry, file already exists.";
        }

        $newFilePath = $this->generateNewFileName();
        if (move_uploaded_file($this->fileTempName, $newFilePath)) {
            $this->resizeImage($newFilePath);
            return basename($newFilePath);
        } else {
            return "Sorry, there was an error uploading your file.";
        }
    }

    private function resizeImage($newFilePath) {
        list($originalWidth, $originalHeight) = getimagesize($newFilePath);
        // คำนวณความสูงใหม่โดยรักษาอัตราส่วนด้านของภาพ
        $newHeight = ($this->newWidth / $originalWidth) * $originalHeight;
    
        $thumb = imagecreatetruecolor($this->newWidth, $newHeight);
        $source = $this->createImageFromType($newFilePath);
    
        // Resize
        imagecopyresampled($thumb, $source, 0, 0, 0, 0, $this->newWidth, $newHeight, $originalWidth, $originalHeight);
    
        // Save resized image
        $this->saveImage($thumb, $newFilePath);
    }

    private function createImageFromType($filepath) {
        switch ($this->imageFileType) {
            case 'jpg':
            case 'jpeg':
                return imagecreatefromjpeg($filepath);
            case 'png':
                return imagecreatefrompng($filepath);
            case 'gif':
                return imagecreatefromgif($filepath);
        }
    }

    private function saveImage($image, $filepath) {
        switch ($this->imageFileType) {
            case 'jpg':
            case 'jpeg':
                imagejpeg($image, $filepath);
                break;
            case 'png':
                imagepng($image, $filepath);
                break;
            case 'gif':
                imagegif($image, $filepath);
                break;
        }
    }

    private function generateNewFileName() {
        // Generate a unique name for the image: use time and random number
        $newFileName = time() . '-' . rand(1000, 9999) . '.' . $this->imageFileType;
        return $this->targetDirectory . $newFileName;
    }

    public function deleteImage($filePath) {
        // ตรวจสอบว่าไฟล์มีอยู่จริง
        if (file_exists($filePath)) {
            // ลบไฟล์
            if (unlink($filePath)) {
                return "The file has been deleted.";
            } else {
                return "There was an error deleting the file.";
            }
        } else {
            return "The file does not exist.";
        }
    }
    
}

?>
