<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vacancy;
use App\VacancyApplication;

class VacancyController extends Controller
{
    public function vacancies()
    {
        $vacancies = Vacancy::paginate(5);

        return view('normal-user.vacancies')->with([
            'vacancies' => $vacancies,
        ]);
        
    }
    
    public function storevacancy(Request $request)
    {
        $this->validate($request, [
            'position' => 'required',
            'number' => 'required',
            'description' => 'required',
            'closing_date' => 'required|date|after_or_equal:today',
        ]);
         $vacancy = new Vacancy;
         $vacancy->position = $request->input('position');
         $vacancy->number = $request->input('number');
         $vacancy->description = $request->input('description');
         $vacancy->closing_date = $request->input('closing_date');         
         $vacancy->save();

         return redirect()->back()->with('success', 'Vacancy added!');       
    }


    public function updatevacancy(Request $request, $id)
    {
        $this->validate($request, [
            'position' => 'required',
            'number' => 'required',
            'description' => 'required',
            'closing_date' => 'required|date|after_or_equal:today',
        ]);
         $vacancy = Vacancy::find($id);;
         $vacancy->position = $request->input('position');
         $vacancy->number = $request->input('number');
         $vacancy->description = $request->input('description');
         $vacancy->closing_date = $request->input('closing_date');         
         $vacancy->save();

         return redirect()->back()->with('info', 'Vacancy updated!');       
    }

    public function deletevacancy($id)
    {
       $vacancy = Vacancy::find($id);
       $vacancy->delete();
       return redirect()->back()->with('error', 'Vacancy deleted!'); 
    }


    public function applyvacancy()
    {
        $vacancies = Vacancy::all();

        return view('normal-user.apply-vacancy')->with([
            'vacancies' => $vacancies,
        ]);
        
    }

    public function storevacancyapplication(Request $request)
    {
        $this->validate($request, [
            'position' => 'required',
            'name' => 'required',
            'cv' => 'required|mimes:docx,pdf|max:2048',
            ]);
            $cvname = '';
            if ($request->hasFile('cv')) {
                if($request->file('cv')->isValid()) {
                    try {
                        $file = $request->file('cv');
                        $cvname = time(). '.' . $file->getClientOriginalExtension();
                        $destinationPath = public_path('uploads/documents');               
                        $request->file('cv')->move($destinationPath, $cvname);
                    } catch (Illuminate\Filesystem\FileNotFoundException $e) {
                        return redirect()->back()->with('erro', ''.$e);
                    }
                }
            }
         $vacancy = new VacancyApplication;
         $vacancy->position = $request->input('position');
         $vacancy->name = $request->input('name');
         $vacancy->cv = $cvname;         
         $vacancy->save();

         return redirect()->back()->with('success', 'Application submitted successfully!');       
        
    }

}
