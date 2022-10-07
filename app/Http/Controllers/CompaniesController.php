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


    // ajax part
    public function serversideCompaniesRender()
    {
        // DB table to use
        $table = 'companies';

        // Table's primary key
        $primaryKey = 'id';

        // Array of database columns which should be read and sent back to DataTables.
        // The `db` parameter represents the column name in the database, while the `dt`
        // parameter represents the DataTables column identifier. In this case simple
        // indexes
        $columns = array(
            array('db' => 'id', 'dt' => 0),
            array('db' => 'logo', 'dt' => 1),
            array('db' => 'name', 'dt' => 2),
            array('db' => 'email', 'dt' => 3),
            array('db' => 'employees', 'dt' => 4)
        );

        // SQL server connection information
        $sql_details = array(
            'user' => 'root',
            'pass' => '',
            'db' => 'minicrm_db',
            'host' => '127.0.0.1:8000'
        );


        /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
         * If you just want to use the basic configuration for DataTables with PHP
         * server-side, there is no need to edit below this line.
         */

        require('ssp.class.php');

        echo json_encode(
            SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns)
        );
    }
}
