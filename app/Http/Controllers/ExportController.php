<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\UserExport;
use Excel;

class ExportController extends Controller
{
    public function export_user()
    {
        try
        {
            return Excel::download(new UserExport,'userlist.xlsx');
        }
        catch(\Exception $exception)
        {
            return redirect('erreur')->with('messageerreur',$exception->getMessage());
        }
    }

    public function export_user_csv()
    {
        try
        {
            return Excel::download(new UserExport,'userlist.csv');
        }
        catch(\Exception $exception)
        {
            return redirect('erreur')->with('messageerreur',$exception->getMessage());
        }
    }
}
