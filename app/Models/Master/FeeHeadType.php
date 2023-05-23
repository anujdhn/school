<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeeHeadType extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function store(array $req){
      FeeHeadType::create($req);
    }
}
