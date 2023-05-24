<?php

namespace App\Http\Controllers\API\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Master\FeeHead;
use Illuminate\Support\Str;
use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;

class FeeHeadController extends Controller
{
    private $_mFeeHeads;

    public function __construct()
    {
        $this->_mFeeHeads = new feeHead();
    }
    /**
     * | Created On-24-05-2023 
     * | Created By- Lakshmi Kumari
     * | Fee Head Crud Operations
    */

    public function store(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'feeHeadTypeId' => 'required|numeric',
            'feeHead' => 'required|string',
            'description' => 'required|string',
            'academicYear' => 'required|string'
        ]);
        if ($validator->fails())
            return responseMsgs(false, $validator->errors(), []);

        try {
            $isExists = $this->_mFeeHeads->readFeeHeadById($req->feeHead);
            if (collect($isExists)->isNotEmpty())
                throw new Exception("Fee Head Already existing");
            $ip = getClientIpAddress();
            $createdBy = 'Admin';
            $schoolId = 'DAV_Ranchi_834001';
            $metaReqs=[                
                'fee_head_type_id' => $req->feeHeadTypeId,
                'fee_head' => Str::ucFirst($req->feeHead),
                'description' => $req->description,
                'academic_year' => $req->academicYear,
                'school_id' => $schoolId,
                'created_by' => $createdBy,
                'ip_address' => $ip
            ];
            $this->_mFeeHeads->store($metaReqs);
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
            'feeHeadTypeId' => 'required|numeric',
            'feeHead' => 'required|string',
            'description' => 'required|string',
            'academicYear' => 'required|string',
            'status' => 'nullable|in:active,deactive'
        ]);
        if ($validator->fails())
            return responseMsgs(false, $validator->errors(), []);

        try {
            $isExists = $this->_mFeeHeads->readFeeHeadById($req->feeHead);
            if ($isExists && $isExists->where('id', '!=', $req->id)->isNotEmpty())
                throw new Exception("Fee Head Already Existing");
            $metaReqs = [                 
                'fee_head_type_id' => $req->feeHeadTypeId,
                'fee_head' => Str::ucFirst($req->feeHead),
                'description' => $req->description,
                'academic_year' => $req->academicYear,
                'updated_at' => Carbon::now()
            ];

            if (isset($req->status)) {                  // In Case of Deactivation or Activation 
                $status = $req->status == 'deactive' ? 0 : 1;
                $metaReqs = array_merge($metaReqs, [
                    'status' => $status
                ]);
            }

            $feeHead = $this->_mFeeHeads::findOrFail($req->id);
            $feeHead->update($metaReqs);
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
            // $feeHead = $this->_mFeeHeads::findOrFail($req->id);
            $feeHead = $this->_mFeeHeads->showById($req->id);
            // print_r($feeHead);die;
            return responseMsgs(true, "", $feeHead, "", "1.0", responseTime(), "POST", $req->deviceId ?? "");
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
            // $feeHead = $this->_mFeeHeads::orderByDesc('id')->get();
            $feeHead = $this->_mFeeHeads->retrieveAll();
            return responseMsgs(true, "", $feeHead, "", "1.0", responseTime(), "POST", $req->deviceId ?? "");
        } catch (Exception $e) {
            return responseMsgs(false, $e->getMessage(), [], "", "1.0", responseTime(), "POST", $req->deviceId ?? "");
        }
    }
}
