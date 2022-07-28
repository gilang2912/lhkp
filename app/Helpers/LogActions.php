<?php

namespace App\Helpers;

use App\Models\LogAction;
use Illuminate\Support\Facades\Request;

class LogActions
{
    public static function store($subject)
    {
        LogAction::create([
            'subject' => $subject,
            'url' => Request::fullUrl(),
            'method' => Request::method(),
            'ip' => Request::ip(),
            'agent' => Request::header('user-agent'),
            'user_id' => auth()->check() ? auth()->user()->id : 0
        ]);
    }

    public static function logActionList()
    {
        return LogAction::latest()->get();
    }
}
