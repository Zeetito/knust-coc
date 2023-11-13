<?php
namespace App\Helpers;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class UniqueAcrossTables implements Rule
{
    protected $tables;
    protected $column;

    public function __construct(array $tables, string $column)
    {
        $this->tables = $tables;
        $this->column = $column;
    }

    public function passes($attribute, $value)
    {
        foreach ($this->tables as $table) {
            $count = DB::table($table)
                ->where($this->column, $value)
                ->count();

            if ($count > 0) {
                return false; // Value is not unique across tables
            }
        }

        return true; // Value is unique across tables
    }

    public function message()
    {
        return 'The :attribute must be unique across specified tables.';
    }
}
