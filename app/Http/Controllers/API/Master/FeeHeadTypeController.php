<?php

namespace App\Http\Controllers\API\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Master\FeeHeadType;
use Illuminate\Support\Str;
use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;

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
            'feeHeadType' => 'required|string',
            'isAnnual' => 'required|numeric',
            'isOptional' => 'required|numeric',
            'isLateFineApplicable' => 'required|numeric',
            'academicYear' => 'required|string'
        ]);
        if ($validator->fails())
            return responseMsgs(false, $validator->errors(), []);

        try {
            $isExists = $this->_mFeeHeadTypes->readFeeHeadTypeById($req->feeHeadType);
            if (collect($isExists)->isNotEmpty())
                throw new Exception("Fee Head Type Already existing");
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


    /**
     * | Update Fee Head Type
     */
    public function edit(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'id' => 'required|numeric',
            'feeHeadType' => 'required|string',
            'isAnnual' => 'required|numeric',
            'isOptional' => 'required|numeric',
            'isLateFineApplicable' => 'required|numeric',
            'academicYear' => 'required|string',
            'status' => 'nullable|in:active,deactive'
        ]);
        if ($validator->fails())
            return responseMsgs(false, $validator->errors(), []);

        try {
            $isExists = $this->_mFeeHeadTypes->readFeeHeadTypeById($req->feeHeadType);
            if ($isExists && $isExists->where('id', '!=', $req->id)->isNotEmpty())
                throw new Exception("Fee Head Type Already Existing");
            $metaReqs = [ 
                'fee_head_type' => Str::ucFirst($req->feeHeadType),
                'is_annual' => $req->isAnnual,
                'is_optional' => $req->isOptional,
                'is_latefee_applicable' => $req->isLateFineApplicable,
                'academic_year' => $req->academicYear,
                'updated_at' => Carbon::now()
            ];

            if (isset($req->status)) {                  // In Case of Deactivation or Activation 
                $status = $req->status == 'deactive' ? 0 : 1;
                $metaReqs = array_merge($metaReqs, [
                    'status' => $status
                ]);
            }

            $feeHeadType = $this->_mFeeHeadTypes::findOrFail($req->id);
            $feeHeadType->update($metaReqs);
            return responseMsgs(true, "Successfully Updated", [], "", "1.0", responseTime(), "POST", $req->deviceId ?? "");
        } catch (Exception $e) {
            return responseMsgs(false, $e->getMessage(), [], "", "1.0", responseTime(), "POST", $req->deviceId ?? "");
        }
    }

    /**
     * | Get Discont Group By Id
     */
    public function show(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'id' => 'required|numeric'
        ]);
        if ($validator->fails())
            return responseMsgs(false, $validator->errors(), []);
        try {
            $feeHeadType = $this->_mFeeHeadTypes::findOrFail($req->id);
            return responseMsgs(true, "", $feeHeadType, "", "1.0", responseTime(), "POST", $req->deviceId ?? "");
        } catch (Exception $e) {
            return responseMsgs(false, $e->getMessage(), [], "", "1.0", responseTime(), "POST", $req->deviceId ?? "");
        }
    }

    /**
     * | Retrieve All
     */
    public function retrieveAll(Request $req)
    {
        try {
            $feeHeadType = $this->_mFeeHeadTypes::orderByDesc('id')->get();
            return responseMsgs(true, "", $feeHeadType, "", "1.0", responseTime(), "POST", $req->deviceId ?? "");
        } catch (Exception $e) {
            return responseMsgs(false, $e->getMessage(), [], "", "1.0", responseTime(), "POST", $req->deviceId ?? "");
        }
    }
   
}
