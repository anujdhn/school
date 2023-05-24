<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SchoolMaster extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $hidden = [
        'password'
    ];

    /**
     * | Store School
     */
    public function store(array $req)
    {
        $school = SchoolMaster::create($req);
        return [
            'id' => $school->id
        ];
    }

    /**
     * | get school by id
     */
    public function getSchoolById($id)
    {
        return SchoolMaster::findOrFail($id);
    }
}
