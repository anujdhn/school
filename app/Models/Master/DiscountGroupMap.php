<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DiscountGroupMap extends Model
{
    use HasFactory;
    protected $guarded = [];

    /**
     * | Get Discount Group Maps
     */
    public function getDiscountGroupMaps($req)
    {
        return DiscountGroupMap::where('student_id', $req->studentId)
            ->where('discount_group_id', $req->discountGroupId)
            ->where('class_fee_id', $req->classFeeId)
            ->where('status', 1)
            ->get();
    }

    /**
     * | Store Record
     */
    public function store(array $req)
    {
        DiscountGroupMap::create($req);
    }

    /**
     * | Get Group map by id
     */
    public function getGroupMapById($id)
    {
        return DB::table('discount_group_maps as d')
            ->select(
                'd.*',
                DB::raw("concat(s.first_name,' ',s.middle_name,' ',s.last_name) as student_name"),
                'dg.discount_group',
                'f.fee_head_amount'
            )
            ->join('students as s', 's.id', 'd.student_id')
            ->join('discount_groups as dg', 'dg.id', 'd.discount_group_id')
            ->join('fee_masters as f', 'f.id', '=', 'd.class_fee_id')
            ->where('d.status', 1)
            ->where('d.id', $id)
            ->first();
    }

    /**
     * | Retrieve All Groups
     */
    public function retrieveAll()
    {
        return DB::table('discount_group_maps as d')
            ->select(
                'd.*',
                DB::raw("concat(s.first_name,' ',s.middle_name,' ',s.last_name) as student_name"),
                'dg.discount_group',
                'f.fee_head_amount'
            )
            ->join('students as s', 's.id', 'd.student_id')
            ->join('discount_groups as dg', 'dg.id', 'd.discount_group_id')
            ->join('fee_masters as f', 'f.id', '=', 'd.class_fee_id')
            ->where('d.status', 1)
            ->orderByDesc('d.id')
            ->get();
    }
}
