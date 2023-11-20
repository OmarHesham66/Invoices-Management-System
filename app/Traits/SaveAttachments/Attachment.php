<?php

namespace App\Traits\SaveAttachments;

trait Attachment
{
    public static function save($file, $folder_name, $disk)
    {
        $file_name = $file->getClientOriginalName();
        $file->storeAs($folder_name, $file_name, $disk);
        return $file_name;
    }
}
