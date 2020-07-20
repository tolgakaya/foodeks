<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $guarded = [];
    public function path()
    {
        return  asset('images/' . $this->filename);
    }
}