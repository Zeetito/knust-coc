<?php

namespace App\Models;
use App\Models\User;
use App\Models\Guest;
use App\Models\GuestRequest;
use Illuminate\Http\Request;
use App\Models\SemesterProgram;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Guest extends Model
{
    use HasFactory;

    protected $fillable = [
        'fullname',
        'is_member',
        'local_congregation',
    ];

    // RELATIONSHIPS
    // Programs officiated by the user
    public function programsOfficiated()
    {
        return $this->belongsToMany(SemesterProgram::class, 'officiators_programs', 'officiator_id', 'semester_program_id');
    }

    // Get All Guest request
    public static function guest_requests(){
        return GuestRequest::where('is_handled',0)->latest();
    }

    // Search Guest By Name/Username
    public static function search_guest(Request $request)
    {

        $string = $request->input('str');
        $str = '%'.$string.'%';

        // Check if the input is empty or not
        // Define user collection if not...
        if (! empty($string)) {
            $guests = Guest::
                            //Searching firstname,lastname and username
                            where((DB::raw("CONCAT(fullname, ' ', username)")), 'like', $str)
                            ;

            // Define user collection if empty...
        } else {
            //  $users = User::
            //  $users = User::paginate($perPage = 25, $columns = ['*'], $pageName = "Users" );
            $guests = Guest::orderBy('id');

        }
        // Retrieve the needed component

        return $guests;

    }

    // FUNCTIONS

}
