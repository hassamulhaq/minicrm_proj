<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Yajra\DataTables\Facades\DataTables;

class APICompaniesController extends Controller
{
    public function index()
    {

    }


    public function serversideCompaniesRender()
    {
        $model = Company::select(['id', 'logo', 'name', 'email', 'created_at'])
                ->withCount('employees');

        return DataTables::eloquent($model)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                return '<div class="btn-group"><a href="'.route('admin.company.show', $row->id).'" class="btn btn-sm btn-outline-success">Show</a><a href="'.route('admin.company.edit', $row->id).'" class="btn btn-sm btn-outline-info">Edit</a></div>';
            })
            ->setRowAttr(['data-testing' => 'tmp'])
            ->editColumn('logo', function($row) {
                return '<img src="'.$row->logo.'" alt="logo">';
            })
            ->editColumn('created_at', function ($row) {
                return $row->created_at->diffForHumans();
            })
            ->rawColumns(['action', 'logo'])
            ->toJson();
    }
}
