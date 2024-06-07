<?php

namespace App\Http\Controllers;

use App\Models\PersonalInfo;
use App\Requests\PersonalInfoFormRequest;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class PersonalInfoController extends Controller
{
    public function store(PersonalInfoFormRequest $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $data = $request->validated();
                $personalInfo = PersonalInfo::create($data);
                session()->put('personal_info_id', $personalInfo->id);
                DB::commit();
            });

            return redirect()->to("address-info-form")->with('success', 'Personal information saved successfully!');
        } catch (\Exception $e) {
            report($e);
            DB::rollBack();

            return redirect()->to('personal-info-form')->with('error', $e->getMessage());
        }
    }

    public function showForm()
    {
        return Inertia::render('PersonalInformationForm');
    }
}
