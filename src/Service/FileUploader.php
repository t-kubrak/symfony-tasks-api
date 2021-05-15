<?php

namespace App\Service;

use Symfony\Component\HttpClient\Exception\ServerException;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileUploader
{
    private $targetDirectory;

    public function __construct($targetDirectory)
    {
        $this->targetDirectory = $targetDirectory;
    }

    public function upload(UploadedFile $file)
    {
        $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);

        $fileName = $originalFilename.'-'.uniqid().'.'.$file->guessExtension();

        try {
            $movedFile = $file->move($this->getTargetDirectory(), $fileName);
        } catch (FileException $e) {
            throw new \HttpResponseException("Couldn't upload the file");
        }

        return $movedFile;
    }

    public function getTargetDirectory()
    {
        return $this->targetDirectory;
    }
}