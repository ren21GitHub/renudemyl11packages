<?php

namespace App\Http\Controllers;

use App\DataTables\UserDataTable;
use App\Exports\UsersDataExport;
use App\Models\User;
use PDF;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\DataTables;

use function Termwind\render;

class UserController extends Controller
{
    public function index(UserDataTable $dataTable)
    {
        return $dataTable->render('dashboard');
    }

    // public function dataTableLogic(Request $request)
    // {     
    //     if ($request->ajax()) {
    //         $users = User::query();
    //         return DataTables::of($users)
    //             ->make(true);
    //     }
    //     // return view('datatables');
    //     return view('dashboard');
    // }

    // public function exportExcel(){
    //     return Excel::download(new UsersDataExport, 'users-data.xlsx');
    // }

    // public function exportCsv(){
    //     return Excel::download(new UsersDataExport, 'users-data.csv');
    // }

    // public function exportPdf(){
    //     $users = User::query()->get();
    //     $data = [
    //         'title' => 'welcome to ren',
    //         'date' => date('m/d/Y'),
    //         'users' => $users
    //     ];
    //     $pdf = PDF::loadView('pdf.pdf-data', $data );
    //     return $pdf->download('users-data.pdf');
    // }
}
