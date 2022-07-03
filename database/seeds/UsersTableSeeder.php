<?php

use Illuminate\Database\Seeder;
use App\User as User;
use Hekmatinasser\Verta\Verta as Verta;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->delete();
//        date_default_timezone_set('Asia/Tehran');
//
//        $datetime = new DateTime('2008-08-03 12:35:23');
//        echo $datetime->format('Y-m-d H:i:s') . "\n";
//        $la_time = new DateTimeZone('Asia/Tehran');
//        $datetime->setTimezone($la_time);
//        $datetime->format('Y-m-d H:i:s');
//
//        \DB::table('logs')->delete();
//        Logs::create([
//            'logDate' => $datetime,
//            'logTime' => $datetime,
//            'logCode' => '001',
//            'user_id' => '1'
//        ]);

        $v = new Verta();
        $time = $v->formatTime();
        $date = $v->formatDate();

        User::create([
            'name' => 'آرش',
            'family' => 'آقاشاهی',
            'username' => 'samandar',
            'national_code' => '1236545896',
            'gender' => 'آقا',
            'birth_date' => $date,
            'cell_phone' => '09125642068',
            'email' => 'arash.in@yahoo.com',
            'password' => bcrypt('sam'),
            'created_at_shamsi' => $date
        ]);

    }
}
