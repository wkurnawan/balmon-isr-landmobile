<?php

namespace App\Imports;

use App\Models\Landmobile;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class LandmobileImport implements ToCollection, WithHeadingRow, WithValidation, SkipsOnFailure
{
    use Importable, SkipsFailures;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row)
        {
            Landmobile::create([
                'license_id_mon_query' => $row['license_id_mon_query'],
                'license_id' => $row['license_id'],
                'clnt_id' => $row['clnt_id'],
                'appl_id' => $row['appl_id'],
                'clnt_name' => $row['clnt_name'],
                'stn_name' => $row['stn_name'],
                'freq' => $row['freq'],
                'freq_pair' => $row['freq_pair'],
                'erp_pwr_dbm' => $row['erp_pwr_dbm'],
                'bwidth' => $row['bwidth'],
                'equip_type' => $row['equip_type'],
                'bhp' => $row['bhp'],
                'eq_mdl' => $row['eq_mdl'],
                'ant_mdl' => $row['ant_mdl'],
                'hgt_ant' => $row['hgt_ant'],
                'master_plzn_cod' => $row['master_plzn_code'],
                'stn_addr' => $row['stn_addr'],
                'sid_long' => $row['sid_long'],
                'sid_lat' => $row['sid_lat'],
                'city' => $row['city'],
                'link_id' => $row['link_id'],
                'stasiun_lawan' => $row['stasiun_lawan'],
                'masa_laku' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['masa_laku']),
                'mon_query' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['mon_query']),
            ]);
        }
    }

    public function rules(): array
    {
        return [
            'license_id_mon_query' => 'required|unique:landmobiles',
        ];
    }

    public function customValidationMessages()
    {
        return [
            'license_id_mon_query.required' => 'license_id_mon_query harus diisi',
        ];
    }

    public function allRowsHaveLicId($file)
    {
        $rows = \Maatwebsite\Excel\Facades\Excel::toCollection(new self(), $file)[0];
        foreach ($rows as $row) {
            if (empty($row['license_id_mon_query'])) {
                return false;
            }
        }
        return true;
    }

}
