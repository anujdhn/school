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
    public function readGroupByDiscountGroup($discountGroup, $academicYear)
    {
        return DiscountGroup::where('discount_group', $discountGroup)
            ->where('academic_year', $academicYear)
            ->where('status', 1)
            ->get();
    }
}
