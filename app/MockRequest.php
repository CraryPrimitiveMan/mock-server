<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MockRequest extends Model
{
    protected $fillable = [
        'user_id', 'scheme', 'domain', 'path', 'request_method', 'request_uri', 'response_code',
        'response_content_type', 'response_charset', 'response_headers', 'response_body'
    ];
}
