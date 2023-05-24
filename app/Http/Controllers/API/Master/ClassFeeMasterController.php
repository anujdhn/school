<?php

namespace App\Http\Controllers\API\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Master\ClassFeeMaster;
use Illuminate\Support\Str;
use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;

class ClassFeeMasterController extends Controller
{
    private $_mClassFeeMasters;

    public function __construct()
    {
        $this->_mClassFeeMasters = new classFeeMaster();
    }
    /**
     * | Created On-23-05-2023 
     * | Created By- Lakshmi Kumari
     * | Fee Head Type Crud Operations
    */

    public function store(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'classId' => 'required|numeric',
            'feeHeadId' => 'required|numeric',
            'feeAmount' => 'required|numeric',
            'discount' => 'required|numeric',
            'netFee' => 'required|numeric',
            'leviedInJan' => 'required|numeric',
            'leviedInFeb' => 'required|numeric',
            'leviedInMar' => 'required|numeric',
            'leviedInApr' => 'required|numeric',
            'leviedInMay' => 'required|numeric',
            'leviedInJun' => 'required|numeric',
            'leviedInJul' => 'required|numeric',
            'leviedInAug' => 'required|numeric',
            'leviedInSep' => 'required|numeric',
            'leviedInOct' => 'required|numeric',
            'leviedInNov' => 'required|numeric',
            'leviedInDec' => 'required|numeric'
        ]);
        if ($validator->fails())
            return responseMsgs(false, $validator->errors(), []);

        try {
            $isMappingExists = $this->_mClassFeeMasters->getClassFeeMasterGroupMaps($req);
            if (collect($isMappingExists)->isNotEmpty())
                throw new Exception('Record Already Existing');
            // $isExists = $this->_mClassFeeMasters->readClassFeeMasterGroup($req->classFeeMaster);
            // if (collect($isExists)->isNotEmpty())
            //     throw new Exception("Class Fee Master Already existing");
            $fy =  getFinancialYear(Carbon::now()->format('Y-m-d'));
            $metaReqs=[                
                'class_id' => $req->classId,
                'fee_head_id' => $req->feeHeadId,
                'fee_amount' => $req->feeAmount,
                'discount' => $req->discount,
                'net_fee' => $req->netFee,
                'levied_in_jan' => $req->leviedInJan,
                'levied_in_feb' => $req->leviedInFeb,
                'levied_in_mar' => $req->leviedInMar,
                'levied_in_apr' => $req->leviedInApr,
                'levied_in_may' => $req->leviedInMay,
                'levied_in_jun' => $req->leviedInJun,
                'levied_in_jul' => $req->leviedInJul,
                'levied_in_aug' => $req->leviedInAug,
                'levied_in_sep' => $req->leviedInSep,
                'levied_in_oct' => $req->leviedInOct,
                'levied_in_nov' => $req->leviedInNov,
                'levied_in_dec' => $req->leviedInDec,
                'academic_year' => $fy,
                'school_id' => authUser()->school_id,
                'created_by' => authUser()->id,
                'ip_address' => getClientIpAddress()
            ];
            $this->_mClassFeeMasters->store($metaReqs);
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
            'classId' => 'required|numeric',
            'feeHeadId' => 'required|numeric',
            'feeAmount' => 'required|numeric',
            'discount' => 'required|numeric',
            'netFee' => 'required|numeric',
            'leviedInJan' => 'required|numeric',
            'leviedInFeb' => 'required|numeric',
            'leviedInMar' => 'required|numeric',
            'leviedInApr' => 'required|numeric',
            'leviedInMay' => 'required|numeric',
            'leviedInJun' => 'required|numeric',
            'leviedInJul' => 'required|numeric',
            'leviedInAug' => 'required|numeric',
            'leviedInSep' => 'required|numeric',
            'leviedInOct' => 'required|numeric',
            'leviedInNov' => 'required|numeric',
            'leviedInDec' => 'required|numeric',
            'status' => 'nullable|in:active,deactive'
        ]);
        if ($validator->fails())
            return responseMsgs(false, $validator->errors(), []);

        try {
            $isMappingExists = $this->_mClassFeeMasters->getClassFeeMasterGroupMaps($req);
            if (collect($isMappingExists)->isNotEmpty() && $isMappingExists->where('id', '!=', $req->id)->isNotEmpty())
                throw new Exception('Record Already Existing');

            $getData = $this->_mClassFeeMasters::findOrFail($req->id);

            // $isExists = $this->_mClassFeeMasters->readClassFeeMasterGroup($req->classFeeMaster);
            // if ($isExists && $isExists->where('id', '!=', $req->id)->isNotEmpty())
            //     throw new Exception("Class Fee Master Already Existing");
            // $getData = $this->_mClassFeeMasters::findOrFail($req->id);
            $metaReqs = [ 
                'fee_amount' => $req->feeAmount,
                'discount' => $req->discount,
                'net_fee' => $req->netFee,
                'levied_in_jan' => $req->leviedInJan,
                'levied_in_feb' => $req->leviedInFeb,
                'levied_in_mar' => $req->leviedInMar,
                'levied_in_apr' => $req->leviedInApr,
                'levied_in_may' => $req->leviedInMay,
                'levied_in_jun' => $req->leviedInJun,
                'levied_in_jul' => $req->leviedInJul,
                'levied_in_aug' => $req->leviedInAug,
                'levied_in_sep' => $req->leviedInSep,
                'levied_in_oct' => $req->leviedInOct,
                'levied_in_nov' => $req->leviedInNov,
                'levied_in_dec' => $req->leviedInDec,
                'version_no' => $getData->version_no + 1,
                'updated_at' => Carbon::now()
            ];

            if (isset($req->status)) {                  // In Case of Deactivation or Activation 
                $status = $req->status == 'deactive' ? 0 : 1;
                $metaReqs = array_merge($metaReqs, [
                    'status' => $status
                ]);
            }

            $classFeeMaster = $this->_mClassFeeMasters::findOrFail($req->id);
            $classFeeMaster->update($metaReqs);
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
            // $classFeeMaster = $this->_mClassFeeMasters::findOrFail($req->id);
            $classFeeMastersGroupMap = $this->_mClassFeeMasters->getGroupMapById($req->id);
            return responseMsgs(true, "Records", $classFeeMastersGroupMap, "", "1.0", responseTime(), "POST", $req->deviceId ?? "");
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
            // $classFeeMaster = $this->_mClassFeeMasters::orderByDesc('id')->get();
            $classFeeMastersGroupMap = $this->_mClassFeeMasters->retrieveAll();
            return responseMsgs(true, "All Records", $classFeeMastersGroupMap, "", "1.0", responseTime(), "POST", $req->deviceId ?? "");
        } catch (Exception $e) {
            return responseMsgs(false, $e->getMessage(), [], "", "1.0", responseTime(), "POST", $req->deviceId ?? "");
        }
    }
}
