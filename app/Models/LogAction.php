<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogAction extends Model
{
    protected $table = 'log_actions';

    protected $fillable = ['subject', 'url', 'method', 'ip', 'agent', 'user_id'];
}
