@extends('layouts.app', ['title' => 'Edit Landmobile'])

@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12">
                <div class="bg-light rounded h-100 p-4">
                    <h6 class="mb-4">Isi Data Landmobile</h6>
                    <form action="{{ route('landmobiles.update', $landmobile->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="license_id" class="form-label">LICENSE_ID</label>
                            <input type="text" name="license_id" class="form-control" id="license_id"
                                value="{{ $landmobile->license_id }}">
                        </div>
                        <div class="mb-3">
                            <label for="appl_id" class="form-label">APPL_ID</label>
                            <input type="number" name="appl_id" class="form-control" id="appl_id"
                                value="{{ $landmobile->appl_id }}">
                        </div>
                        <div class="mb-3">
                            <label for="clnt_name" class="form-label">CLNT_NAME</label>
                            <input type="text" name="clnt_name" class="form-control" id="clnt_name"
                                value="{{ $landmobile->clnt_name }}">
                        </div>
                        <div class="mb-3">
                            <label for="stn_name" class="form-label">STN_NAME</label>
                            <input type="text" name="stn_name" class="form-control" id="stn_name"
                                value="{{ $landmobile->stn_name }}">
                        </div>
                        <div class="mb-3">
                            <label for="freq" class="form-label">FREQ</label>
                            <input type="number" name="freq" class="form-control" id="freq"
                                value="{{ $landmobile->freq }}">
                        </div>
                        <div class="mb-3">
                            <label for="equip_type" class="form-label">EQUIP_TYPE</label>
                            <input type="text" name="equip_type" class="form-control" id="equip_type"
                                value="{{ $landmobile->equip_type }}">
                        </div>
                        <div class="mb-3">
                            <label for="eq_mdl" class="form-label">EQ_MDL</label>
                            <input type="text" name="eq_mdl" class="form-control" id="eq_mdl"
                                value="{{ $landmobile->eq_mdl }}">
                        </div>
                        <div class="mb-3">
                            <label for="stn_addr" class="form-label">STN_ADDR</label>
                            <input type="text" name="stn_addr" class="form-control" id="stn_addr"
                                value="{{ $landmobile->stn_addr }}">
                        </div>
                        <div class="mb-3">
                            <label for="city" class="form-label">CITY</label>
                            <input type="text" name="city" class="form-control" id="city"
                                value="{{ $landmobile->city }}">
                        </div>
                        <div class="mb-3">
                            <label for="masa_laku" class="form-label">MASA_LAKU</label>
                            <input type="date" name="masa_laku" class="form-control" id="masa_laku"
                                value="{{ $landmobile->masa_laku }}">
                        </div>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save me-2"></i>Simpan</button>
                        <button type="reset" class="btn btn-outline-primary m-2"><i
                                class="fa fa-eraser me-2"></i>Reset</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
