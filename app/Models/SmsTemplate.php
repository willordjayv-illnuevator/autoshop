<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SmsTemplate extends Model
{
    protected $fillable = [
        'name',
        'message_body',
    ];

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    public function getCharacterCountAttribute()
    {
        return strlen($this->message_body);
    }

    public function getIsUnicodeAttribute()
    {
        return !mb_detect_encoding($this->message_body, 'ASCII', true);
    }

    public function getSmsPartsAttribute()
    {
        $length = $this->character_count;

        // Unicode SMS
        if ($this->is_unicode) {
            return $length <= 70 ? 1 : ceil($length / 67);
        }

        // GSM SMS
        return $length <= 160 ? 1 : ceil($length / 153);
    }
}
