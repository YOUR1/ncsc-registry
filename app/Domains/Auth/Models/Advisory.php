<?php

namespace App\Domains\Auth\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Advisory extends Model
{
    use HasFactory;

    public $fillable = [
        'ncsc_id','title', 'url', 'chance', 
        'damage', 'desc', 'registration_id', 'version'
    ];

    
    public function registration(): HasOne
    {
        return $this->hasOne(Registration::class, 'id', 'registration_id');
    }

}
