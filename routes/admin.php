<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\GuestController;
use App\Http\Controllers\Admin\ConfigController;
use App\Http\Controllers\AccountRecordController;
use App\Http\Controllers\Admin\UserRequestController;
use App\Http\Controllers\Admin\GuestRequestController;
use App\Http\Controllers\Admin\MinistrySpaceController;

use App\Http\Controllers\FPController;

// -------------------ADMIN PAGES GROUPS ROUTES--------------
Route::prefix('admin')->middleware('auth', 'control:system_online', 'role:zone_reps_level')->group(function () {
    // DASHBOARD
        // USER RELATED

        // USER STATISTICS

        // Members
        Route::get('/stats_members',[UserController::class,'stats_members'])
        ->name('stats_members')
        ;


        // MINISTRIES SPACE
        // Landing Page
        Route::get('/ministry_index/{ministry}',[MinistrySpaceController::class,'ministry_index'])
        ->name('ministry_index')
        ;
        // View Ministry Shared Items
        Route::get('/ministry_received_items/{ministry}',[MinistrySpaceController::class,'received_items'])
        ->name('ministry_received_items')
        ;


        // ACCOUNTS-SESSIONS

        // Share  Account page Session
        Route::get('/share_account_sessions/{account}/{ministry}/{sendable}',[AccountController::class,'create_share'])
        ->name('share_account_sessions')
        ;

        // View Account Sessions for Ministry
        Route::get('/ministry_account_sessions/{ministry}',[MinistrySpaceController::class,'account_sessions'])
        ->name('ministry_account_sessions')
        ;

        // Create Account Session For A ministry
        Route::get('/create_ministry_account_session/{ministry}',[AccountController::class,'create_ministry_account_session'])
        ->name('create_ministry_account_session')
        ;

        // Store Ministry Account Session
        Route::post('/store_ministry_account_session/{ministry}',[AccountController::class,'store_ministry_account_session'])
        ->name('store_ministry_account_session')
        ;

        // Update Ministry account Session
        Route::put('/update_ministry_account_session/{account}',[AccountController::class,'update_ministry_account_session'])
        ->name('update_ministry_account_session')
        ;
        // Edit Ministry account Session
        Route::get('/edit_ministry_account_session/{ministry}/{account}',[AccountController::class,'edit_ministry_account_session'])
        ->name('edit_ministry_account_session')
        ;


        // Show Ministry Acccount Session
        Route::get('/show_ministry_account_session/{account}',[AccountController::class,'show_ministry_account_session'])
        ->name('show_ministry_account_session')
        ;

        // Confirm Ministry Account Session Delete
        Route::get('/confirm_delete_ministry_account_session/{account}',[AccountController::class,'confirm_delete_ministry_account_session'])
        ->name('confirm_delete_ministry_account_session')
        ;

        // Delete Account Session
        Route::delete('/delete_ministry_account_session/{account}',[AccountController::class,'delete_ministry_account_session'])
        ->name('delete_ministry_account_session')
        ;        


        // ACCOUTN RECORDS
        // Create Minsitry Account Records
        Route::get('/create_ministry_account_record/{account}',[AccountRecordController::class,'create_ministry_account_record'])
        ->name('create_ministry_account_record')
        ;
        // Store Ministry Account Records
        Route::post('/store_ministry_account_record/{account}',[AccountRecordController::class,'store_ministry_account_record'])
        ->name('store_ministry_account_record')
        ;

        // Edit Account Record
        Route::get('/edit_account_record/{record}',[AccountRecordController::class,'edit_account_record'])
        ->name('edit_account_record')
        ;

        // Update Account Record
        Route::put('/update_account_record/{record}',[AccountRecordController::class,'update_account_record'])
        ->name('update_account_record')
        ;

        // Confirm Record Delete
        Route::get('/confirm_delete_account_record/{record}',[AccountRecordController::class,'confirm_delete_account_record'])
        ->name('confirm_delete_account_record')
        ;        

        // Delete Record
        Route::delete('/delete_account_record/{record}',[AccountRecordController::class,'delete_account_record'])
        ->name('delete_account_record')
        ;        



        // USERS WITHOUT BIODATA
        // Index page
        Route::get('/without_biodata',[UserController::class,'without_biodata'])
            ->name('users_without_biodata')
            ;

        // Search
        Route::get('/search_users_without_biodata',[UserController::class,'search_users_without_biodata'])
        ->name('search_users_without_biodata')
        ;
        
        // Filter
        Route::get('/filter_users_without_biodata',[UserController::class,'filter_users_without_biodata'])
        ->name('filter_users_without_biodata')
        ;

        
        // USER REQUESTS



        // View all user request
        Route::get('user_requests',[UserRequestController::class, 'show_user_requests'])
            ->name('show_user_requests')
            ;

        // Search User request
        Route::get('search_user_requests',[UserRequestController::class, 'search_user_requests'])
            ->name('search_user_requests')
            ;
        // Search Users with request
        Route::get('search_user_with_request',[UserRequestController::class, 'search_user_with_request'])
            ->name('search_user_with_request')
            ;

        // Filter User Requests
        Route::get('filter_user_requests', [UserRequestController::class, 'filter_user_requests'])
            ->name('filter_user_requests');

        // Edit Guest Request - modal 
        Route::get('edit_user_request/{user_request}',[UserRequestController::class, 'edit_user_request'])
            ->name('edit_user_request')
            ;
        
        // Handle User request - Deny or Grant
        Route::post('handle_user_request/{user_request}',[UserRequestController::class, 'handle_user_request'])
            ->name('handle_user_request')
            ;


        // GUEST REQUESTS
        // View all guest requests
        Route::get('guest_requests',[GuestController::class, 'show_guest_requests'])
            ->name('show_guest_requests')
            ;  
        
        // Search Guest request
        Route::get('search_guest_requests',[GuestController::class, 'search_guest_requests'])
            ->name('search_guest_requests')
            ;

        // Filter Guest Requests
        Route::get('filter_guest_requests', [GuestController::class, 'filter_guest_requests'])
            ->name('filter_guest_requests')
            ;

        // Edit Guest Request - modal 
        Route::get('edit_guest_request/{guest_request}',[GuestRequestController::class, 'edit_guest_request'])
            ->name('edit_guest_request')
            ;

        // Handle Guest request - Deny or Grant
        Route::post('handle_guest_request/{guest_request}',[GuestRequestController::class, 'handle_guest_request'])
            ->name('handle_guest_request')
            ;

        // Assign Guest Request
        Route::get('assign_guest_request/{guest_request}',[GuestRequestController::class, 'assign_guest_request'])
        ->name('assign_guest_request')
        ;

        // Assign Guest Request To User
        Route::post('assign_guest_request_to/{guest_request}',[GuestRequestController::class, 'assign_guest_request_to'])
        ->name('assign_guest_request_to')
        ;

        // view_assigned_guest_request
        Route::get('view_assigned_guest_request/{user}',[GuestRequestController::class, 'view_assigned_guest_request'])
        ->name('view_assigned_guest_request')
        ;

        // Handel Bulk Guest Request Page
        Route::get('handle_bulk_guest_request_page',[GuestRequestController::class, 'handle_bulk_guest_request_page'])
        ->name('handle_bulk_guest_request_page')
        ;

        // Bulk Handle Guests requests
        Route::post('bulk_handle_guests_requests',[GuestRequestController::class, 'bulk_handle_guests_requests'])
        ->name('bulk_handle_guests_requests')
        ;


            
        // UNAVAILABLE MEMBERS
        // Show All Unavailable Members
        Route::get('unavailable_members', [UserController::class, 'show_unavailable_members'])
            ->name('show_unavailable_members');

        // Search Unavailable members
        Route::get('search_unavailable_members', [UserController::class, 'search_unavailable_members'])
            ->name('search_unavailable_members');

        // Filter Unavailable Members
        Route::get('filter_unavailable_members', [UserController::class, 'filter_unavailable_members'])
            ->name('filter_unavailable_members');

        // Edit Unavailable Members Status - returns Modal
        Route::get('edit_unavailable_members_status/{user}', [UserController::class, 'edit_unavailable_members_status'])
            ->name('edit_unavailable_members_status');

        // Update Unavailable Members Status
        Route::put('update_unavailable_members_status/{user}', [UserController::class, 'update_unavailable_members_status'])
            ->name('update_unavailable_members_status');
        // Mark unvailable confim - MOdal
        Route::get('mark_unavailable_confirm/{user}',[UserController::class,'mark_unavailable_confirm'])
            ->name('mark_unavailable_confirm')
            ;
        Route::post('mark_user_unavailable/{user}',[UserController::class,'mark_user_unavailable'])
            ->name('mark_user_unavailable')
            ;
        // INACTIVE USERS
        // Show All Inactive Accounts
        Route::get('inactive_accounts', [UserController::class, 'show_inactive_accounts'])
            ->name('show_inactive_accounts');
        // Search Inactive Accounts
        Route::get('search_inactive_accounts', [UserController::class, 'search_inactive_user'])
            ->name('search_inactive_user');

        // Filter Inactive Accounts
        Route::get('filter_inactive_users', [UserController::class, 'filter_inactive_users'])
            ->name('filter_inactive_users');

        // Edit Inactive Account Status - returns Modal
        Route::get('edit_inactive_account_status/{user}', [UserController::class, 'edit_inactive_account_status'])
            ->name('edit_inactive_account_status');
        // Mark User inactive confirm
        Route::get('mark_user_inactive_confirm/{user}',[UserController::class, 'mark_user_inactive_confirm'])
            ->name('mark_user_inactive_confirm')
            ;
        // Mark User Inactive
        Route::post('mark_user_inactive/{user}',[UserController::class, 'mark_user_inactive'])
            ->name('mark_user_inactive')
            ;

        // Update Inactive Account Status
        Route::put('update_inactive_account_status/{user}', [UserController::class, 'update_inactive_account_status'])
            ->name('update_inactive_account_status')
            ;

        // HOME
        Route::get('home', [UserController::class, 'home'])
            ->name('admin_home');

    
    // CONFIGURATIONS
        // Index Page
        Route::get('config',[ConfigController::class,'index'])
            ->middleware('role:ministry_members_level')
            ->name('admin_config')
        ;

        // Confirm System Switch On
        Route::get('confirm_system_switch_on',[ConfigController::class,'confirm_system_switch_on'])
            ->middleware('role:ministry_members_level')
            ->name('confirm_system_switch_on')
        ;

        //  System Switch On
        Route::post('switch_system_online',[ConfigController::class,'switch_system_online'])
            ->middleware('role:ministry_members_level')
            ->name('switch_system_online')
        ;

        // Confirm System Switch On
            Route::get('confirm_system_switch_off',[ConfigController::class,'confirm_system_switch_off'])
            ->middleware('role:ministry_members_level')
            ->name('confirm_system_switch_off')
        ;

        // System Switch Off
        Route::post('switch_system_offline',[ConfigController::class,'switch_system_offline'])
            ->middleware('role:ministry_members_level')
            ->name('switch_system_offline')
        ;

        // ACADEMIC YEAR
        // Create New Academic Year - modal
        Route::get('create_new_academic_year',[ConfigController::class,'create_new_academic_year'])
        ->middleware('role:ministry_members_level')
        ->name('create_new_academic_year')
        ;

        // Store New Academic Year
        Route::post('store_new_academic_year',[ConfigController::class,'store_new_academic_year'])
        ->middleware('role:ministry_members_level')
        ->name('store_new_academic_year')
        ;

        // Delete Current Academic Year - modal
        Route::get('delete_current_academic_year',[ConfigController::class,'delete_current_academic_year'])
        ->middleware('role:ministry_members_level')
        ->name('delete_current_academic_year')
        ;


        // View Forgot password Requests
        Route::get('fp_index',[FPController::class,'fp_index'])
        ->middleware('auth', 'role:ministry_members_level')
        ->name('fp_index')
        ;
        


});

// ------------------END ADMIN PAGES GROUPS ROUTES------------------
