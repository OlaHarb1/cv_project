<?php

namespace App\Trait;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait HasFile
{

    public function getFileURLAttribute()
    {
        /**
         * usage:
         * private string $fileColumnName = "photo";
         * inside class that use this trait
         */
        $fileName = $this->getAttribute($this->fileColumnName ?? "path");
        $disk = $this->disk ?? "public";
        if ($fileName != null && $fileName != "" && Storage::disk($disk)->exists($fileName)) {
            return Storage::disk($disk)->url($fileName);
        }
        return "";
    }

    public function deleteFile()
    {
        $fileName = $this->getAttribute($this->fileColumnName ?? "path");
        $disk = $this->disk ?? "public";
        if ($fileName != null && $fileName != "" && Storage::disk($disk)->exists($fileName)) {
            return Storage::disk($disk)->delete($fileName);
        }
        return false;
    }

    public function saveFile($file)
    {
        $path = $this->path ?? $this->centerId;
        $fileName = $this->fileColumnName ?? 'path';
        $disk = $this->disk ?? 'public';
        $path = Storage::disk($disk)->putFileAs(
            $path, $file, Str::uuid() . "_" . $file->getClientOriginalName());
        throw_if($path == null, "doesn't save file");
        $this->update([
            'originalName'=>$this->getFileNameWithOutExtension($file),
            'extension'=>$file->clientExtension(),
            'size'=>$file->getSize(),
            $fileName=>$path]);
    }

    public function saveFiles($files)
    {
        $path = $this->path ?? $this->centerId;
        $fileName = $this->fileColumnName ?? 'path';
        $disk = $this->disk ?? 'public';
        foreach ($files as $key => $file) {
            $path = Storage::disk($disk)->putFileAs(
                $path, $file, Str::uuid() . "_" . $file->getClientOriginalName());
            throw_if($path == null, "doesn't save file");
            $this->update([
                'originalName'=>$this->getFileNameWithOutExtension($file),
                'extension'=>$file->clientExtension(),
                $fileName=>$path]);
        }
    }

    public function fileSaveBase64($file, $isDetailed = false)
    {
        $disk = $this->disk ?? "public";
        $path = $this->path ?? $this->centerId;
        $fileName=$this->fileColumnName ??'path';
        $file = base64_decode($file);
        $info = explode('/', finfo_buffer(finfo_open(), $file, FILEINFO_MIME_TYPE));
        $extension = $info[1];
        $fileType = $info[0];
        $path = $path . '/' . Str::random(35) . '.' . $extension;
        $store = Storage::disk($disk)->put($path, $file);
        throw_if(!$store, "doesn't save file");
        $this->{$fileName} = $path;
        if ($isDetailed) {
            $this->{$extension} = $extension;
            $this->{$fileType} = $fileType;
        }
        $this->save();
    }

    protected function getFileNameWithOutExtension($file)
    {
        $fileName = $file->getClientOriginalName();
        $exploded = explode('.', $fileName);
        $extension = $exploded[count($exploded) - 1];
        return substr($fileName, 0, (strlen($fileName) - strlen($extension)) - 1);
    }

}
