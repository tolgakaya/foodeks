<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PageFaqGroup extends Model
{
    protected $guarded = [];
    public function pagefaqs()
    {
        return $this->hasMany(PageFaq::class);
    }
}