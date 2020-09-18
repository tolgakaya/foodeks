<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PageAboutGallery extends Model
{
    protected $guarded = [];
    public function path()
    {
        return  asset('images/' . $this->filename);
    }
}