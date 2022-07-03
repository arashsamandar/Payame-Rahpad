<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hekmatinasser\Verta\Verta;

class PageManager extends Controller
{
    public function makePages($pagename) {

        $verta_object = new Verta();
        $today_date = $verta_object->formatDate();
        $contents = \DB::table('contents')->select('title','brief','definition','page_address')
            ->where('title','=',$pagename)
            ->where('End_at','>=',$today_date)->get();

        $page_title = null;
        $page_brief = null;
        $page_content = null;
        $page_address = null;
        foreach ($contents as $content) {
            $page_title = $content->title;
            $page_brief = $content->brief;
            $page_content = $content->definition;
            $page_address = $content->page_address;
        }

        if($page_address != null) {
            $address = 'http://' . $page_address;
            return redirect($address);
        }
        elseif($page_content != null) {
            return view('dynamicPages',compact(['page_title','page_brief','page_content']));
        } else {
            return redirect()->route('notfound');
        }
    }

    public function goToAddress($website) {
        $verta_object = new Verta();
        $today_date = $verta_object->formatDate();
        $address = \DB::table('contents')->select('page_address')->where('page_address','=',$website)
            ->where('End_at','>=',$today_date)->get();
        $page_address = null;

        foreach ($address as $address_object) {
            $page_address = $address_object->page_address;
        }
        if($page_address != null) {
            return \Redirect::to($page_address);
        } else {
            return view('MainPages.aboutUs');
        }
    }

    public function index()
    {
        return view('Layouts.app');
    }

    public function pagenotfound() {
        $page_title = 'پیدا نشد';
        return view('errors.404',compact('page_title'));
    }

    //----------------------- TEST ------------------------

    public function testing() {
        return view('tesing');
    }

}
