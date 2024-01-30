<?php

namespace Tests\Feature;

use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Hekmatinasser\Verta\Verta;

class TestDates extends TestCase
{
    public function testExample()
    {
        $myDate = Carbon::now()->toDateString();
        $myPersianDate = new Verta();
        dd($myPersianDate->formatDate());
//        dd($myDate);
        // so as you see it looks real good arash and will indeed print the current date sir :)
        // the only job here remains is the fact that i gotta change all dates
        // and hence also change all the inputs too sir arash :)
    }
}