<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PageFaq extends Model
{
    protected $guarded = [];
    public function pagefaqgroup()
    {
        return $this->belongsTo(PageFaqGroup::class);
    }
}