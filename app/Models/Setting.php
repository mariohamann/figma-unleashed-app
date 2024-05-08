<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['name', 'value', 'type'];

    // Automatically cast 'value' as an array to handle JSON data
    protected $casts = [
        'value' => 'array',
    ];

    // Mutator to automatically encode 'value' as JSON when setting it
    public function setValueAttribute($value)
    {
        $this->attributes['value'] = json_encode(['value' => $value]);
    }

    // Accessor to automatically decode 'value' from JSON when getting it
    public function getValueAttribute($value)
    {
        $decoded = json_decode($value, true);
        return $decoded['value'] ?? null;
    }
}
