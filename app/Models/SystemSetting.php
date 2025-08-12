<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Cache;

class SystemSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'value',
        'type',
        'group',
        'label',
        'description',
        'is_public',
        'is_editable',
        'validation_rules',
        'sort_order',
    ];

    protected $casts = [
        'is_public' => 'boolean',
        'is_editable' => 'boolean',
        'validation_rules' => 'array',
        'sort_order' => 'integer',
    ];

    /**
     * Boot method to clear cache when settings are updated
     */
    protected static function boot()
    {
        parent::boot();

        static::saved(function ($setting) {
            Cache::forget('system_settings');
            Cache::forget("setting_{$setting->key}");
        });

        static::deleted(function ($setting) {
            Cache::forget('system_settings');
            Cache::forget("setting_{$setting->key}");
        });
    }

    /**
     * Get a setting value by key
     */
    public static function get($key, $default = null)
    {
        return Cache::remember("setting_{$key}", 3600, function () use ($key, $default) {
            $setting = static::where('key', $key)->first();
            return $setting ? $setting->getValue() : $default;
        });
    }

    /**
     * Set a setting value
     */
    public static function set($key, $value)
    {
        $setting = static::where('key', $key)->first();
        
        if ($setting) {
            $setting->update(['value' => $value]);
        } else {
            static::create([
                'key' => $key,
                'value' => $value,
                'label' => ucwords(str_replace('_', ' ', $key)),
            ]);
        }
        
        Cache::forget("setting_{$key}");
        Cache::forget('system_settings');
    }

    /**
     * Get all settings grouped by group
     */
    public static function getAllGrouped()
    {
        return Cache::remember('system_settings', 3600, function () {
            return static::orderBy('group')->orderBy('sort_order')->get()->groupBy('group');
        });
    }

    /**
     * Get the actual value based on type
     */
    public function getValue()
    {
        switch ($this->type) {
            case 'boolean':
                return filter_var($this->value, FILTER_VALIDATE_BOOLEAN);
            case 'number':
                return is_numeric($this->value) ? (float) $this->value : 0;
            case 'json':
                return json_decode($this->value, true) ?: [];
            default:
                return $this->value;
        }
    }

    /**
     * Scopes
     */
    public function scopePublic($query)
    {
        return $query->where('is_public', true);
    }

    public function scopeEditable($query)
    {
        return $query->where('is_editable', true);
    }

    public function scopeByGroup($query, $group)
    {
        return $query->where('group', $group);
    }
}
