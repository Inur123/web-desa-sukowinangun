<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PopupBanner extends Model
{
    protected $table = 'popup_banners';
    protected $fillable = ['title', 'image', 'is_active'];
}
