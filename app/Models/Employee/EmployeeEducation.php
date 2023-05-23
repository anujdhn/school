<?php

namespace App\Models\Employee;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Exception;

class EmployeeEducation extends Model
{
    use HasFactory;
    protected $table = 'employee_educations';

    protected $fillable = [      
      'exam_passed_id',
      'exam_passed_name',
      'board_uni_inst',
      'passing_year',
      'div_grade_id',
      'div_grade_name',
      'marks_obtained',
      'total_marks',
      'percentage',
      'upload_edu_doc'
    ];

    //insert
    public function insertData($req) {
        // $userId = authUser()->id; 
        $mObject = new EmployeeEducation();        
        $insert = [
            $mObject->emp_tbl_id = $emp_tbl_id,
            $mObject->exam_passed_id = $req['exam_passed_id'],
            $mObject->exam_passed_name = $req['exam_passed_name'],
            $mObject->board_uni_inst = $req['board_uni_inst'],
            $mObject->passing_year = $req['passing_year'],
            $mObject->div_grade_id = $req['div_grade_id'],
            $mObject->div_grade_name = $req['div_grade_name'],
            $mObject->marks_obtained = $req['marks_obtained'],
            $mObject->total_marks = $req['total_marks'],
            $mObject->percentage = $req['percentage'],
            $mObject->upload_edu_doc = $req['upload_edu_doc']
        ];
        $mObject->save($insert);
        return $mObject;
      }

      //using id generator
      // public function empId(){
      //   $empData = new Employee();
      //   $emp_id['empId'] = $empData->emp_id;
      //   $id = IdGenerator::generate([
      //     'table' => 'class_tables',
      //     'field' => 'student_id',
      //     'length' => 11,
      //     'prefix' => $req->class.'/'.date('y').'/',
      //     'reset_on_prefix_change' => true,
      //   ]);        
      // }
      
      //view all 
      public static function list() {
        $viewAll = EmployeeEducation::select(
        'emp_tbl_id',
        'exam_passed_id',
        'exam_passed_name',
        'board_uni_inst',
        'passing_year',
        'div_grade_id',
        'div_grade_name',
        'marks_obtained',
        'total_marks',
        'percentage',
        'upload_edu_doc'
        )
        ->orderBy('id','desc')->get();    
        return $viewAll;
      }
  
      //view by id
      public function listById($req) {
        $data = EmployeeEducation::select(
            'id',
            'emp_tbl_id',
            'exam_passed_id',
            'exam_passed_name',
            'board_uni_inst',
            'passing_year',
            'div_grade_id',
            'div_grade_name',
            'marks_obtained',
            'total_marks',
            'percentage',
            'upload_edu_doc'
            )
            ->where('id', $req->id)
            ->get();
            return $data;     
      }   
  
      // //update
      // public function updateData($req) {
      //   $data = EmployeeEducation::find($req->id);
      //   if (!$data)
      //         throw new Exception("Records Not Found!");
      //   $edit = [
      //     'exam_passed_id' => $req->exam_passed_id,
      //     'exam_passed_name' => $req->exam_passed_name,
      //     'board_uni_inst' => $req->board_uni_inst,
      //     'passing_year' => $req->passing_year,
      //     'div_grade_id' => $req->div_grade_id,
      //     'div_grade_name' => $req->div_grade_name,
      //     'marks_obtained' => $req->marks_obtained,
      //     'total_marks' => $req->total_marks,
      //     'percentage' => $req->percentage,
      //     'upload_edu_doc' => $req->upload_edu_doc
      //   ];
      //   $data->update($edit);
      //   return $data;        
      // }
  
      // //delete 
      // public function deleteData($req) {
      //   $data = EmployeeEducation::find($req->id);
      //   $data->is_deleted = "1";
      //   $data->save();
      //   return $data; 
      // }
  
      // //truncate
      // public function truncateData() {
      //   $data = EmployeeEducation::truncate();
      //   return $data;        
      // } 
}
