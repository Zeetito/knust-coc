<?php

namespace Database\Seeders;

use App\Models\YearGroup;
use Illuminate\Database\Seeder;

class YearGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $year_groups = [

            ['name' => 'CLASS OF 2000', 'year' => 2000],
            ['name' => 'CLASS OF 2001', 'year' => 2001],
            ['name' => 'CLASS OF 2002', 'year' => 2002],
            ['name' => 'CLASS OF 2003', 'year' => 2003],
            ['name' => 'CLASS OF 2004', 'year' => 2004],
            ['name' => 'CLASS OF 2005', 'year' => 2005],
            ['name' => 'CLASS OF 2006', 'year' => 2006],
            ['name' => 'CLASS OF 2007', 'year' => 2007],
            ['name' => 'CLASS OF 2008', 'year' => 2008],
            ['name' => 'CLASS OF 2009', 'year' => 2009],
            ['name' => 'CLASS OF 2010', 'year' => 2010],
            ['name' => 'CLASS OF 2011', 'year' => 2011],
            ['name' => 'CLASS OF 2012', 'year' => 2012],
            ['name' => 'CLASS OF 2013', 'year' => 2013],
            ['name' => 'CLASS OF 2014', 'year' => 2014],
            ['name' => 'CLASS OF 2015', 'year' => 2015],
            ['name' => 'CLASS OF 2016', 'year' => 2016],
            ['name' => 'CLASS OF 2017', 'year' => 2017],
            ['name' => 'CLASS OF 2018', 'year' => 2018],
            ['name' => 'CLASS OF 2019', 'year' => 2019],
            ['name' => 'CLASS OF 2020', 'year' => 2020],
            ['name' => 'CLASS OF 2021', 'year' => 2021],
            ['name' => 'CLASS OF 2022', 'year' => 2022],
            ['name' => 'CLASS OF 2023', 'year' => 2023],

        ];

        foreach ($year_groups as $year_group) {
            YearGroup::create($year_group);
        }
    }
}
