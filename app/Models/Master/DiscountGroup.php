<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiscountGroup extends Model
{
    use HasFactory;
    protected $guarded = [];

    // Add Records
    public function store(array $req)
    {
        DiscountGroup::create($req);
    }

    /**
     * | Read Discount Group by Discount Group
     */
    public function readGroupByDiscountGroup($discountGroup)
    {
        return DiscountGroup::where('discount_group', $discountGroup)
            ->where('status', 1)
            ->get();
    }
}
