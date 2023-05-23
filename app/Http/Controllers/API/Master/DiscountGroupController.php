<?php

namespace App\Http\Controllers\API\Master;

use App\Http\Controllers\Controller;
use App\Models\Master\DiscountGroup;
use Exception;
use Illuminate\Http\Request;

class DiscountGroupController extends Controller
{
    private $_mDiscountGroups;

    public function __construct()
    {
        $this->_mDiscountGroups = new DiscountGroup();
    }
    /**
     * | Created On-23-05-2023 
     * | Author-Anshu Kumar
     * | Discount Group Crud Operations
     */
    public function store(Request $req)
    {
        try {
            $metaReqs = [
                "discount_group" => $req->discountGroup,
                "discount_percent" => $req->discountPercent,
                "description" => $req->description,
                "is_class_fee_discount" => $req->isClassFeeDiscount,
                "is_bus_fee_discount" => $req->isBusFeeDiscount
            ];
            $this->_mDiscountGroups->store($metaReqs);
            return responseMsgs(true, "Successfully Saved", [], "", "1.0", responseTime(), "POST", $req->deviceId ?? "");
        } catch (Exception $e) {
            return responseMsgs(false, $e->getMessage(), [], "", "1.0", responseTime(), "POST", $req->deviceId ?? "");
        }
    }
}
