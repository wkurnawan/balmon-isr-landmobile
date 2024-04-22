<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateLandmobileRequest;
use App\Imports\LandmobileImport;
use App\Models\Landmobile;
use Illuminate\Http\Request;

class LandmobileController extends Controller
{
    public function index(Landmobile $landmobile)
    {
        $landmobiles = $landmobile->latest()->take(1000)->get();
        // dd($landmobiles);
        return view('pages.landmobile.index', compact('landmobiles'));
    }

    public function import(Request $request)
    {
        $request->validate([
            'import_file' => [
                'required',
                'file',
                'mimes:xlsx,xls,csv',
                'max:2048',
            ],
        ]);

        $file = $request->file('import_file');

        // validate if all rows have license_id fillied
        $import = new LandmobileImport();
        if (!$import->allRowsHaveLicId($file)) {
            return redirect(route('landmobiles.index'))->with('warning', 'Semua baris harus memiliki nilai untuk license_id.');
        }

        $import->import($file);

        return redirect(route('landmobiles.index'))->with('success', 'Data landmobile berhasil diimport.');
    }

    public function edit(Landmobile $landmobile)
    {
        return view('pages.landmobile.edit', compact('landmobile'));
    }

    public function update(Landmobile $landmobile, UpdateLandmobileRequest $updateLandmobileRequest)
    {
        $data = $updateLandmobileRequest->validated();
        $landmobile->update($data);
        return redirect(route('landmobiles.index'))->with('success', 'Data landmobile berhasil diperbarui.');
    }

    public function destroy(Landmobile $landmobile)
    {
        $landmobile->delete();
        return redirect(route('landmobiles.index'))->with('success', 'Data landmobile berhasil dihapus.');
    }
}
