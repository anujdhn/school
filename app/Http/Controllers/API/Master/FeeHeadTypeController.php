<?php

namespace App\Http\Controllers\API\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Master\FeeHeadType;
use Illuminate\Support\Str;
use Exception;
use Validator;

class FeeHeadTypeController extends Controller
{
    private $_mFeeHeadTypes;

    public function __construct()
    {
        $this->_mFeeHeadTypes = new FeeHeadType();
    }
    /**
     * | Created On-23-05-2023 
     * | Created By- Lakshmi Kumari
     * | Fee Head Type Crud Operations
     */

    public function store(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'feeHeadType'=>'required|string',
            'isAnnual'=>'required|integer',
            'isOptional' => 'required|integer',
            'isLateFineApplicable'=>'required|integer',
            'academicYear' => 'required|string',
            'deviceId' => 'string'
        ]);   
        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json([
                'error' => $errors
            ], 422);
        }
        try {
            $ip = getClientIpAddress();
            $createdBy = 'Admin';
            $schoolId = 'DAV_Ranchi_834001';
            $metaReqs=[
                'fee_head_type' => Str::ucFirst($req->feeHeadType),
                'is_annual' => $req->isAnnual,
                'is_optional' => $req->isOptional,
                'is_latefee_applicable' => $req->isLateFineApplicable,
                'academic_year' => $req->academicYear,
                'school_id' => $schoolId,
                'created_by' => $createdBy,
                'ip_address' => $ip
            ]; 
            $this->_mFeeHeadTypes->store($metaReqs);
            return responseMsgs(true, "Successfully Saved", [], "", "1.0", responseTime(), "POST", $req->deviceId ?? "");
        } catch (Exception $e) {
            return responseMsgs(false, $e->getMessage(), [], "", "1.0", responseTime(), "POST", $req->deviceId ?? "");
        }
    }

    public function view(Request $req)
    {        
        try {
            $ip = getClientIpAddress();
            $createdBy = 'Admin';
            $schoolId = 'DAV_Ranchi_834001';
            $metaReqs=[
                'fee_head_type' => Str::ucFirst($req->feeHeadType),
                'is_annual' => $req->isAnnual,
                'is_optional' => $req->isOptional,
                'is_latefee_applicable' => $req->isLateFineApplicable,
                'academic_year' => $req->academicYear,
                'school_id' => $schoolId,
                'created_by' => $createdBy,
                'ip_address' => $ip
            ]; 
            $this->_mFeeHeadTypes->store($metaReqs);
            return responseMsgs(true, "Successfully Saved", [], "", "1.0", responseTime(), "POST", $req->deviceId ?? "");
        } catch (Exception $e) {
            return responseMsgs(false, $e->getMessage(), [], "", "1.0", responseTime(), "POST", $req->deviceId ?? "");
        }
    }
}
