<?php

namespace App\BLL\DemandMaster;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

/*=================================================== Demand =========================================================
Created By : Lakshmi kumari 
Created On : 20-May-2023 
Code Status : Open 
*/

class demandMaster{
    public array $_feeHead;
    public array $_feeMaster;
    public array $_feeScholarshipStudent;
    public array $_feeConcessionType;
    public array $_feeConcession;
    // public array $_feeDues;
    // public array $_feeLateFine;
    public array $_feeScholarshipClass;
    public array $_feeCollection;

    public function demFeeHead($req){
        try{
            $this->_propertyDetails = $req->all();
            $this->readFeeHeadData();                   //for master data of fee head  
            $this->readFeeMasterData();                 //for fee master 
            $this->readFeeScholarshipStudentData();     //for scholarship student wise data 
            $this->readFeeScholarshipClassData();                //for scholarship class wise  data
            $this->readFeeCollectionData();                   //for fee collections 
            $this->readFeeConcessionData();                   //for fee concession data 
            $this->readFeeConcessionTypeData();                   //for fee concession type data 
        }catch (Exception $e) {
            return responseMsg(false, $e->getMessage(), "");
        }
    }

    public function readFeeHeadData()
    {
        $feeHead = $this->_feeHead['feeHead'];
        if (!$feeHead) {
            $feeHeadValue = FeeHead::select('id', 'fee_head_name', 'fee_head_c_name', 'fee_code')    // Get fee head value from DB
            // ->where('zone_id', $readZoneId)
            ->where('is_deleted', 1)
            ->get();
        }
        return $feeHeadValue;
    }

    public function readFeeMasterData(){
        // $readPropertyType = $this->_propertyDetails['propertyType'];
        // if ($readPropertyType == $this->_vacantPropertyTypeId) {
        //     $calculateQuaterlyRuleSets = $this->calculateQuaterlyRulesets("vacantLand");
        //     $ruleSetsWithMobileTower = collect($this->_mobileQuaterlyRuleSets)->merge($calculateQuaterlyRuleSets);        // Collapse with mobile tower
        //     $ruleSetsWithHoardingBoard = collect($this->_hoardingQuaterlyRuleSets)->merge($ruleSetsWithMobileTower);      // Collapse with hoarding board
        //     $this->_GRID['details'] = $ruleSetsWithHoardingBoard;
        // }
        //eloquent->property->safcalculatio
    }
}