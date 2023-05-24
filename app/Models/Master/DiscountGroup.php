<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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


    /**
     * | Get Discount Group by Id
     */
    public function getGroupById($id)
    {
        return DB::table('discount_groups as d')
            ->select(
                'd.*',
                's.school_code',
                DB::raw("concat(s.first_name,' ',s.middle_name,' ',s.last_name) as school_name")
            )
            ->join('school_masters as s', 's.id', '=', 'd.school_id')
            ->where('d.id', $id)
            ->first();
    }

    /**
     * | Retrieve all Group
     */
    public function retrieveAll()
    {
        return DB::table('discount_groups as d')
            ->select(
                'd.*',
                's.school_code',
                DB::raw("concat(s.first_name,' ',s.middle_name,' ',s.last_name) as school_name")
            )
            ->join('school_masters as s', 's.id', '=', 'd.school_id')
            ->orderByDesc('d.id')
            ->get();
    }
}
