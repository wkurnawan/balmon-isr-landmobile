<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLandmobileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'license_id' => 'required|string|max:191',
            'appl_id' => 'required|max:191',
            'clnt_name' => 'nullable|string|max:191',
            'stn_name' => 'required|string|max:191',
            'freq' => 'required|max:191',
            'equip_type' => 'nullable|max:191',
            'eq_mdl' => 'required|string|max:191',
            'stn_addr' => 'required|string|max:191',
            'city' => 'required|string|max:191',
            'masa_laku' => 'required|max:191',
        ];
    }
}
