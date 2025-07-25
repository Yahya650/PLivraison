<?php

namespace App\Http\Traits;

use App\Models\Attachment;
use Exception;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait HasAttachment
{

    public function deleteAttachment($fieldName = 'attachment')
    {
        try {
            $attachment = Attachment::where('table_name', $this->getTable())
                ->where('fk_id', $this->id)
                ->where('field', $fieldName)
                ->first();

            if ($attachment) {
                // Delete the file from storage
                Storage::disk('public')->delete($attachment->path);

                // Delete the attachment record
                $attachment->delete();

                return true;
            }

            return false;
        } catch (Exception $ex) {
            throw new Exception("Failed to delete attachment: " . $ex->getMessage(), 500);
        }
    }
    public function deleteAttachments($fieldName = 'attachment')
    {
        try {
            $attachments = Attachment::where('table_name', $this->getTable())
                ->where('fk_id', $this->id)
                ->where('field', $fieldName)
                ->get();

            foreach ($attachments as $attachment) {
                // Delete the file from storage
                Storage::disk('public')->delete($attachment->path);

                // Delete the attachment record
                $attachment->delete();
            }

            return true;
        } catch (Exception $ex) {
            throw new Exception("Failed to delete attachment: " . $ex->getMessage(), 500);
        }
    }

    public function updateAttachment($newAttachment, $fieldName = 'attachment', $is_personal = 0, $fileName = null)
    {
        try {
            // Delete existing attachment before adding a new one
            $this->deleteAttachments($fieldName);

            // Add new attachment
            return $this->addAttachment($newAttachment, $fieldName, $is_personal, $fileName);
        } catch (Exception $ex) {
            throw new Exception("Failed to update attachment: " . $ex->getMessage(), 500);
        }
    }

    public function addAttachment($attachment, $fieldName = 'attachment', $is_personal = 0, $fileName = null)
    {
        try {
            $filename = date('d-m-Y') . '/' . (cryptID($this->id)) . '/';
            if ($fileName) {
                $filename .= $fileName;
                $filename .= '.' . $attachment->getClientOriginalExtension();
            } else {
                $filename .= str_replace(' ', '-', pathinfo($attachment->getClientOriginalName(), PATHINFO_FILENAME));
                $filename .= '-' . time() . '-' . Str::random(4);
                $filename .= '.' . $attachment->getClientOriginalExtension();
                $filename = strtolower($filename);
            }
            Storage::disk('public')->putFileAs($this->getTable(), $attachment, $filename, 'private');

            $attachment_db = new Attachment();
            $attachment_db->table_name = $this->getTable();
            $attachment_db->fk_id = $this->id;
            $attachment_db->slug = Str::slug($attachment->getClientOriginalName()) . time();
            $attachment_db->field = $fieldName;
            $attachment_db->name = $attachment->getClientOriginalName();
            $attachment_db->extension = $attachment->getClientOriginalExtension();
            $attachment_db->path = $this->getTable() . '/' . $filename;
            $attachment_db->filesize = $attachment->getSize();
            $attachment_db->is_personal = $is_personal;
            $attachment_db->save();


            return $attachment_db->id;
        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), 500);
            //continue even if one attachment fails
            // return false;
        }
    }

    public function getAttachment($field = 'attachment', $only_trashed = false)
    {
        $attachments = Attachment::select('*');

        $attachments->where('table_name', $this->getTable());
        $attachments->where('fk_id', $this->id);
        $attachments->where('field', $field);
        if ($only_trashed) {
            $attachments->onlyTrashed();
        }

        return $attachments->first();
    }

    public function getAttachments($field = 'attachment', $only_trashed = false, $paginate = false)
    {
        $attachments = Attachment::select('*');

        $attachments->where('table_name', $this->getTable());
        $attachments->where('fk_id', $this->id);
        $attachments->where('field', $field);

        if ($only_trashed) {
            $attachments->onlyTrashed();
        }

        if ($paginate) {
            return $attachments->paginate(8);
        } else {
            return $attachments->orderBy('id', 'desc')->get();
        }
    }

    public function getLastAttachment($field = 'attachment', $only_trashed = false)
    {
        $attachment = Attachment::where('table_name', $this->getTable())
            ->where('field', $field)
            ->where('fk_id', $this->id);

        if ($only_trashed) {
            $attachment->onlyTrashed();
        }
        return $attachment->orderBy('attachments.id', 'desc')->first();
    }

    public function addLocalAttachment($attachment, $info, $fieldName = 'attachment')
    {
        try {
            $filename = date('d-m-Y') . '/' . (cryptID($this->id)) . '/';
            $filename .= str_replace(' ', '-', $info['filename']);
            $filename .= '-' . time() . '-' . Str::random(4);
            $filename .= '.' . $info['extension'];
            $filename = strtolower($filename);
            Storage::disk('public')->putFileAs($this->getTable(), $attachment, $filename, 'private');
            $attachment_db = new Attachment();
            $attachment_db->table_name = $this->getTable();
            $attachment_db->fk_id = $this->id;
            $attachment_db->slug = Str::slug($info['filename']) . time();
            $attachment_db->field = $fieldName;
            $attachment_db->name = $info['filename'];
            $attachment_db->extension = $info['extension'];
            // $attachment_db->path = env('DO_SPACES_ROOT').'/'.$this->getTable() . '/' . $filename;
            $attachment_db->path = $this->getTable() . '/' . $filename;
            try {
                $attachment_db->filesize = $attachment->getSize() || 0;
            } catch (Exception $e) {
                $attachment_db->filesize = $attachment->size();
            }
            $attachment_db->save();
            return $attachment_db->id;
        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), 500);
            // continue even if one attachment fails
            // return false;
        }
    }

    public function addAttachmentFromLink($url, $fieldName = 'attachment')
    {
        $content = file_get_contents($url);
        $info = pathinfo(parse_url($url, PHP_URL_PATH)); // clean path
        $name = $info['filename'];
        $info['extension'] = array_key_exists('extension', $info) ? $info['extension'] : 'png';
        $name = $name . '_' . uniqid() . '.' . $info['extension']; // safer unique file name

        // Save file temporarily
        Storage::disk('public')->put($name, $content);

        // Get actual filesystem path
        $path = storage_path('app/public/' . $name);
        $imageFile = new File($path);

        // Add to model
        $this->addLocalAttachment($imageFile, $info, $fieldName);

        // Delete the temp file
        Storage::disk('public')->delete($name);
    }
}
