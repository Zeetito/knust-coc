<?php

use App\Models\FP;
use Carbon\Carbon;
use App\Models\DTD;
use App\Models\Role;
use App\Models\User;
use App\Models\Zone;
use App\Models\Group;
use App\Models\Guest;
use App\Models\Image;
use App\Models\Share;
use App\Models\Account;
use App\Models\College;
use App\Models\Contact;
use App\Models\Faculty;
use App\Models\Program;
use App\Models\Semester;
use App\Models\Accessory;
use App\Models\Residence;
use App\Models\Attendance;
use App\Models\Permission;
use App\Models\GuestRequest;
use App\Models\AccountRecord;
use App\Models\UserResidence;
use App\Models\AttendanceUser;
use App\Http\Controllers\Admin;
use App\Mail\CreateBiodataMail;
use App\Models\SemesterProgram;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\UserResource;
use App\Http\Resources\GuestResource;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FPController;
use Diglactic\Breadcrumbs\Breadcrumbs;
use App\Http\Controllers\DTDController;
use App\Http\Resources\BiodataResource;
use App\Http\Controllers\FileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ZoneController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ShareController;
use App\Http\Controllers\RemarkController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\BiodataController;
use App\Http\Controllers\CollegeController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\MeetingController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\AccessoryController;
use App\Http\Controllers\ResidenceController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\DefaultImageController;
use App\Http\Controllers\AccountRecordController;
use App\Http\Controllers\ProgramOutlineController;
use App\Http\Controllers\SemesterProgramController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes();


// REMARKS
// Select Remark type to create -- Modal
Route::get('select_remark_create/{model_type}/{remarkerable_id}',[RemarkController::class,'select_remark_type'])
    ->middleware('auth','control:system_online','hasProfile')
    ->name('select_remark_create');

// // Create Remark
// Route::post('create_remark',[RemarkController::class,'create'])
//     ->middleware('auth','control:system_online','hasProfile')
//     ->name('create_remark');

    // -----
    
    // Create  Remarks/Notes
    Route::get('create_remark/{remarkerable_type}/{remarkerable_id}/{remarkable_id}/{remarkable_type}',[RemarkController::class,'create'])
    ->middleware('auth','control:system_online','hasProfile')
    ->name('create_remark');

    // Store Remark
    Route::post('store_remark/{remarkerable_type}/{remarkerable_id}/{remarkable_id}/{remarkable_type}',[RemarkController::class,'store'])
    ->middleware('auth','control:system_online','hasProfile')
    ->name('store_remark');

    // confirm Delete Remark
    Route::get('confirm_delete_remark/{remark}',[RemarkController::class,'confirm_delete'])
    ->middleware('auth','control:system_online','hasProfile')
    ->name('confirm_delete_remark');

    // Delete remark
    Route::delete('delete_remark/{remark}',[RemarkController::class,'delete'])
    ->middleware('auth','control:system_online','hasProfile')
    ->name('delete_remark');
    

    // ------




// SUPPORT PAGE
// View Support Page
    Route::get('view_support',[UserController::class,'support'])
        ->middleware('auth','control:system_online','hasProfile')
        ->name('support_page');

    

// -----------------------------------------------------------------------
// ----------------
    // FILES

    // View All files uploaded by a Model instance
    Route::get('view_files/{uploadable_type}/{uploadable_id}',[FileController::class,'view_files'])
    ->middleware('auth','control:system_online','hasProfile')
    ->name('view_files');

    // Upload File Form - modal
    Route::get('upload_file_form/{uploadable_type}/{uploadable_id}/{type}',[FileController::class,'upload_file_form'])
    ->middleware('auth','control:system_online','hasProfile')
    ->name('upload_file_form');

    // Upload File Action
    Route::post('upload_file',[FileController::class,'upload_file'])
    ->middleware('auth','control:system_online','hasProfile')
    ->name('upload_file');




// ----------------

    // SHARES
    // Create A Share instance - modal
    Route::get('create_share/{sharable}/{sendable}',[ShareController::class,'create'])
        ->middleware('auth','control:system_online','hasProfile')
        ->name('create_share');

    // Store Share
    Route::post('store_share',[ShareController::class,'store'])
    ->middleware('auth','control:system_online','hasProfile')
    ->name('store_share');

    // Show Shared Item
    Route::get('show_shared_item/{item}',[ShareController::class,'show'])
    ->middleware('auth','control:system_online','hasProfile')
    ->name('show_shared_item');

    // Confrim Cancel Share
    Route::get('confirm_cancel_shared_item/{item}',[ShareController::class,'confirm_cancel'])
    ->middleware('auth','control:system_online','hasProfile')
    ->name('confirm_cancel_shared_item');

    // Cacnel Share
    Route::delete('cancel_share/{item}',[ShareController::class,'cancel'])
    ->middleware('auth','control:system_online','hasProfile')
    ->name('cancel_share');


    

// -----------------------------------------------------------------------
// DOOR TO DOOR

    // Index - Show all door to door sessions a user is associated with
    Route::get('user_dtd/{user}',[DTDController::class,'user_dtd'])
    ->middleware('auth','control:system_online','hasProfile')
    ->name('user_dtd')
    ;  

    // Confrim dtd delete
    Route::get('confirm_dtd_delete/{dtd}',[DTDController::class,'confirm_delete'])
        ->middleware('auth','control:system_online','hasProfile')
        ->name('confirm_dtd_delete')
    ;  
    // Delete DTD Session
    Route::delete('dtd_delete/{dtd}',[DTDController::class,'delete'])
        ->middleware('auth','control:system_online','hasProfile')
        ->name('dtd_delete')
    ;  

    // Show Groups for A particular DTD Session
    Route::get('dtd_groups/{dtd}',[DTDController::class,'groups'])
    ->middleware('auth','control:system_online','hasProfile')
    ->name('dtd_groups')
    ;  

    // Show User for a particular DTD session
    Route::get('dtd_users/{dtd}',[DTDController::class,'users'])
    ->middleware('auth','control:system_online','hasProfile')
    ->name('dtd_users')
    ;     

    // View Door To Door Groups For A Particular User - User
    Route::get('dtd_groups/{user}',[DTDController::class,'user_groups'])
    ->middleware('auth','control:system_online','hasProfile')
    ->name('user_dtd_groups')
    ; 
    // Create Door To Door Form
    Route::get('dtd_create',[DTDController::class,'create'])
            ->middleware('auth','control:system_online','hasProfile')
            ->name('create_dtd')
            ;
    // Store DTD session
    Route::post('store_dtd',[DTDController::class,'store'])
            ->middleware('auth','control:system_online','permission:create_fishing_out')
            ->name('store_dtd')
            ;

    // Update DTD Session
    Route::put('update_dtd/{dtd}',[DTDController::class,'update'])
            ->middleware('auth','control:system_online','permission:create_fishing_out')
            ->name('update_dtd')
            ;

    // Edit DTD Session
    Route::get('edit_dtd/{dtd}',[DTDController::class,'edit'])
    ->middleware('auth','control:system_online','permission:create_fishing_out')
    ->name('edit_dtd')
    ;
        
    // Show DTD group
    Route::get('dtd_group/{group}',[DTDController::class,'show_dtd_group'])
            ->middleware('auth','control:system_online','hasProfile','can:view,group')
            ->name('show_dtd_group')
            ;
    // Create A Door To Door Record Instance
    Route::get('create_dtd_record/{group}',[DTDController::class,'create_record'])
            ->middleware('auth','control:system_online','hasProfile','can:view,group')
            ->name('create_dtd_record')
            ;
    // Edit A door to door Record - Modal
    Route::get('edit_dtd_record/{record_id}',[DTDController::class,'edit_record'])
            ->middleware('auth','control:system_online','hasProfile')
            ->name('edit_dtd_record')
            ;
    // Update A door to door Record 
    Route::put('update_dtd_record/{record_id}',[DTDController::class,'update_record'])
            ->middleware('auth','control:system_online','hasProfile')
            ->name('update_dtd_record')
            ;

    // Store A Door To Door Record Instance
    Route::post('store_dtd_record/{group}',[DTDController::class,'store_record'])
            ->middleware('auth','control:system_online','hasProfile')
            ->name('store_record')
            ;
    // Create A SubGroup/Group for Door to Door Session
    Route::get('dtd_subgroup_create/{dtd}',[DTDController::class,'dtd_subgroup_create'])
            ->middleware('auth','control:system_online','hasProfile')
            ->name('dtd_subgroup_create')
            ;

    // Store A SubGroup/Group for Door to Door Session
    Route::post('dtd_subgroup_store/{dtd}',[DTDController::class,'dtd_subgroup_store'])
            ->middleware('auth','control:system_online','hasProfile')
            ->name('dtd_subgroup_store')
            ;



    // Store all DTD sessions through here
    // Route::post('dtd_store',[DTDController::class,'store'])
    //         ->middleware('auth','control:system_online','permission:create_fishing_out')
    //         ->name('store')

    // FISHING OUT
    // Create fishing out
    Route::get('fishing_out_create',[DTDController::class,'fishing_out_create'])
            ->middleware('auth','control:system_online','permission:create_fishing_out')
            ->name('fishing_out_create')
            ;

    // EVANGELISM
    // Create Evangelism session
    Route::get('evangelism_create',[DTDController::class,'evangelism_create'])
    ->middleware('auth','control:system_online','permission:create_fishing_out')
    ->name('evangelism_create')
    ;


// -------------------------------------------------------------------------



// ------------------------------------------------------------------------------
// GROUPS
// Show Any Group
Route::get('group/{group}',[GroupController::class,'show'])
        ->middleware('auth','control:system_online','hasProfile','can:view,group')
        ->name('show_group')
        ;
// Confirm Group Delete
Route::get('confirm_group_delete/{group}',[GroupController::class,'confirm_delete'])
        ->middleware('auth','control:system_online','hasProfile')
        ->name('confirm_group_delete')
        ;
// Delete Group
Route::delete('delete_group/{group}',[GroupController::class,'delete'])
        ->middleware('auth','control:system_online','hasProfile')
        ->name('delete_group')
        ;
// Edit Group
Route::get('edit_group/{group}',[GroupController::class,'edit'])
        ->middleware('auth','control:system_online','hasProfile')
        ->name('edit_group')
        ;
// Update Group
Route::put('update_group/{group}',[GroupController::class,'update'])
        ->middleware('auth','control:system_online','hasProfile')
        ->name('update_group')
        ;

// Confirm Making User Admin
Route::get('confirm_make_user_admin/{group}/{user}',[GroupController::class,'confirm_make_admin'])
        ->middleware('auth','control:system_online','hasProfile')
        ->name('confirm_make_user_admin')
        ;

// Make User Admin
Route::put('make_user_admin/{group}/{user}',[GroupController::class,'make_admin'])
        ->middleware('auth','control:system_online','hasProfile')
        ->name('make_user_admin')
        ;

// Confirm Withdraw Admin Role
Route::get('confirm_admin_withdraw/{group}/{user}',[GroupController::class,'confirm_admin_withdraw'])
        ->middleware('auth','control:system_online','hasProfile')
        ->name('confirm_admin_withdraw')
        ;

// WithDraw Admin Role
Route::put('withdraw_admin_role/{group}/{user}',[GroupController::class,'withdraw_admin_role'])
        ->middleware('auth','control:system_online','hasProfile')
        ->name('withdraw_admin_role')
        ;

// Confirm Remove User
Route::get('confirm_remove_user/{group}/{user}',[GroupController::class,'confirm_remove_user'])
        ->middleware('auth','control:system_online','hasProfile')
        ->name('confirm_remove_user')
        ;

// Remove User
Route::put('remove_user/{group}/{user}',[GroupController::class,'remove_user'])
        ->middleware('auth','control:system_online','hasProfile')
        ->name('remove_user')
        ;

// View User Groups
Route::get('groups/user/{user}',[GroupController::class,'view_user_groups'])
        ->middleware('auth','control:system_online','hasProfile')
        ->name('view_user_groups')
        ;
// Create Invite 
Route::get('create_invite/{group}',[GroupController::class,'create_invite'])
        ->middleware('auth','control:system_online','hasProfile')
        ->name('create_invite')
        ;
// Store Invite
Route::post('store_invite/{group}',[GroupController::class,'store_invite'])
        ->middleware('auth','control:system_online','hasProfile')
        ->name('store_invite')
        ;
// Add User without invite page
Route::get('skip_invite_page/{group}',[GroupController::class,'skip_invite_page'])
        ->middleware('auth','control:system_online','hasProfile')
        ->name('skip_invite_page')
        ;
// Skip User
Route::post('skip_invite/{group}',[GroupController::class,'skip_invite'])
        ->middleware('auth','control:system_online','hasProfile')
        ->name('skip_invite')
        ;



// Show User Invites
Route::get('invites/{user}',[UserController::class,'view_user_invites'])
        ->middleware('auth','control:system_online','hasProfile')
        ->name('view_user_invites')
        ;
// Handle User Invite Form
Route::get('handle_invite_form/{user}/{group}',[GroupController::class,'handle_invite_form'])
        ->middleware('auth','control:system_online','hasProfile')
        ->name('handle_invite_form')
        ;
// Response User Invite
Route::put('handle_invite/{user}/{group}',[GroupController::class,'handle_invite'])
        ->middleware('auth','control:system_online','hasProfile')
        ->name('handle_invite')
        ;

// Show Invited Users
Route::get('group_invites//{group}',[GroupController::class,'invites'])
        ->middleware('auth','control:system_online','hasProfile')
        ->name('group_invites')
        ;
// Confirm Delete Invite
Route::get('confirm_invite_delete/{group}/{user}',[GroupController::class,'confirm_invite_delete'])
        ->middleware('auth','control:system_online','hasProfile')
        ->name('confirm_invite_delete')
        ;
// Delete Invite
Route::delete('delete_invite/{group}/{user}',[GroupController::class,'delete_invite'])
        ->middleware('auth','control:system_online','hasProfile')
        ->name('delete_invite')
        ;

// ------------------------------------------------------------------------------



// IMAGES
// Store Image - PolyMorphs
Route::post('/store_image',[ImageController::class,"store"])
    ->middleware('auth','control:system_online')
    ->name('store_image')
    ;

// DEFAULT IMAGES
// Store Default Image - PolyMorphs
Route::post('/store_default_image',[DefaultImageController::class,"store"])
    ->middleware('auth','control:system_online')
    ->name('store_default_image')
    ;


// ---------------
// SEMESTER-PROGRAMS
// View All semester Programs
Route::get('/semester_programs', [SemesterProgramController::class, 'index'])
    ->middleware('auth','control:system_online','hasProfile')
    ->name('semester_programs');

// Create Semester Program
Route::post('/create_semester_program', [SemesterProgramController::class, 'store'])
    ->middleware('auth','control:system_online', 'role:ministry_members_level')
    ->name('create_semester_program');

// Filter Semester Programs
Route::get('/filter_semester_programs', [SemesterProgramController::class, 'filter_semester_programs'])
    ->middleware('auth','control:system_online')
    ->name('filter_semester_programs');

// Show A Semester Program
Route::get('/semester_program/{semesterProgram}', [SemesterProgramController::class, 'show'])
    ->middleware('auth','control:system_online')
    ->name('show_semester_program');
// UPload semester Program Image form
Route::get('/upload_semester_program_image/{semesterProgram}',[SemesterProgramController::class, 'upload_semester_program_image'])
    ->middleware('auth','control:system_online','role:ministry_members_level')
    ->name('upload_semester_program_image')
    ;

// Add Semester Program - Modal
Route::get('add_semester_program',[SemesterProgramController::class, 'create'])
    ->middleware('auth','control:system_online','role:ministry_members_level')
    ->name('add_semester_program')
    ;

// OFFICIATOR
// Add Officiator
Route::get('/add_officiator_form/{semesterProgram}', [SemesterProgramController::class, 'add_officiator_form'])
    ->middleware('auth','control:system_online', 'role:ministry_members_level')
    ->name('add_officiator_form');

// Store Officiator Instance
Route::post('/officiator_store/{semesterProgram}', [SemesterProgramController::class, 'store_officiator'])
    ->middleware('auth','control:system_online', 'role:ministry_members_level')
    ->name('store_officiator');

// Search User for officiating
Route::get('/search_user_officiator', [SemesterProgramController::class, 'search_user_officiator'])
    ->middleware('auth','control:system_online')
    ->name('search_user_officiator');

// Remove an Officiator Instance
Route::delete('/remove_officiator/{semesterProgram}/{officiator}/{status}/{role}', [SemesterProgramController::class, 'remove_officiator'])
    ->middleware('auth','control:system_online', 'role:ministry_members_level')
    ->name('remove_officiator');

// Edit form for officiator
Route::get('/edit_officiator/{semesterProgram}/{officiator}/{status}/{role}', [SemesterProgramController::class, 'edit_officiator'])
    ->middleware('auth','control:system_online', 'role:ministry_members_level')
    ->name('edit_officiator');

// Confirm officiator delete
Route::get('/officiator_delete/{semesterProgram}/{officiator}/{status}/{role}/confirm', [SemesterProgramController::class, 'confirm_officiator_delete'])
    ->middleware('auth','control:system_online', 'role:ministry_members_level')
    ->name('confirm_officiator_delete');

// Update an officiator Instance?
Route::put('/update_officiator/{semesterProgram}/{officiator}/{status}/{role}', [SemesterProgramController::class, 'update_officiator'])
    ->middleware('auth','control:system_online', 'role:ministry_members_level')
    ->name('update_officiator');

// PROGRAM OUTLINE
// Show Program Outline
Route::get('/program_outline/{semesterProgram}/create', [ProgramOutlineController::class, 'create'])
    ->middleware('auth','control:system_online')
    ->name('create_program_outline');

// Save/Store Program Outline / Session
Route::post('/program_outline/{semesterProgram}/store', [ProgramOutlineController::class, 'store'])
    ->middleware('auth','control:system_online', 'role:ministry_members_level')
    ->name('store_program_outline');

// Edit Program outline/session
Route::get('/program_outline/{semesterProgram}/{programOutline}/edit', [ProgramOutlineController::class, 'edit'])
    ->middleware('auth','control:system_online', 'role:ministry_members_level')
    ->name('edit_program_outline');

// Update Program Outline/Session
Route::put('/program_outline/{semesterProgram}/{programOutline}/update', [ProgramOutlineController::class, 'update'])
    ->middleware('auth','control:system_online', 'role:ministry_members_level')
    ->name('update_program_outline');

// Confirm Update Program Outline
Route::get('/confirm_program_outline/{semesterProgram}/{programOutline}/update', [ProgramOutlineController::class, 'confirm_update'])
    ->middleware('auth','control:system_online', 'role:ministry_members_level')
    ->name('confirm_program_outline_update');

// Confirm Delete Program Outline
Route::get('/confirm_program_outline/{semesterProgram}/{programOutline}/delete', [ProgramOutlineController::class, 'confirm_delete'])
    ->middleware('auth','control:system_online', 'role:ministry_members_level')
    ->name('confirm_program_outline_delete');

// Delete Program Outline
Route::delete('/program_outline/{semesterProgram}/{programOutline}/delete', [ProgramOutlineController::class, 'delete'])
    ->middleware('auth','control:system_online', 'role:ministry_members_level')
    ->name('delete_program_outline');
// -------------
// ACADEMIA


// PROGRAMS
// View All Programs
Route::get('/programs', [ProgramController::class, 'index'])
    ->middleware('auth','control:system_online','hasProfile')
    ->name('programs');

// Create New Program
Route::get('/create_program', [ProgramController::class, 'create'])
    ->middleware('auth','control:system_online','hasProfile', 'role:ministry_members_level')
    ->name('create_program');

// Store Program
Route::post('/store_program', [ProgramController::class, 'store'])
    ->middleware('auth','control:system_online','hasProfile', 'role:ministry_members_level')
    ->name('store_program');


// COLLEGES

// View All Colleges
Route::get('/colleges', [CollegeController::class, 'index'])
    ->middleware('auth','control:system_online','hasProfile')
    ->name('colleges');

// Show A single College
Route::get('/colleges/{college}', [CollegeController::class, 'show'])
    ->middleware('auth','control:system_online')
    ->name('show_college');

// Search User in a College On Users table
Route::get('/search_college_user/{college}', [CollegeController::class, 'search_college_user'])
    ->middleware('auth','control:system_online')
    ->name('search_college_user');

// Search Programs in a Faculty On Programs table
Route::get('/search_college_program/{college}', [CollegeController::class, 'search_college_program'])
    ->middleware('auth','control:system_online')
    ->name('search_college_program');

    

// FACULTIES
// View all faculties
Route::get('/faculties', [FacultyController::class, 'index'])
    ->middleware('auth','control:system_online')
    ->name('faculties');

// Show A single College
Route::get('/faculties/{faculty}', [FacultyController::class, 'show'])
    ->middleware('auth','control:system_online')
    ->name('show_faculty');

// Search User in a Faculty On Users table
Route::get('/search_faculty_user/{faculty}', [FacultyController::class, 'search_faculty_user'])
    ->middleware('auth','control:system_online')
    ->name('search_faculty_user');

// Search Programs in a Faculty On Programs table
Route::get('/search_faculty_program/{faculty}', [FacultyController::class, 'search_faculty_program'])
    ->middleware('auth','control:system_online')
    ->name('search_faculty_program');

// PROGRAMS

// Create User-Programs
Route::get('user_program/{user}',[ProgramController::class,'create_user_program'])
    ->middleware('auth','control:system_online')
    ->name('create_user_program')
    ;

// Store User Program
Route::post('store_user_program/{user}',[ProgramController::class,'store_user_program'])
    ->middleware('auth','control:system_online')
    ->name('store_user_program')
    ;

// Update Biodata Program
Route::put('update_biodata_program/{user}',[ProgramController::class,'update_biodata_program'])
    ->middleware('auth','control:system_online')
    ->name('update_biodata_program')
    ;

    // View Program Mates
Route::get('/program_mates/{user}',[ProgramController::class, 'view_program_mates'])
    ->middleware('auth','control:system_online','hasProfile')
    ->name('view_program_mates')
    ;

// Search a program mates
Route::get('/search_program_mates/{user}',[ProgramController::class,'search_program_mates'])
    ->middleware('auth','control:system_online')
    ->name('search_program_mates')
    ;

// Filter Program mates
Route::get('/filter_program_mates/{user}',[ProgramController::class,'filter_program_mates'])
    ->middleware('auth','control:system_online')
    ->name('filter_program_mates')
    ;






// -----------------
// HOUSING

// ZONES


// View all Zones
Route::get('/zones', [ZoneController::class, 'index'])
    ->middleware('auth','control:system_online','hasProfile')
    ->name('zones');

// Show A particular Zone
Route::get('/zone/{zone}', [ZoneController::class, 'show'])
    ->middleware('auth','control:system_online','hasProfile')
    ->name('show_zone');

// Search Zone Members
Route::get('/search_zone_members/{zone}', [ZoneController::class, 'search_members'])
    ->middleware('auth','control:system_online','hasProfile')
    ->name('search_zone_members')
    ;

// Show Others Zone
Route::get('/others_zone', [ZoneController::class, 'show_others'])
    ->middleware('auth','control:system_online','hasProfile')
    ->name('show_others_zone');


// View Program Mates
Route::get('/zone_mates/{user}',[ZoneController::class, 'view_zone_mates'])
    ->middleware('auth','control:system_online','hasProfile')
    ->name('view_zone_mates')
    ;



// Search a zone mates
Route::get('/search_zone_mates/{user}',[ZoneController::class,'search_zone_mates'])
    ->middleware('auth','control:system_online','hasProfile')
    ->name('search_zone_mates')
    ;


// RESIDENCES
// Create Residence
Route::get('create_residence/{zone}',[ResidenceController::class,'create'])
    ->middleware('auth','control:system_online','permission:add_residence','hasProfile')
    ->name('create_residence')
    ;

// store Residence
Route::post('store_residence',[ResidenceController::class,'store'])
    ->middleware('auth','control:system_online','permission:add_residence','hasProfile')
    ->name('store_residence')
    ;   

// edit Residence
Route::get('edit_residence/{residence}',[ResidenceController::class,'edit'])
    ->middleware('auth','control:system_online','permission:update_residence','hasProfile')
    ->name('edit_residence')
    ;

// Update Residence
Route::put('update_residence/{residence}',[ResidenceController::class,'update'])
    ->middleware('auth','control:system_online','permission:update_residence','hasProfile')
    ->name('update_residence')
    ;

// Create User_Residence Instance
Route::get('user_residence/{user}',[ResidenceController::class,'create_user_residence'])
    ->middleware('auth','control:system_online')
    ->name('create_user_residence')
    ;

// Store User Residence   
Route::post('store_user_residence/{user}',[ResidenceController::class,'store_user_residence'])
    ->middleware('auth','control:system_online')
    ->name('store_user_residence')
    ;

// Edit user REsidence
Route::get('edit_user_residence/{user_residence}',[ResidenceController::class,'edit_user_residence'])
    ->middleware('auth','control:system_online')
    ->name('edit_user_residence','hasProfile')
    ;

// Update user residence
Route::put('update_user_residence/{user_residence}',[ResidenceController::class,'update_user_residence'])
    ->middleware('auth','control:system_online')
    ->name('update_user_residence')
    ;
// Confirm user residence delete
Route::get('confirm_delete_user_residence/{user_residence}',[ResidenceController::class,'confirm_delete_user_residence'])
    ->middleware('auth','control:system_online')
    ->name('confirm_delete_user_residence','hasProfile')
    ;

// Delete User Residence
Route::delete('delete_user_residence/{user_residence}',[ResidenceController::class,'delete_user_residence'])
    ->middleware('auth','control:system_online')
    ->name('delete_user_residence','hasProfile')
    ;

//  Confirm Save User Residence
Route::get('confirm_save_user_residence/{user_residence}',[ResidenceController::class,'confrim_save'])
    ->middleware('auth','control:system_online')
    ->name('confirm_save_user_residence','hasProfile')
    ;   
// Save User Residence
Route::post('save_user_residence/{user_residence}/{user}',[ResidenceController::class,'save_user_residence'])
    ->middleware('auth','control:system_online','hasProfile')
    ->name('save_user_residence')
    ;
    //permission to SAve User residence


// Update Biodata Residence   
Route::put('update_biodata_residence/{user}',[ResidenceController::class,'update_biodata_residence'])
    ->middleware('auth','control:system_online')
    ->name('update_biodata_residence')
    ;

// Confrim Delete Residence
Route::get('delete_residence_confirm/{residence}',[ResidenceController::class,'confirm_delete'])
    ->middleware('auth','control:system_online','permission:update_residence','hasProfile')
    ->name('delete_residence_confirm')
    ;

// Delete Residence
Route::delete('delete_residence/{residence}',[ResidenceController::class,'delete'])
    ->middleware('auth','control:system_online','permission:update_residence','hasProfile')
    ->name('delete_residence')
    ;

// ---------------

// ------------------------
    // MEETING
// View all meetings
Route::get('/meetings',[MeetingController::class,'index'])
    ->middleware('auth','control:system_online','role:ministry_members_level')
    ->name('meetings')
    ;

// Show a meeting
Route::get('/meeting/{meeting}',[MeetingController::class,'show'])
    ->middleware('auth','control:system_online','role:ministry_members_level')
    ->name('show_meeting')
    ;
// Create meeting - modal
Route::get('/create_meeting',[MeetingController::class,"create"])
    ->middleware('auth','control:system_online','role:ministry_members_level')
    ->name('create_meeting')
    ;
// Store Meeting 
Route::post('meeting',[MeetingController::class,"store"])  
    ->middleware('auth','control:system_online','role:ministry_members_level')
    ->name('store_meeting')
    ;

// Confirm Meeting - modal
Route::get('confirm_meeting_delete/{meeting}',[MeetingController::class,"confirm_delete"])
    ->middleware('auth','control:system_online','role:ministry_members_level')
    ->name('confirm_meeting_delete')
    ;
// Delete Meeting
Route::delete('delete_meeting/{meeting}',[MeetingController::class,"destroy"])
    ->middleware('auth','control:system_online','role:ministry_members_level')
    ->name('delete_meeting')
    ;

// -------------------------------


// ----------------
// ROLES

// View All Roles
Route::get('/roles', [RoleController::class, 'index'])
    ->middleware('auth','control:system_online')
    ->name('roles');

// Edit Role Page
Route::get('/roles/{role}/edit', [RoleController::class, 'edit'])
    ->middleware('auth','control:system_online','role:ministry_members_level')
    ->name('edit_role');

// Add User Roles Instance
Route::get('/create_users_roles/{role}', [RoleController::class, 'create_users_roles'])
    ->middleware('auth','control:system_online','role:ministry_members_level')
    ->name('create_users_roles');

// Search User Modal
Route::get('/fetch_role_users_modal/{role}', [RoleController::class, 'fetch_role_users_modal'])
    ->middleware('auth','control:system_online','role:ministry_members_level')
    ->name('fetch_role_users_modal');

// Search User among the users who do not have a particular role
Route::get('/search_non_user_roles/{role}', [RoleController::class, 'search_non_user_roles'])
    ->middleware('auth','control:system_online','role:ministry_members_level')
    ->name('search_non_user_roles');

// Give a user role
Route::get('/role/{role}/{user}/assign', [RoleController::class, 'give_user_role'])
    ->middleware('auth','control:system_online','role:preacher_level')
    ->name('give_user_role');

// Remove a user's role
Route::delete('/role/{role}/{user}/remove', [RoleController::class, 'remove_user_role'])
    ->middleware('auth','control:system_online','role:preacher_level')
    ->name('remove_user_role');
// confirm_role_user_remove
Route::get('/confirm_role_user_remove/{role}/{user}', [RoleController::class, 'confirm_role_user_remove'])
    ->middleware('auth','control:system_online','role:preacher_level')
    ->name('confirm_role_user_remove');

// Create role premissions form
Route::get('/role/{role}/permissions', [RoleController::class, 'create_roles_permissions'])
    ->middleware('auth','control:system_online','role:preacher_level')
    ->name('create_roles_permissions');

// Assign permission to role
Route::get('/roles/{role}/{permission}/assign', [RoleController::class, 'assign_role_permission'])
    ->middleware('auth','control:system_online','role:preacher_level')
    ->name('assign_role_permission');

// Remove a role's permission
Route::delete('/permission/{role}/{permission}/remove', [RoleController::class, 'remove_role_permission'])
    ->middleware('auth','control:system_online','role:preacher_level')
    ->name('remove_role_permission');

// Confirm A Role removal from permission
Route::get('/confirm_role_permission_remove/{role}/{permission}', [RoleController::class, 'confirm_role_permission_remove'])
    ->middleware('auth','control:system_online','role:preacher_level')
    ->name('confirm_role_permission_remove');

// Search Role Non-Permissions
Route::get('search_role_non_permissions/{role}', [RoleController::class, 'search_role_non_permissions'])
    ->middleware('auth','control:system_online', 'role:ministry_members_level')
    ->name('search_role_non_permissions');
// --------------------------

// PERMISSIONS
// View All permissions
Route::get('permissions',[PermissionController::class,'index'])
    ->middleware('auth','control:system_online', 'role:ministry_members_level')
    ->name('permissions');

// Edit / Show Permission
Route::get('edit_permission/{permission}',[PermissionController::class,'edit'])
    ->middleware('auth','control:system_online', 'role:ministry_members_level')
    ->name('edit_permission');

// Create Permission Users
Route::get('create_permission_users/{permission}',[PermissionController::class,'create_user'])
    ->middleware('auth','control:system_online', 'role:ministry_members_level')
    ->name('create_permission_users');

// Assign Permission To
Route::post('assign_permission_to/{permission}',[PermissionController::class,'assign_permission'])
    ->middleware('auth','control:system_online', 'role:ministry_members_level')
    ->name('give_permission_to');


// ------------------------
// ATTENDANCE

// Email check page
Route::get('/email_check_page/{attendance}', [AttendanceController::class, 'email_check_page'])
    ->middleware('control:system_online')
    ->name('email_check_page');

Route::post('/email_check/{attendance}', [AttendanceController::class, 'email_check'])
->middleware('control:system_online')
->name('email_check');



// Index page to view the various attendance sessions
Route::get('/attendance', [AttendanceController::class, 'index'])
    ->middleware('auth','control:system_online','hasProfile')
    ->name('attendance');

// Show Attendance Session. See who's marked or not
Route::get('/attendance_users/{attendance}', [AttendanceController::class, 'show_attendance_users'])
    ->middleware('auth','control:system_online', 'role:residence_reps_level')
    ->name('show_attendance_users');

// Create New Attendance Session
Route::post('/attendance', [AttendanceController::class, 'store'])
    ->middleware('auth','control:system_online', 'role:ministry_members_level')
    ->name('create_attendance');

// Reset Attendance Session
Route::post('/attendance/{attendance}/reset', [AttendanceController::class, 'reset_attendance'])
    ->middleware('auth','control:system_online', 'role:ministry_members_level')
    ->name('reset_attendance');

// Confrim Attendance Reset
Route::get('/confirm_attendance_reset/{attendance}', [AttendanceController::class, 'confirm_attendance_reset'])
    ->middleware('auth','control:system_online', 'role:ministry_members_level')
    ->name('confirm_attendance_reset');

// Confrim Attendance Session Delete
Route::get('/confirm_attendance_delete/{attendance}', [AttendanceController::class, 'confirm_attendance_delete'])
    ->middleware('auth','control:system_online', 'role:ministry_members_level')
    ->name('confirm_attendance_delete');

// Delete Attendance Session
Route::delete('/attendance/{attendance}/delete', [AttendanceController::class, 'delete_attendance'])
    ->middleware('auth','control:system_online', 'role:ministry_members_level')
    ->name('delete_attendance');

// Access Attendance session to mark
Route::get('/attendance/{attendance}/access', [AttendanceController::class, 'access_attendance_session'])
    ->middleware('auth','control:system_online')
    ->name('access_attendance_session');

// Confirm Attendance Toogle/switch
Route::get('/confirm_attendance_switch/{attendance}', [AttendanceController::class, 'confirm_attendance_switch'])
    ->middleware('auth','control:system_online', 'role:ministry_members_level')
    ->name('confirm_attendance_switch');

// Switch Attendance Session
Route::post('/attendance/{attendance}/switch', [AttendanceController::class, 'switch_attendance_session'])
    ->middleware('auth','control:system_online', 'role:ministry_members_level')
    ->name('switch_attendance_session');

// Check
Route::get('/attendance/{attendance}/{user}', [AttendanceController::class, 'check_user'])
    ->middleware('auth','control:system_online')
    ->name('check_user');

// Check Absentee
Route::post('/check_absentee/{attendance}/{user}', [AttendanceController::class, 'check_absentee'])
    ->middleware('auth','control:system_online')
    ->name('check_absentee');

// Uncheck User
Route::delete('/uncheck_user/{attendance}/{user}', [AttendanceController::class, 'uncheck_user'])
    ->middleware('auth','control:system_online')
    ->name('uncheck_user');

// Uncheck Guest
Route::delete('/uncheck_guest/{attendance}/{guest}', [AttendanceController::class, 'uncheck_guest'])
    ->middleware('auth','control:system_online', 'role:ministry_members_level')
    ->name('uncheck_guest');

// Confrim Uncheck Guest
Route::get('/confirm_guest/{attendance}/{guest}', [AttendanceController::class, 'confirm_uncheck_guest'])
    ->middleware('auth','control:system_online', 'role:ministry_members_level')
    ->name('confirm_uncheck_guest');

// Confirmation for uncheck user
Route::get('/confirm_user_uncheck/{attendance}/{user}', [AttendanceController::class, 'confirm_uncheck_user'])
    ->middleware('auth','control:system_online')
    ->name('confirm_uncheck_user');

// Confirmation for Checking user -Absentees MOdal
Route::get('/confirm_user_check/{attendance}/{user}', [AttendanceController::class, 'confirm_check_user'])
    ->middleware('auth','control:system_online')
    ->name('confirm_check_user');

// Search Attendance Session
Route::get('/search_attendance/{semester}', [AttendanceController::class, 'search_attendance'])
    ->middleware('auth','control:system_online')
    ->name('search_attendance');

// Search User who's been checked for a particular attendance
Route::get('/search_attendance_checked_users/{attendance}', [AttendanceController::class, 'search_attendance_checked_users'])
    ->middleware('auth','control:system_online')
    ->name('search_attendance_checked_users');

// Search User on Attendance table
Route::get('/search_attendance_users/{attendance}', [AttendanceController::class, 'search_attendance_users'])
    ->middleware('auth','control:system_online')
    ->name('search_attendance_users');

// Register User Visitor
Route::post('/register_user_visitor/{attendance}', [AttendanceController::class, 'register_user_visitor'])
    ->middleware('auth','control:system_online', 'role:ministry_members_level')
    ->name('register_user_visitor');

// Register Guest Visitor
Route::post('/register_guest_visitor/{attendance}', [AttendanceController::class, 'register_guest_visitor'])
    ->middleware('auth','control:system_online', 'role:ministry_members_level')
    ->name('register_guest_visitor');

// View All Absentee fo an attendance session
Route::get('/absentees/{attendance}', [AttendanceController::class,'show_absentees'])
    ->middleware('auth','control:system_online','role:zone_reps_level')
    ->name('show_absentees')
    ;

// Search Absentees
Route::get('/search_absentees/{attendance}',[AttendanceController::class,'search_absentees'])
    ->middleware('auth','control:system_online','role:zone_reps_level')
    ->name('search_absentees')
    ;

// filter Absentees
Route::get('/filter_absentees/{attendance}',[AttendanceController::class,'filter_absentees'])
    ->middleware('auth','control:system_online','role:zone_reps_level')
    ->name('filter_absentees')
    ;

// Confirm Print Attendance
Route::get('/confirm_print_absentees/{attendance}',[AttendanceController::class,'confirm_print_absentees'])
    ->middleware('auth','control:system_online','role:zone_reps_level')
    ->name('confirm_print_absentees')
    ;
// Print Absentees File
Route::post('/print_absentee_file/{attendance}/{zone}',[AttendanceController::class,'print_absentee_file'])
    ->middleware('auth','control:system_online','role:zone_reps_level')
    ->name('print_absentee_file')
    ;

// Show Visitors
Route::get('/show_guests/{attendance}',[AttendanceController::class,'show_guests'])
    ->middleware('auth','control:system_online','role:zone_reps_level')
    ->name('show_guests')
    ;

// Edit Absentee Status - Modal Wheter user was available or not
Route::get('/edit_absentee_status/{attendance}/{user}',[AttendanceController::class,'edit_absentee_status'])
    ->middleware('auth','control:system_online','role:zone_reps_level')
    ->name('edit_absentee_status')
    ;
// Update Absentee Status
Route::put('/udpate_absentee_status/{attendance}/{user}',[AttendanceController::class,'udpate_absentee_status'])
    ->middleware('auth','control:system_online','role:zone_reps_level')
    ->name('udpate_absentee_status')
    ;

// Attendance Qr Scan Check
Route::get('/attendance_qr/{attendance}',[AttendanceController::class,'attendance_qr_page'])
    ->middleware('auth','control:system_online','role:zone_reps_level')
    ->name('attendance_qr_page')
    ;

// ------------------------------

// --------------------------------
// ACCOUNT

// Guest Register
// Route::get('/register', function () {
//     return view('account.register');
//     })
//     ->name('register')
//     ->middleware('guest');

// // Guest store
Route::Post('/user_register', [UserController::class, 'store'])
    ->middleware('guest')
    ->name('register_user');

// Guest/ Fresher register page
Route::get('/register_fresher',[UserController::class, 'create_fresher'])
    ->middleware('guest')
    ->name('create_fresher')
    ;

// Guest/ Fresher Login page
Route::get('/login_page_fresher',[UserController::class, 'login_page_fresher'])
    ->middleware('guest')
    ->name('login_page_fresher')
    ;



    // STUDENT
// Student Register
Route::get('/register_student',[UserController::class, 'register_student'])
    ->middleware('guest')
    ->name('register_student')
    ;

Route::prefix('user')->group(function () {

//     // User Login
//     Route::get('/login', function () {
//         return view('account.login');
//     })
//         ->middleware('guest')
//         ->name('login');

    // User Login Action
    Route::Post('/user_login', [UserController::class, 'login'])
        ->middleware('guest')
        ->name('user_login');

//     // User Logout Action
    Route::get('/user_logout', [UserController::class, 'logout'])
        ->middleware('auth')
        ->name('user_logout');

});

Route::get('/', function () {
    // $breadcrumbs = Breadcrumbs::render('home');

    return view('homepage');
})
    ->middleware('auth','control:system_online','hasProfile')
    // ->name('home')
    ;

//  PROFILE / BIODATA

// Search residences
Route::get('/profile_search_residences', [BiodataController::class, 'profile_search_residences'])
    ->middleware('auth')
    ->name('profile_search_residences');
// Search Programs
Route::get('/profile_search_programs', [BiodataController::class, 'profile_search_programs'])
    ->middleware('auth')
    ->name('profile_search_programs');

// Show User Profile
Route::get('/profile/{user}', [BiodataController::class, 'show'])
    ->middleware('auth','control:system_online','hasProfile')
    ->name('view_profile');

// create User Profile form
Route::get('/profile/{user}/new', [BiodataController::class, 'create'])
    ->middleware('auth', 'can:update_profile,user')
    ->name('create_user_profile_form');

// /store user profile
Route::post('/profile/{user}/create', [BiodataController::class, 'store'])
    ->middleware('auth','can:update_profile,user')
    ->name('store_profile');

// edit user profile
Route::get('/profile/{user}/edit', [BiodataController::class, 'edit'])
    ->middleware('auth', 'can:update,user','hasProfile')
    ->name('edit_user_profile_form');

// Update User profile
Route::put('/profile/{user}/update', [BiodataController::class, 'update'])
    ->middleware('auth', 'can:update,user')
    ->name('update_profile')
    ;

// IMAGES
// Create User Image Form
Route::get('/upload_user_image/{user}',[UserController::class,'upload_user_image'])
    ->middleware('auth','hasProfile','control:system_online')
    ->name('upload_user_image');
    ;

// USER AVATAR

// Edit User
Route::get('/edit_account/{user}',[UserController::class,'edit'])
    ->middleware('auth','hasProfile','control:system_online','can:update,user')
    ->name('edit_user')
    ;
// Update User
Route::put('/update_account/{user}',[UserController::class,'update'])
    ->middleware('auth','hasProfile','control:system_online','can:update,user')
    ->name('update_user')
    ;

// Check User Password and Move on
Route::get('/account_confirm_password/{user}',[UserController::class,'account_confirm_password'])
    ->middleware('auth','control:system_online','can:update,user')
    ->name('account_confirm_password')
    ;

// Change Password
Route::put('/change_password/{user}',[UserController::class,'change_password'])
    ->middleware('auth','control:system_online','can:update,user')
    ->name('change_password')
    ;
    
// Account check Password
Route::get('/account_new_password/{user}',[UserController::class,'account_new_password'])
    ->middleware('auth','control:system_online','can:update,user')
    ->name('account_new_password')
    ;



// Confirm_Delete_user
Route::get('/confirm_delete_account/{user}',[UserController::class,'confirm_delete'])
    ->middleware('auth','hasProfile','control:system_online','permission:delete_user')
    ->name('confirm_delete_user')
    ;

// delete User
Route::delete('/delete_account/{user}',[UserController::class,'delete'])
    ->middleware('auth','hasProfile','control:system_online','permission:delete_user')
    ->name('delete_user')
    ;


// View avatar change form
Route::get('/avatar/{user}', [UserController::class, 'edit_avatar'])
    ->middleware('auth')
    ->name('edit_avatar_form');
// Update Avatar action
Route::post('/avatar/{user}', [UserController::class, 'store_avatar'])
    ->middleware('auth')
    ->name('update_avatar', 'can:update,user');

// Reset User Avatar
Route::get('/avatar/{user}/reset', [UserController::class, 'reset_avatar'])
    ->middleware('auth')
    ->name('reset_avatar');


// Password
Route::get('/forgot-password',[PasswordController::class,'forgot_password'])
    ->middleware('guest')
    ->name('forgot_password')
    ;

// Send Reset Links
Route::post('/forgot-password',[PasswordController::class,'send_reset_link'])
    ->middleware('guest')
    ->name('send_reset_link')
    ;

// Reset Password form
Route::get('/reset-password/{token}',[PasswordController::class,'reset_password'])
    ->middleware('guest')
    ->name('reset-password')
    ;   

// Update Password
Route::post('/reset-password',[PasswordController::class,'update_password'])
    ->middleware('guest')
    ->name('update_password')
    ;   




// VIEWS
Route::get('/users', [UserController::class, 'view_users'])
    ->middleware('auth','hasProfile','control:system_online')
    ->name('view_users');

// Users Table
// VIEWS
Route::get('/users_table', [UserController::class, 'users_table'])
    ->middleware('auth','hasProfile','control:system_online')
    ->name('users_table');

// -- Table page
Route::get('/users_table_page', [UserController::class, 'users_table_page'])
    ->middleware('auth','hasProfile','control:system_online')
    ->name('users_table_page');

// -------------------------------------------------


// CONTROL

// Redirect when system is down
Route::get('/system_offline',[AccessoryController::class, 'system_offline'])
    ->middleware('auth','hasProfile')
    ->name('system_offline');

// fp
Route::get('/fp',[FPController::class, 'fp'])
    ->middleware('guest')
    ->name('fp');

// fp save
Route::post('/fp_save',[FPController::class, 'fp_save'])
    ->middleware('guest')
    ->name('fp_save');

// fp reset page
Route::get('/fp_reset_page/{email}',[FPController::class, 'fp_reset_page'])
    ->middleware('guest')
    ->name('fp_reset_page');

// fp reset
Route::post('/fp_reset',[FPController::class, 'fp_reset'])
    ->middleware('guest')
    ->name('fp_reset');




// MODAL VIEWS

// modal view user profile info



Route::get('/info/{user}', [BiodataController::class, 'show_modal_info'])
    ->middleware('auth')
    ->name('show_modal_info');

// Search User on Users table
Route::get('/search_user', [UserController::class, 'search_user'])
    ->middleware('auth')
    ->name('search_user');

Route::get('/hello', function () {

    // return asset('img');

    return UserResource::collection(User::unavailable_members()->get());


    


    return Attendance::find(42)->males_members_present();

    return AttendanceUser::find(822)->residence();

    return User::find(1)->profile_at(2);

    $OneDayAgo = Carbon::now()->subDays(1);

    return User::without_biodata()->where('updated_at' ,'<',$OneDayAgo)->get();

})->middleware('auth');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])
    ->middleware('auth','control:system_online','hasProfile')
    ->name('home');

// Privacy Policy Page
Route::get('/privacy_policy', function () {

return view('privacy-policy');

})->middleware('guest')
    ->name('privacy_policy')
;
