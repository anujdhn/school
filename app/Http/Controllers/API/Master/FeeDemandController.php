<?php

namespace App\Http\Controllers\API\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Master\FeeDemand;
use Illuminate\Support\Str;
use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;


class FeeDemandController extends Controller
{
    private $_mFeeDemands;

    public function __construct()
    {
        $this->_mFeeDemands = new FeeDemand();
    }
    /**
     * | Created On-23-05-2023 
     * | Created By- Lakshmi Kumari
     * | Fee Head Type Crud Operations
    */

    public function store(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'fyId' => 'required|numeric',
            'monthNo' => 'required|numeric',
            'demandDate' => 'required|date',
            'studentId' => 'required|numeric',
            'classFeeMasterId' => 'required|numeric',
            'feeHead' => 'required|string',
            'amount' => 'required|numeric',
            'lateFee' => 'required|numeric',
            'paymentDate' => 'required|date',
            'paymentId' => 'required|numeric',
            'remark' => 'required|string',            
            'academicYear' => 'required|string'
        ]);
        if ($validator->fails())
            return responseMsgs(false, $validator->errors(), []);

        try {
            $isExists = $this->_mFeeDemands->readFeeDemandById($req->feeDemand);
            if (collect($isExists)->isNotEmpty())
                throw new Exception("Fee Demand Already existing");
            $ip = getClientIpAddress();
            $createdBy = 'Admin';
            $schoolId = 'DAV_Ranchi_834001';
            $metaReqs=[                
                'fy_id' => $req->fyId,
                'month_no' => $req->monthNo,
                'demand_date' => $req->demandDate,
                'student_id' => $req->studentId,
                'class_fee_master_id' => $req->classFeeMasterId,
                'fee_head' => $req->feeHead,
                'amount' => $req->amount,
                'late_fee' => $req->lateFee,
                'payment_date' => $req->paymentDate,
                'payment_id' => $req->paymentId,
                'remark' => $req->remark,                
                'academic_year' => $req->academicYear,
                'school_id' => $schoolId,
                'created_by' => $createdBy,
                'ip_address' => $ip
            ];
            $this->_mFeeDemands->store($metaReqs);
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
            'fyId' => 'required|numeric',
            'monthNo' => 'required|numeric',
            'demandDate' => 'required|date',
            'studentId' => 'required|numeric',
            'classFeeMasterId' => 'required|numeric',
            'feeHead' => 'required|string',
            'amount' => 'required|numeric',
            'lateFee' => 'required|numeric',
            'paymentDate' => 'required|date',
            'paymentId' => 'required|numeric',
            'remark' => 'required|string',
            'academicYear' => 'required|string',
            'status' => 'nullable|in:active,deactive'
        ]);
        if ($validator->fails())
            return responseMsgs(false, $validator->errors(), []);

        try {
            $isExists = $this->_mFeeDemands->readFeeDemandById($req->feeDemand);
            if ($isExists && $isExists->where('id', '!=', $req->id)->isNotEmpty())
                throw new Exception("Fee Demand Already Existing");
            $metaReqs = [ 
                'fy_id' => $req->fyId,
                'month_no' => $req->monthNo,
                'demand_date' => $req->demandDate,
                'student_id' => $req->studentId,
                'class_fee_master_id' => $req->classFeeMasterId,
                'fee_head' => $req->feeHead,
                'amount' => $req->amount,
                'late_fee' => $req->lateFee,
                'payment_date' => $req->paymentDate,
                'payment_id' => $req->paymentId,
                'remark' => $req->remark,
                'academic_year' => $req->academicYear,               
                'updated_at' => Carbon::now()
            ];

            if (isset($req->status)) {                  // In Case of Deactivation or Activation 
                $status = $req->status == 'deactive' ? 0 : 1;
                $metaReqs = array_merge($metaReqs, [
                    'status' => $status
                ]);
            }

            $feeDemand = $this->_mFeeDemands::findOrFail($req->id);
            $feeDemand->update($metaReqs);
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
            $feeDemand = $this->_mFeeDemands::findOrFail($req->id);
            return responseMsgs(true, "", $feeDemand, "", "1.0", responseTime(), "POST", $req->deviceId ?? "");
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
            $feeDemand = $this->_mFeeDemands::orderByDesc('id')->get();
            return responseMsgs(true, "", $feeDemand, "", "1.0", responseTime(), "POST", $req->deviceId ?? "");
        } catch (Exception $e) {
            return responseMsgs(false, $e->getMessage(), [], "", "1.0", responseTime(), "POST", $req->deviceId ?? "");
        }
    }
}
