<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Landmobile extends Model
{
    use HasFactory;
    protected $fillable =
    [
        'license_id_mon_query',
        'license_id',
        'clnt_id',
        'appl_id',
        'clnt_name',
        'stn_name',
        'freq',
        'freq_pair',
        'erp_pwr_dbm',
        'bwidth',
        'equip_type',
        'bhp',
        'eq_mdl',
        'ant_mdl',
        'hgt_ant',
        'master_plzn_cod',
        'stn_addr',
        'sid_long',
        'sid_lat',
        'city',
        'link_id',
        'stasiun_lawan',
        'masa_laku',
        'mon_query',
    ];
}
