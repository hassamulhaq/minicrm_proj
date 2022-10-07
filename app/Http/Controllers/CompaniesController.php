<?php

namespace App\Http\Controllers;

use App\Events\CompanyRegisteredEvent;
use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Models\Company;
use App\Models\User;
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

        if ($request->has('company_logo') && is_object($company)) {
            $file = $request->file('company_logo');
            $name  = uniqid() . '-' . str_replace(' ', '', $file->getClientOriginalName());
            $path = $request->file('company_logo')->storePubliclyAs(Company::FILE_PATH, $name, 'public');

            $model = Company::find($company->id);
            $model->update(['logo' =>  Company::FILE_ACCESS_PATH . $path]);
        }

        // event dispatched
        \Event::dispatch(new CompanyRegisteredEvent($company));

        return \response()->json([
            'success' => true,
            'message' => 'Record Added',
            'data' => []
        ]);
    }

    public function show(Company $company)
    {
        return view('company.show', compact('company'));
    }

    public function edit(Company $company)
    {
        return view('company.update', compact('company'));
    }

    public function update(UpdateCompanyRequest $request, Company $company)
    {
        $company = Company::find($company->id);

        // only update logo if new file assign, if not then stain old one
        if ($request->has('company_logo')) {
            $file = $request->file('company_logo');
            $name  = uniqid() . '-' . str_replace(' ', '', $file->getClientOriginalName());
            $path = $request->file('company_logo')->storePubliclyAs(Company::FILE_PATH, $name, 'public');

            $company->update(['logo' =>  Company::FILE_ACCESS_PATH . $path]);
        }

        $company->update($request->validated());

        return \response()->json([
            'success' => true,
            'message' => 'Record Updated!',
            'data' => []
        ]);
    }

    public function destroy(Company $company)
    {
        $company->delete();

        return redirect()->route('admin.company.index')->with(['message' => 'Record Deleted!']);
    }

    public function getAllCompanies() {
        return Company::all(['id', 'name']);
    }


    public function simpleCompanies()
    {
        $companies = Company::all();
        return view('company.simple-index', compact('companies'));
    }


    public function serversideCompanies()
    {
        return view('company.serverside-index');
    }
}
