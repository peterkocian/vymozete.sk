<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InterestRateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('interest_rate')->insert([
            //FO
            [
                'person_type'   => 0,
                'date'          => '2013-02-01',
                'coefficient'   => 5.75,
                'created_at'    => \Carbon\Carbon::now(),
                'updated_at'    => \Carbon\Carbon::now(),
            ],[
                'person_type'   => 0,
                'date'          => '2013-05-08',
                'coefficient'   => 5.50,
                'created_at'    => \Carbon\Carbon::now(),
                'updated_at'    => \Carbon\Carbon::now(),
            ],[
                'person_type'   => 0,
                'date'          => '2013-11-13',
                'coefficient'   => 5.25,
                'created_at'    => \Carbon\Carbon::now(),
                'updated_at'    => \Carbon\Carbon::now(),
            ],[
                'person_type'   => 0,
                'date'          => '2014-06-11',
                'coefficient'   => 5.15,
                'created_at'    => \Carbon\Carbon::now(),
                'updated_at'    => \Carbon\Carbon::now(),
            ],[
                'person_type'   => 0,
                'date'          => '2014-09-10',
                'coefficient'   => 5.05,
                'created_at'    => \Carbon\Carbon::now(),
                'updated_at'    => \Carbon\Carbon::now(),
            ],[
                'person_type'   => 0,
                'date'          => '2015-12-09',
                'coefficient'   => 5.05,
                'created_at'    => \Carbon\Carbon::now(),
                'updated_at'    => \Carbon\Carbon::now(),
            ],[
                'person_type'   => 0,
                'date'          => '2016-03-16',
                'coefficient'   => 5.00,
                'created_at'    => \Carbon\Carbon::now(),
                'updated_at'    => \Carbon\Carbon::now(),
            ],[
                'person_type'   => 0,
                'date'          => '2017-01-01',
                'coefficient'   => 5.00,
                'created_at'    => \Carbon\Carbon::now(),
                'updated_at'    => \Carbon\Carbon::now(),
            ],
            //PO
            [
                'person_type'   => 1,
                'date'          => '2009-01-01',
                'coefficient'   => 12.50,
                'created_at'    => \Carbon\Carbon::now(),
                'updated_at'    => \Carbon\Carbon::now(),
            ],[
                'person_type'   => 1,
                'date'          => '2009-01-15',
                'coefficient'   => 10.50,
                'created_at'    => \Carbon\Carbon::now(),
                'updated_at'    => \Carbon\Carbon::now(),
            ],[
                'person_type'   => 1,
                'date'          => '2009-01-21',
                'coefficient'   => 10.00,
                'created_at'    => \Carbon\Carbon::now(),
                'updated_at'    => \Carbon\Carbon::now(),
            ],[
                'person_type'   => 1,
                'date'          => '2009-03-11',
                'coefficient'   => 9.50,
                'created_at'    => \Carbon\Carbon::now(),
                'updated_at'    => \Carbon\Carbon::now(),
            ],[
                'person_type'   => 1,
                'date'          => '2009-04-08',
                'coefficient'   => 9.25,
                'created_at'    => \Carbon\Carbon::now(),
                'updated_at'    => \Carbon\Carbon::now(),
            ],[
                'person_type'   => 1,
                'date'          => '2009-05-13',
                'coefficient'   => 9.00,
                'created_at'    => \Carbon\Carbon::now(),
                'updated_at'    => \Carbon\Carbon::now(),
            ],[
                'person_type'   => 1,
                'date'          => '2011-04-13',
                'coefficient'   => 9.25,
                'created_at'    => \Carbon\Carbon::now(),
                'updated_at'    => \Carbon\Carbon::now(),
            ],[
                'person_type'   => 1,
                'date'          => '2011-07-13',
                'coefficient'   => 9.50,
                'created_at'    => \Carbon\Carbon::now(),
                'updated_at'    => \Carbon\Carbon::now(),
            ],[
                'person_type'   => 1,
                'date'          => '2011-11-09',
                'coefficient'   => 9.25,
                'created_at'    => \Carbon\Carbon::now(),
                'updated_at'    => \Carbon\Carbon::now(),
            ],[
                'person_type'   => 1,
                'date'          => '2011-12-14',
                'coefficient'   => 9.00,
                'created_at'    => \Carbon\Carbon::now(),
                'updated_at'    => \Carbon\Carbon::now(),
            ],[
                'person_type'   => 1,
                'date'          => '2012-07-11',
                'coefficient'   => 8.75,
                'created_at'    => \Carbon\Carbon::now(),
                'updated_at'    => \Carbon\Carbon::now(),
            ],[
                'person_type'   => 1,
                'date'          => '2013-02-01',
                'coefficient'   => 9.75,
                'created_at'    => \Carbon\Carbon::now(),
                'updated_at'    => \Carbon\Carbon::now(),
            ],[
                'person_type'   => 1,
                'date'          => '2013-05-08',
                'coefficient'   => 9.25,
                'created_at'    => \Carbon\Carbon::now(),
                'updated_at'    => \Carbon\Carbon::now(),
            ],[
                'person_type'   => 1,
                'date'          => '2013-11-13',
                'coefficient'   => 9.25,
                'created_at'    => \Carbon\Carbon::now(),
                'updated_at'    => \Carbon\Carbon::now(),
            ],[
                'person_type'   => 1,
                'date'          => '2014-06-11',
                'coefficient'   => 9.15,
                'created_at'    => \Carbon\Carbon::now(),
                'updated_at'    => \Carbon\Carbon::now(),
            ],[
                'person_type'   => 1,
                'date'          => '2014-09-10',
                'coefficient'   => 9.05,
                'created_at'    => \Carbon\Carbon::now(),
                'updated_at'    => \Carbon\Carbon::now(),
            ],[
                'person_type'   => 1,
                'date'          => '2015-01-01',
                'coefficient'   => 8.05,
                'created_at'    => \Carbon\Carbon::now(),
                'updated_at'    => \Carbon\Carbon::now(),
            ],[
                'person_type'   => 1,
                'date'          => '2015-07-01',
                'coefficient'   => 8.05,
                'created_at'    => \Carbon\Carbon::now(),
                'updated_at'    => \Carbon\Carbon::now(),
            ],[
                'person_type'   => 1,
                'date'          => '2016-01-01',
                'coefficient'   => 8.05,
                'created_at'    => \Carbon\Carbon::now(),
                'updated_at'    => \Carbon\Carbon::now(),
            ],[
                'person_type'   => 1,
                'date'          => '2016-03-16',
                'coefficient'   => 8.00,
                'created_at'    => \Carbon\Carbon::now(),
                'updated_at'    => \Carbon\Carbon::now(),
            ],[
                'person_type'   => 1,
                'date'          => '2017-01-01',
                'coefficient'   => 8.00,
                'created_at'    => \Carbon\Carbon::now(),
                'updated_at'    => \Carbon\Carbon::now(),
            ]
        ]);
    }
}
