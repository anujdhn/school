<?php

namespace App\Http\Controllers\API\master;

use App\Http\Controllers\Controller;
use App\Http\Requests\Masters\BusFeeReq;
use App\Models\Master\StudentBusfeeMaster;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentBusFeeController extends Controller
{
    /**
     * | Created On-24-05-2023 
     * | Author-Anshu Kumar
     * | Created for the Student Bus fee Crud Operations
     * | Status-Open
     */
    private $_mStudentBusFeeMaster;
    public function __construct()
    {
        $this->_mStudentBusFeeMaster = new StudentBusfeeMaster();
    }

    /**
     * | Add Record
     */
    public function store(BusFeeReq $req)
    {
        try {
            $isRecordExists = $this->_mStudentBusFeeMaster->getBusFeeByRefIds($req);
            if (collect($isRecordExists)->isNotEmpty())
                throw new Exception('Record Already Existing');
            $busFeeReqs = [
                "student_id" => $req->studentId,
                "class_id" => $req->classId,
                "availed_from" => $req->availedFrom,
                "availed_to" => $req->availedTo,
                "destination" => $req->destination,
                "destination_km" => $req->destinationKm,
                "bus_fee" => $req->busFee,
                "ip_address" => getClientIpAddress(),
                "created_by" => authUser()->id,
            ];
            $this->_mStudentBusFeeMaster->store($busFeeReqs);
            return responseMsgs(true, "Successfully Submitted", [], "", "1.0", responseTime(), "POST", $req->deviceId ?? "");
        } catch (Exception $e) {
            return responseMsgs(false, $e->getMessage(), [], "", "1.0", responseTime(), "POST", $req->deviceId ?? "");
        }
    }

    /**
     * | Edit Bus Fee
     */
    public function edit(BusFeeReq $req)
    {
        $validator = Validator::make($req->all(), [                     // Validation Merged
            'id' => 'required|integer',
            'status' => 'nullable|in:active,deactive'

        ]);
        if ($validator->fails())
            return responseMsgs(false, $validator->errors(), []);
        try {
            $isRecordExists = $this->_mStudentBusFeeMaster->getBusFeeByRefIds($req);
            if (collect($isRecordExists)->isNotEmpty()  && collect($isRecordExists)->where('id', '!=', $req->id)->isNotEmpty())
                throw new Exception('Record Already Existing');

            $studentBusFee = $this->_mStudentBusFeeMaster::findOrFail($req->id);
            $busFeeReqs = [
                "student_id" => $req->studentId,
                "class_id" => $req->classId,
                "availed_from" => $req->availedFrom,
                "availed_to" => $req->availedTo,
                "destination" => $req->destination,
                "destination_km" => $req->destinationKm,
                "bus_fee" => $req->busFee,
                "ip_address" => getClientIpAddress(),
                "created_by" => authUser()->id,
                "version_no" => $studentBusFee->version_no + 1
            ];
            if (isset($req->status)) {
                $status = ($req->status) == "active" ? 1 : 0;
                $busFeeReqs = array_merge($busFeeReqs, ["status" => $status]);
            }
            $studentBusFee->update($busFeeReqs);
            return responseMsgs(true, "Successfully Updated", [], "", "1.0", responseTime(), "POST", $req->deviceId ?? "");
        } catch (Exception $e) {
            return responseMsgs(false, $e->getMessage(), [], "", "1.0", responseTime(), "POST", $req->deviceId ?? "");
        }
    }

    /**
     * | Get Recordy by id
     */
    public function show(Request $req)
    {
        $validator = Validator::make($req->all(), [                     // Validation Merge
            'id' => 'required|integer'

        ]);
        if ($validator->fails())
            return responseMsgs(false, $validator->errors(), []);

        try {
            $studentBusFee = $this->_mStudentBusFeeMaster->getBusFeeById($req->id);
            return responseMsgs(true, "Student Bus Fee", $studentBusFee, "", "1.0", responseTime(), "POST", $req->deviceId ?? "");
        } catch (Exception $e) {
            return responseMsgs(false, $e->getMessage(), [], "", "1.0", responseTime(), "POST", $req->deviceId ?? "");
        }
    }

    /**
     * | Retrieve All Student Bus Fee
     */
    public function retrieveAll(Request $req)
    {
        try {
            $studentBusFee = $this->_mStudentBusFeeMaster->getAllBusFee($req->id);
            return responseMsgs(true, "Student Bus Fee", $studentBusFee, "", "1.0", responseTime(), "POST", $req->deviceId ?? "");
        } catch (Exception $e) {
            return responseMsgs(false, $e->getMessage(), [], "", "1.0", responseTime(), "POST", $req->deviceId ?? "");
        }
    }
}
