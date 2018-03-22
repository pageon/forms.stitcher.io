<?php

namespace App\Http\Controllers;

use App\Form;
use App\FormTable;
use App\Http\Requests\StoreForm;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Classes\LaravelExcelWorksheet as Sheet;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Writers\LaravelExcelWriter as ExcelWriter;

class FormsController extends Controller
{
    public function store(StoreForm $request, User $user)
    {
        $data = $request->except([
            'referer'
        ]);

        Form::create([
            'user_id' => $user->id,
            'data' => $data,
        ]);

        if ($redirect = $request->get('referer')) {
            return redirect()->to($redirect);
        }
    }

    public function download(Request $request)
    {
        $user = Auth::user();

        $table = new FormTable($user->forms);

        $format = $request->get('format') ?? 'csv';

        Excel::create(now()->format('Y-m-d') . "-{$user->uuid}", function (ExcelWriter $writer) use ($table) {
            $writer->sheet('Form', function (Sheet $sheet) use ($table) {
                $sheet->fromArray($table->getData());
            });
        })->download($format);
    }
}
