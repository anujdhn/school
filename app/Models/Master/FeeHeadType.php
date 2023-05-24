<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeeHeadType extends Model
{
    use HasFactory;
    protected $guarded=[];

     /**
     * | Add Records
     */
    public function store(array $req){
      FeeHeadType::create($req);
    }

     /**
     * | Read Records by ID
     */
    public function readFeeHeadTypeById($feeHeadType)
    {
        return FeeHeadType::where('fee_head_type', $feeHeadType)
            ->where('status', 1)
            ->get();
    }
   
}
