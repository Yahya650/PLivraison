<?php

use Vinkla\Hashids\Facades\Hashids;

function dcryptID($encrypted_id, $connection = 'main')
{
    if (!$encrypted_id) {
        return null;
    }
    try {
        $text = Hashids::connection($connection)->decode($encrypted_id);
        if (count($text) > 0) {
            return $text[0];
        } else {
            return null;
        }
    } catch (\Exception $e) {
        return null;
    }
}

function cryptID($id, $connection = 'main')
{
    try {
        return Hashids::connection($connection)->encode($id);
    } catch (\Exception $e) {
        return null;
    }
}
