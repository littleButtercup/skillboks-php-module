<?php
require_once 'Storage.php';
class FileStorage extends Storage
{
    public function create($obj)
    {
        $i = 1;
        $fileName = $obj->slug;
        while (file_exists($fileName)) {
            $fileName = $obj->slug . '_' . $i;
            $i++;
        }
        $obj->slug = $fileName;
        file_put_contents($obj->slug, serialize($obj));
        return $obj->slug;
    }

    public function read($slug)
    {
        if (file_exists($slug)) {
            return unserialize(file_get_contents($slug));
        }
    }

    public function update($slug, $obj)
    {
        $obj->slug = $slug;
        $obj->storeText();
    }

    public function delete($slug)
    {
        if (file_exists($slug)) {
            unlink($slug);
        }
    }

    public function list($dir): array
    {
        $arrayFile = [];
        $arraySome = scandir($dir);
        for ($i = 2; $i < count($arraySome); $i++) {
            if (!is_dir($arraySome[$i])) {
                $arrayFile[] = $this->read($arraySome[$i]);
            }
        }
        return $arrayFile;
    }
}

