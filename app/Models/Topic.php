<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Topic extends Model
{
    public function Subject(): BelongsTo{
        return $this->belongsTo(Subject::class);
    }
}
