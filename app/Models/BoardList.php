<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BoardList extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function cards(){
        return $this->hasMany(BoardListCard::class, 'list_id')->orderBy('order');
    }

}
