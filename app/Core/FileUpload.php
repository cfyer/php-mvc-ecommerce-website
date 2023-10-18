<?php

namespace App\Core;

class FileUpload
{
    protected $file_name;
    protected $file_path;
    protected $file_extension;
    protected $max_size = 2048;

    public function getName()
    {
        return $this->file_name;
    }

    public function setName($file, $name): void
    {
        if ($name == '')
            $name = pathinfo($file, PATHINFO_FILENAME);

        $hash = md5(microtime());
        $extension = $this->getExtension($file);
        $this->file_name = "$name-$hash.$extension";
    }

    public function getExtension($file): array|string
    {
        return $this->file_extension = pathinfo($file, PATHINFO_EXTENSION);
    }

    public static function fileSize($file): bool
    {
        $static = new static;
        return $file > $static->max_size;
    }

    public static function isImage($file): bool
    {
        $static = new static;
        $extension = $static->getExtension($file);
        $image_whitelist = ['png', 'jpeg', 'jpg', 'webp', 'gif'];

        if (in_array(strtolower($extension), $image_whitelist))
            return true;

        return false;
    }

    public function getPath()
    {
        return $this->file_path;
    }

    public function setPath($path): void
    {
        $this->file_path = $path;
    }

    public static function move($temp, $folder, $file, $name = ''): null|static
    {
        $static = new static;

        $static->setName($file, $name);

        if (!is_dir($folder))
            mkdir($folder, 0777, true);

        $static->setPath("$folder/$file");
        $path = BASE_PATH . "/public/{$static->getPath()}";

        if (move_uploaded_file($temp, $path))
            return $static;

        return null;
    }
}
