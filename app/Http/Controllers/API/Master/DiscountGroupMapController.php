<?php

namespace App\Http\Controllers\API\Master;

use App\Http\Controllers\Controller;
use App\Http\Requests\Masters\DiscountGroupMapReq;
use App\Models\Master\DiscountGroupMap;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DiscountGroupMapController extends Controller
{
    /**
     * | Created On-24-05-2023 
     * | Author-Anshu Kumar
     * | Discount Group Mapping Crud Operations
     */

    private $_mDiscountGroupMap;

    public function __construct()
    {
        $this->_mDiscountGroupMap = new DiscountGroupMap();
    }

    /**
     * | Add Record
     */
    public function store(DiscountGroupMapReq $req)
    {
        try {
            $isMappingExists = $this->_mDiscountGroupMap->getDiscountGroupMaps($req);
            if (collect($isMappingExists)->isNotEmpty())
                throw new Exception('Record Already Existing');
            $metaReq = [
                "student_id" => $req->studentId,
                "discount_group_id" => $req->discountGroupId,
                "discount_percent" => $req->discountPercent,
                "class_fee_id" => $req->classFeeId,
                "ip_address" => getClientIpAddress(),
                "created_by" => authUser()->id
            ];
            $this->_mDiscountGroupMap->store($metaReq);
            return responseMsgs(true, "Successfully Submitted", [], "", "1.0", responseTime(), "POST", $req->deviceId ?? "");
        } catch (Exception $e) {
            return responseMsgs(false, $e->getMessage(), [], "", "1.0", responseTime(), "POST", $req->deviceId ?? "");
        }
    }


    /**
     * | Edit
     */
    public function edit(DiscountGroupMapReq $req)
    {
        $validator = Validator::make($req->all(), [                     // Validation Merged
            'id' => 'required|integer',
            'status' => 'nullable|in:active,deactive'

        ]);
        if ($validator->fails())
            return responseMsgs(false, $validator->errors(), []);

        try {
            $isMappingExists = $this->_mDiscountGroupMap->getDiscountGroupMaps($req);
            if (collect($isMappingExists)->isNotEmpty() && $isMappingExists->where('id', '!=', $req->id)->isNotEmpty())
                throw new Exception('Record Already Existing');

            $discountGroup = $this->_mDiscountGroupMap::findOrFail($req->id);
            $metaReq = [
                "student_id" => $req->studentId,
                "discount_group_id" => $req->discountGroupId,
                "discount_percent" => $req->discountPercent,
                "class_fee_id" => $req->classFeeId,
                "ip_address" => getClientIpAddress(),
                "created_by" => authUser()->id,
                "version_no" => $discountGroup->version_no + 1
            ];
            if (isset($req->status)) {
                $status = ($req->status) == "active" ? 1 : 0;
                $metaReq = array_merge($metaReq, ["status" => $status]);
            }
            $discountGroup->update($metaReq);
            return responseMsgs(true, "Successfully Updated The Record", [], "", "1.0", responseTime(), "POST", $req->deviceId ?? "");
        } catch (Exception $e) {
            return responseMsgs(false, $e->getMessage(), [], "", "1.0", responseTime(), "POST", $req->deviceId ?? "");
        }
    }

    /**
     * | Show
     */
    public function show(Request $req)
    {
        $validator = Validator::make($req->all(), [                     // Validation Merge
            'id' => 'required|integer'

        ]);
        if ($validator->fails())
            return responseMsgs(false, $validator->errors(), []);

        try {
            $discountGroupMap = $this->_mDiscountGroupMap->getGroupMapById($req->id);
            return responseMsgs(true, "Discount Group Details", $discountGroupMap, "", "1.0", responseTime(), "POST", $req->deviceId ?? "");
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
            $discountGroups = $this->_mDiscountGroupMap->retrieveAll();
            return responseMsgs(true, "Discount Groups", $discountGroups, "", "1.0", responseTime(), "POST", $req->deviceId ?? "");
        } catch (Exception $e) {
            return responseMsgs(false, $e->getMessage(), [], "", "1.0", responseTime(), "POST", $req->deviceId ?? "");
        }
    }
}
