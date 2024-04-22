<?php

namespace App\Http\Controllers;

use App\Models\Landmobile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GrafikController extends Controller
{
    public function dashboardGrafik()
    {
        // Mendapatkan data terakhir isr
        $dataTerakhirIsr = DB::table('landmobiles')
            ->select(DB::raw('MONTH(mon_query) as month, YEAR(mon_query) as year'))
            ->orderBy('mon_query', 'desc')
            ->first();

        // Jika data terakhir tidak null, kita gunakan bulan dan tahunnya untuk filter data
        if ($dataTerakhirIsr !== null) {
            $count_city_isr = DB::table('landmobiles')
                ->select('city', DB::raw('COUNT(city) as total'))
                ->whereMonth('mon_query', $dataTerakhirIsr->month)
                ->whereYear('mon_query', $dataTerakhirIsr->year)
                ->groupBy('city')
                ->get();
        } else {
            // Jika tidak ada data terakhir, tampilkan pesan atau beri tindakan yang sesuai
            $count_city_isr = [];
        }

        // save data to array
        $isrCity = [];
        $isrData = [];

        foreach ($count_city_isr as $city) {
            $isrCity[] = $city->city;
            $isrData[] = $city->total;
        }

        // grand total isr
        $grandTotalIsr = array_sum($isrData);

        // dd($isrCity, $isrData, $bhpCity, $bhpData);
        return view('pages.dashboard')
            ->with('isrCity', $isrCity)
            ->with('isrData', $isrData)
            ->with('grandTotalIsr', $grandTotalIsr);
    }

    public function grafik(Request $request)
    {
        // get parameters month and year
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');

        // if month and year is null
        if (empty($bulan) || empty($tahun)) {
            $dataTerakhir = DB::table('landmobiles')
                ->select(DB::raw('MONTH(mon_query) as month, YEAR(mon_query) as year'))
                ->orderBy('mon_query', 'desc')
                ->first();

            if ($dataTerakhir !== null) {
                $bulan = $dataTerakhir->month;
                $tahun = $dataTerakhir->year;
            } else {
                // Handle the case when $dataTerakhir is null
                $bulan = date(''); // kosongkan
                $tahun = date('Y');
            }
        }

        // use parameters to get data
        $count_city = DB::table('landmobiles')
            ->select('city', DB::raw('COUNT(city) as total'))
            ->whereMonth('mon_query', $bulan)
            ->whereYear('mon_query', $tahun)
            ->groupBy('city')
            ->get();

        // save data to array
        $labels = [];
        $data = [];

        foreach ($count_city as $city) {
            $labels[] = $city->city;
            $data[] = $city->total;
        }

        // send year to select
        $tahuns = Landmobile::selectRaw('YEAR(mon_query) as tahuns')
            ->distinct()
            ->pluck('tahuns');

        // grand total isr
        $grandTotalIsr = array_sum($data);

        // dd($tahuns);
        return view('pages.grafik.index')
            ->with('data', $data)
            ->with('labels', $labels)
            ->with('tahuns', $tahuns)
            ->with('bulan', $bulan)
            ->with('tahun', $tahun)
            ->with('grandTotalIsr', $grandTotalIsr);
    }
}
