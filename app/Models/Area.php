<?php

namespace App\Models;

use App\Traits\HasBranch;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Area extends Model
{
    use HasFactory;
    use HasBranch;

    protected $guarded = ['id'];

    public function tables(): HasMany
    {
        return $this->hasMany(Table::class);
    }

}
