<?php

// Get real path for our folder
$rootPath = realpath(__DIR__."/controller");

// Initialize archive object
$zip = new ZipArchive();
$zip->open('file.zip', ZipArchive::CREATE | ZipArchive::OVERWRITE);

// Create recursive directory iterator
/** @var SplFileInfo[] $files */
$files = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($rootPath),
    RecursiveIteratorIterator::LEAVES_ONLY
);

foreach ($files as $name => $file)
{
    // Skip directories (they would be added automatically)
    if (!$file->isDir())
    {
        // Get real and relative path for current file
        $filePath = $file->getRealPath();
        $relativePath = substr($filePath, strlen($rootPath) + 1);

        // Add current file to archive
        $zip->addFile($filePath, $relativePath);
    }
}



// Zip archive will be created only after closing object
$zip->close();


$url = __DIR__."/file.zip";

//Define header information
header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="'.basename($url).'"');
header('Content-Length: ' . filesize($url));
header('Pragma: public');

//Clear system output buffer
flush();

//Read the size of the file
readfile(__DIR__."/file.zip",true);


?>