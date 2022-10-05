<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompanyRequest;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CompaniesController extends Controller
{
    public function index()
    {
        $companies = Company::paginate(12);
        return view('company.index', compact('companies'));
    }

    public function create()
    {
        return view('company.create');
    }

    public function store(StoreCompanyRequest $request)
    {
        $company = Company::create($request->validated());

        if ($request->has('company_logo')) {
            $file = $request->file('company_logo');
            $name  = uniqid() . '-' . str_replace(' ', '', $file->getClientOriginalName());
            $path = $request->file('company_logo')->storePubliclyAs(Company::FILE_PATH, $name, 'public');

            $model = Company::find($company->id);
            $model->update(['logo' =>  Company::FILE_ACCESS_PATH . $path]);
        }

        return \response()->json([
            'success' => true,
            'message' => 'Record Added',
            'data' => []
        ]);
    }

    public function show(Company $company)
    {
    }

    public function edit(Company $company)
    {
    }

    public function update(Request $request, Company $company)
    {

    }

    public function destroy(Company $company)
    {
        $company->delete();

        return \response()->json([
            'success' => true,
            'message' => 'Record Deleted',
            'data' => []
        ]);
    }
}
