<?php

namespace App\Http\Controllers;

use TCPDF;
use App\Models\User;
use App\Models\Zone;
use Illuminate\Http;
use App\Models\Guest;
use App\Models\Semester;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Query\Builder;
use Illuminate\Database\QueryException;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class AttendanceController extends Controller
{
    //   INDEX
    public function index()
    {
        //
        $attendances = Semester::active_semester()->attendance_sessions->sortBy('semester_program_id');
        return view('attendance.index', ['attendances' => $attendances]);
    }

    // CREATE
    public function create()
    {
        //
    }

    // STORE
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'semester_program_id' => ['required'],
        ]);
        $validated['semester_id'] = Semester::active_semester()->id;

        
        try{
            
            // Attendance::create($validated);
            $attendance = new Attendance;
            $attendance['semester_program_id'] = $validated['semester_program_id'];
            $attendance['semester_id'] = $validated['semester_id'];
            $attendance->save();
            
        } catch (QueryException $e) {
            Log::error($e);
        
            $errorCode = $e->errorInfo[1];
        
            // Check if the error code corresponds to a unique constraint violation
            if ($errorCode == 1062) {
                // Redirect to a custom error page for duplicate entry
                return redirect()->back()->with('warning', 'Session Already Exists');
            }
        
            // If it's not a unique constraint violation, you can handle other database-related errors here
            // ...
        
            // Re-throw the exception if it's not a unique constraint violation
            throw $e;
        }

        return redirect(route('attendance'))->with('success','Attendance Session Created Successfully');

    }

    // USERS
    // Show member present for a particular attendance session
    public function show_attendance_users(Attendance $attendance)
    {
        //
        $members = $attendance->users()->paginate(
            $perPage = 50, $columns = ['*'], $pageName = 'AttendanceSessions'
        );

        return view('attendance.attendance-users.show', ['attendance' => $attendance, 'members' => $members]);
    }


    // Attendance Qr Scan Page
    public function attendance_qr_page(Attendance $attendance){
        return view('attendance/qr',['attendance'=>$attendance]);
    }

    // Check or uncheck User
    public function check_user(Attendance $attendance, User $user)
    {

        DB::table('attendance_users')->updateOrInsert([
            'attendance_id' => $attendance->id,
            'person_id' => $user->id,
            'is_user' => 1],
            [
            'is_present' => 1,
            'checked_by' => Auth::user()->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        return view('attendance.attendance-users.components.users.updated-row', ['member' => $user, 'attendance' => $attendance]);
    }

    // Check or uncheck User
    public function uncheck_user(Attendance $attendance, User $user)
    {
        DB::table('attendance_users')->updateOrInsert([
            'attendance_id' => $attendance->id,
            'person_id' => $user->id,
            'is_user' => 1],
            [
            'is_present' => 0,
            'checked_by' => Auth::user()->id,
            'updated_at' => now(),
        ]);


        return redirect()->back()->with('success', 'Uncheck Successful');
    }

    // Confirm User Uncheck
    public function confirm_uncheck_user(Attendance $attendance, User $user)
    {

        return view('attendance.attendance-users.components.checked-users.confirm-uncheck-user', ['member' => $user, 'attendance' => $attendance]);
    }

    // Search Users who've been checked already
    public function search_attendance_checked_users(Request $request, Attendance $attendance)
    {
        $members = User::search_user($request)
            ->get()
            ->intersect($attendance->members()->get());

        return view('attendance.attendance-users.components.checked-users.search_results', ['members' => $members, 'attendance' => $attendance]);

    }

    // Search User (marked or unmarked) on attendance table
    public function search_attendance_users(Attendance $attendance, Request $request)
    {

        $members = User::search_user($request)
                    ->where('is_member', 1)
                    ->where('is_available', 1)
                    ->paginate($perPage = 25, $columns = ['*'], $pageName = 'SearchResults');

        return view('attendance.attendance-users.components.users.search-results', ['members' => $members, 'attendance' => $attendance]);
    }

    // Register User as Visitor
    public function register_user_visitor(Request $request, Attendance $attendance)
    {
        $validated = $request->validate([
            'user_id' => ['required', 'numeric'],
        ]);
        DB::table('attendance_users')->insertOrIgnore([
            'attendance_id' => $attendance->id,
            'person_id' => $validated['user_id'],
            'is_user' => 1,
            'checked_by' => Auth::user()->id,
        ]);

        return redirect(route('access_attendance_session', $attendance))->with('success', 'Visitor Added Successfully');

    }

    // Register Guest as Visitor
    public function register_guest_visitor(Request $request, Attendance $attendance)
    {
        $validated = $request->validate([
            'guest_name' => ['required', 'min:6'],
            'guest_gender' => ['required', 'max:1'],
            'is_member' => ['required', 'max:1', 'numeric'],
            'local_congregation' => ['required', 'min:2'],
            'contact' => ['nullable', 'max:13', 'min:10'],
            'purpose' => ['nullable', 'min:4'],
        ]);
        // Create A new Guest instance
        $guest = new Guest;
        $guest['fullname'] = $validated['guest_name'];
        $guest['local_congregation'] = $validated['local_congregation'];
        $guest['is_member'] = $validated['is_member'];
        $guest['gender'] = $validated['guest_gender'];
        $guest['contact'] = $validated['contact'];
        $guest['purpose'] = $validated['purpose'];
        $guest['username'] = now();
        $guest->save();

        // Now, Create the attendance_guest instance
        DB::table('attendance_users')->insertOrIgnore([
            'attendance_id' => $attendance->id,
            'person_id' => $guest->id,
            'is_user' => 0,
            'checked_by' => Auth::user()->id,
        ]);

        return redirect(route('access_attendance_session', $attendance))->with('success', 'Visitor Added Successfully');

    }

    // Uncheck Guest
    public function uncheck_guest_visitor(Attendance $attendance, Guest $guest)
    {
        DB::table('attendance_users')
            ->where('attendance_id', $attendance->id)
            ->where('person_id', $guest->id)
            ->where('is_user', 0)
            ->delete();

        return redirect()->back()->with('success', 'Guest Uncheck Successful');

        // return view('attendance.attendance-users.components.users.updated-row', ['member' => $user, 'attendance' => $attendance]);
    }

    // Confirm Uncheck Guest
    public function confirm_uncheck_guest(Attendance $attendance, Guest $guest)
    {
        return view('attendance.attendance-users.components.guests.confim-guest-uncheck', ['guest' => $guest, 'attendance' => $attendance]);
    }

    // ATTENDANCE SESSION
    // Access the attendance session to check user
    public function access_attendance_session(Attendance $attendance)
    {
        $users = User::where('is_member', 1)->where('is_available',1)
            ->paginate(
                $perPage = 25, $columns = ['*'], $pageName = 'Users'
            );

        return view('attendance.attendance-users.create', ['members' => $users, 'attendance' => $attendance]);
    }

    // Cofirm Attendance Switch/toggle
    public function confirm_attendance_switch(Attendance $attendance)
    {
        return view('attendance.components.attendance.confirm-attendance-switch', ['attendance' => $attendance]);
    }

    // Switch Attendance Session on or off
    public function switch_attendance_session(Attendance $attendance)
    {
        if ($attendance->is_active == 1) {
            // If attendance has no records of absentees, that is the first time it's being switched after creation
                if($attendance->hasAbsentees()){
                    " ";
                }else{
                   
                    foreach(User::where('is_member',1)->get() as $member ){
                        DB::table('attendance_users')->insertOrIgnore([
                            'attendance_id'=>$attendance->id,
                            'person_id'=>$member->id,
                            'is_user'=>1,
                            'is_present'=>$member->is_available == '1' ? '0' : '2',
                             'reason' => $member->is_available == '0' ? ($member->unavailable_member_info() == null ? "None" : $member->unavailable_member_info() ) : 'none', 
                            'checked_by'=>auth()->user()->id,

                        ]);
                    }
                }

            $attendance['is_active'] = 0;
            $attendance->save();
            return redirect()->back()->with('warning', 'Attendance Session Ended');


        } else {
            $attendance['is_active'] = 1;
            $attendance->save();
        return redirect()->back()->with('success', 'Attendance Now In Session');

        }

    }

    // Search Attendance session
    public function search_attendance(Semester $semester, Request $request)
    {
        $attendances = Attendance::search_attendance($semester,$request);

        return view('attendance.components.attendance.search-results', ['attendances' => $attendances]);

    }

    // Confirm Attendance Reset
    public function confirm_attendance_reset(Attendance $attendance)
    {
        return view('attendance.components.attendance.confirm-attendance-reset', ['attendance' => $attendance]);
    }

    // Reset Attendance
    public function reset_attendance(Attendance $attendance)
    {
        $new_attendance = $attendance;
        $attendance->delete();
        $new_attendance->save();

        return redirect(route('attendance'))->with('success', 'Attendance Session Reset Successful');
    }

    // Confirm Attendance Delete
    public function confirm_attendance_delete(Attendance $attendance)
    {
        return view('attendance.components.attendance.confirm-attendance-delete', ['attendance' => $attendance]);
    }

    // Reset Attendance
    public function delete_attendance(Attendance $attendance)
    {
        $attendance->delete();

        return redirect(route('attendance'))->with('success', 'Deletion Successful');
    }

    // Show Absentees
    public function show_absentees(Attendance $attendance){
        $absentees = $attendance->all_absentees()->paginate(25);
        return view('attendance.attendance-users.components.absentees.index',['attendance'=>$attendance, 'absentees'=>$absentees]);
    }

    // Confrim User Check - Absentees - Modal
    public function confirm_check_user(Attendance $attendance, User $user){
        return view('attendance.attendance-users.components.absentees.confirm-check-user',['attendance'=>$attendance,'user'=>$user]);
    }

    // Check  Absentee
    public function check_absentee(Attendance $attendance, User $user)
    {

        DB::table('attendance_users')->updateOrInsert([
            'attendance_id' => $attendance->id,
            'person_id' => $user->id,
            'is_user' => 1],
            [
            'is_present' => 1,
            'checked_by' => Auth::user()->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        return redirect()->back()->with('success','Member Marked Present');
    }

    // Search Absentee
    public function search_absentees(Request $request, Attendance $attendance){
        $absentees = User::search_user($request)->get()
                    ->intersect($attendance->all_absentees()->get());
        return view('attendance.attendance-users.components.absentees.search-results',['absentees'=>$absentees,'attendance'=>$attendance]);

    }

    // Confirm Print Attendnace
    public function confirm_print_absentees(Attendance $attendance,  Request $request){
        $zone =  Zone::findByName($request['zone']);
        if(!$zone){
            return view('attendance.attendance-users.components.absentees.confirm-print-absentees',['attendance'=>$attendance, 'name'=>'all' , 'back'=>"show_absentees"]);
        }else{
            return view('attendance.attendance-users.components.absentees.confirm-print-absentees',['attendance'=>$attendance, 'zone'=>$zone , 'back'=>"show_absentees"]);
        }


    }

    // Filter Absentees
    public function filter_absentees(Request $request, Attendance $attendance){
        $zone = Zone::findByName($request->input('str'));
        // if nothing is selected
        if(!$zone){
            $absentees = $attendance->all_absentees()->paginate(50);
        }else{
            $absentees = $attendance->zone_absentees($zone);
        }
        return view('attendance.attendance-users.components.absentees.search-results',['absentees'=>$absentees,'attendance'=>$attendance]);
    }

    // Needed by the Excel Spreadsheet
    private function writeToBuffer($spreadsheet)
    {
        ob_start();
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        return ob_get_clean();
    }

    // Print Absentee file
    public function print_absentee_file(Attendance $attendance, Zone $zone, Request $request){
        if ($request['file_type'] == 'pdf'){

                // Create PDF document
                $pdf = new TCPDF();
        
                // Set document information
                $pdf->SetCreator(PDF_CREATOR);
                $pdf->SetAuthor('Knust-CoC Management System');
                $pdf->SetTitle($zone->name.' Absentees - '.$attendance->created_at->format('Y-m-D-d'));
                $pdf->SetSubject('Absentees');
                $pdf->SetKeywords('TCPDF, PDF, example, test, guide');
        
                // Add a page
                $pdf->AddPage();

                $pdf->SetFont('helvetica', '', 12);

                // Table Heading
                $pdf->Cell(40, 10, 'Name', 1);
                $pdf->Cell(40, 10, 'Year', 1);
                $pdf->Cell(40, 10, 'Residence', 1);

                // Output table
                foreach ($attendance->zone_absentees($zone) as $member) {
                    $pdf->Cell(40, 10, $member->fullname(), 1);
                    $pdf->Cell(40, 10, $member->year() == null ? "None" : $member->year(), 1);
                    $pdf->Cell(40, 10, $member->biodata != null ? $member->biodata->residence->name : "None", 1);
                    $pdf->Ln(); // Move to the next line after each row
                }
                $pdf->Output($zone->name.' Absentees - '.$attendance->created_at->format('Y-m-D-d').'.pdf', 'D');

                return redirect()->back()->with('success','Download Successful. Check Downloads');

        }elseif($request['file_type'] == 'excel') {
    
            // Create a new Spreadsheet
            $spreadsheet = new Spreadsheet();
    
            // Set active sheet
            $spreadsheet->setActiveSheetIndex(0);
            $sheet = $spreadsheet->getActiveSheet();
    
            // Add headers
            $headers = ['Full Name', 'Year', 'Residence'];
            foreach ($headers as $colIndex => $header) {
                $sheet->setCellValueByColumnAndRow($colIndex + 1, 1, $header);
            }
    
            // Add data to the sheet
            $rowIndex = 2; // Start from the second row (after headers)
            foreach ($attendance->zone_absentees($zone) as $member) {
                $sheet->setCellValueByColumnAndRow(1, $rowIndex, $member->fullname());
                $sheet->setCellValueByColumnAndRow(2, $rowIndex, $member->year() == null ? "None" : $member->year());
                $sheet->setCellValueByColumnAndRow(3, $rowIndex, $member->biodata != null ? $member->biodata->residence->name : "None");
                $rowIndex++;
            }
    
            // Set headers for download
            $headers = [
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                'Content-Disposition' => 'attachment; filename="'.$zone->name.' Absentees - '.$attendance->created_at->format('Y-m-D-d').'.xlsx"',
            ];
    
            // Create a response with the Excel file
            $response = response($this->writeToBuffer($spreadsheet), 200, $headers);
    
            return $response;
        }
    }

    // Edit Absentee Status
    public function edit_absentee_status(Attendance $attendance, User $user){
        return view('attendance\attendance-users\components\absentees\edit-status',['user'=>$user , 'attendance'=>$attendance]);
    }

    // Update Absentee Status
    public function udpate_absentee_status(Attendance $attendance, User $user, Request $request){
        $validated = $request->validate([
            'is_present'=>['required','numeric'],
            'reason'=>['nullable']
        ]);
            // If member was not available but no reason was given
            if($validated['is_present'] == 2 && $validated['reason'] == null ){

                return redirect()->back()->with('warning','No Reason Was provided for absence');
    
                // If a reason is given tho
            }elseif($validated['is_present'] == 2 && $validated['reason'] != null ){

                $user->attendance_instance($attendance)->update($validated);

            }elseif($validated['is_present'] == 0 && $validated['reason'] == null ){
                $validated['reason'] = "none";
                $user->attendance_instance($attendance)->update($validated);
            }else{
                $user->attendance_instance($attendance)->update($validated);
            }

            return redirect()->back()->with('success','Absentee Status Update Success');
    }


    // Show Members Present
    public function show_guests(Attendance $attendance){
        $guests = $attendance->guests_present();
        return view('attendance.attendance-users.components.guests.index',['guests'=>$guests, 'attendance'=>$attendance]);
    }



}
