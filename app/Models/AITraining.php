<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AITraining extends Model
{
    protected $table = 'ai_training';
    protected $fillable = ['prompt', 'output',];
}
