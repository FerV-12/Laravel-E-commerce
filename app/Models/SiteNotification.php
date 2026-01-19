<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteNotification extends Model
{
    use HasFactory;

    protected $table = 'site_notifications';

    protected $fillable = [
        'type',
        'message',
        'link',
        'recipient_id',
        'actor_id',
        'is_read',
    ];

    protected $casts = [
        'is_read' => 'boolean',
    ];
}
