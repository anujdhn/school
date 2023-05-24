<?php

namespace App\Http\Controllers\API\Master;

use App\Http\Controllers\Controller;
use App\Models\Master\DiscountGroup;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


/**
 * | Created On-23-05-2023 
 * | Author-Anshu Kumar
 * | Discount Group Crud Operations
 */
class DiscountGroupController extends Controller
{
    private $_mDiscountGroups;

    public function __construct()
    {
        $this->_mDiscountGroups = new DiscountGroup();
    }

    /**
     * | Store Discount Groups
     */
    public function store(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'discountGroup' => 'required|string',
            'discountPercent' => 'required|numeric',
            'description' => 'required|string',
            'isClassFeeDiscount' => 'required|bool',
            'isBusFeeDiscount' => 'required|bool',
        ]);
        if ($validator->fails())
            return responseMsgs(false, $validator->errors(), []);

        try {
            $fYear = getFinancialYear(Carbon::now()->format('Y-m-d'));
            $isGroupExists = $this->_mDiscountGroups->readGroupByDiscountGroup($req->discountGroup, $req->academicYear);
            if (collect($isGroupExists)->isNotEmpty())
                throw new Exception("Discount Group Already existing");
            $metaReqs = [
                "discount_group" => $req->discountGroup,
                "discount_percent" => $req->discountPercent,
                "description" => $req->description,
                "is_class_fee_discount" => $req->isClassFeeDiscount,
                "is_bus_fee_discount" => $req->isBusFeeDiscount,
                'school_id' => authUser()->school_id,
                'ip_address' => getClientIpAddress(),
                'academic_year' => $fYear,
                'created_by' => authUser()->id
            ];
            $this->_mDiscountGroups->store($metaReqs);
            return responseMsgs(true, "Successfully Saved", [], "", "1.0", responseTime(), "POST", $req->deviceId ?? "");
        } catch (Exception $e) {
            return responseMsgs(false, $e->getMessage(), [], "", "1.0", responseTime(), "POST", $req->deviceId ?? "");
        }
    }


    /**
     * | Update Discount Group
     */
    public function edit(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'id' => 'required|numeric',
            'discountGroup' => 'required|string',
            'discountPercent' => 'required|numeric',
            'description' => 'required|string',
            'isClassFeeDiscount' => 'required|bool',
            'isBusFeeDiscount' => 'required|bool',
            'status' => 'nullable|in:active,deactive'
        ]);
        if ($validator->fails())
            return responseMsgs(false, $validator->errors(), []);

        try {
            $fYear = getFinancialYear(Carbon::now()->format('Y-m-d'));
            $isGroupExists = $this->_mDiscountGroups->readGroupByDiscountGroup($req->discountGroup, $req->academicYear);
            if ($isGroupExists && $isGroupExists->where('id', '!=', $req->id)->isNotEmpty())
                throw new Exception("Discount Group Already Existing");

            $discountGroup = $this->_mDiscountGroups::findOrFail($req->id);

            $metaReqs = [
                "discount_group" => $req->discountGroup,
                "discount_percent" => $req->discountPercent,
                "description" => $req->description,
                "is_class_fee_discount" => $req->isClassFeeDiscount,
                "is_bus_fee_discount" => $req->isBusFeeDiscount,
                'school_id' => authUser()->school_id,
                'academic_year' => $fYear,
                'version_no' => $discountGroup->version_no + 1
            ];

            if (isset($req->status)) {                  // In Case of Deactivation or Activation of Discount Group
                $status = $req->status == 'deactive' ? 0 : 1;
                $metaReqs = array_merge($metaReqs, [
                    'status' => $status
                ]);
            }

            $discountGroup->update($metaReqs);
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
            $discountGroup = $this->_mDiscountGroups->getGroupById($req->id);
            return responseMsgs(true, "", $discountGroup, "", "1.0", responseTime(), "POST", $req->deviceId ?? "");
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
            $discountGroup = $this->_mDiscountGroups->retrieveAll();
            return responseMsgs(true, "", $discountGroup, "", "1.0", responseTime(), "POST", $req->deviceId ?? "");
        } catch (Exception $e) {
            return responseMsgs(false, $e->getMessage(), [], "", "1.0", responseTime(), "POST", $req->deviceId ?? "");
        }
    }
}
