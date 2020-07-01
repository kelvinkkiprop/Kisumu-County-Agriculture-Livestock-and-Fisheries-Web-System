<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Updates;
use App\Vacancy;
use App\Announcement;
use App\Tender;
use App\Location;

class HomeController extends Controller
{
   
    public function index()
    {
        $updates=Updates::get();
        $vacancies=Vacancy::get()->take(2);
        $announcements=Announcement::paginate(1);
        $tenders=Tender::get()->take(3);
        $locations=Location::get();
        return view('home')->with([
            'updates'=>$updates,
            'vacancies'=>$vacancies,
            'announcements'=>$announcements,
            'tenders'=>$tenders,
            'locations'=>$locations,
        ]); 
    }

    public function faqs()
    {

        return view('common.faqs'); 
    }

    public function help()
    {

        return view('common.help'); 
    }
    
    public function about()
    {
        return view('normal-user.about');
    }

}
