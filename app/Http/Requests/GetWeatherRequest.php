<?php

namespace App\Http\Requests;

use App\Weather\Contracts\LocationDateTimeInput;
use DateTime;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class GetWeatherRequest extends FormRequest implements LocationDateTimeInput
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'latitude'  => ['required', 'regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'],
            'longitude' => ['required', 'regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/'],
            'date'      => [
                'required',
                'date_format:"Y-m-d"',
                'before:' . (now()->addDays(8)->toDateString()),
                'after:' . (now()->subDays(31)->toDateString()),
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getLatitude(): float
    {
        return $this->input('latitude');
    }

    /**
     * {@inheritdoc}
     */
    public function getLongitude(): float
    {
        return $this->input('longitude');
    }

    /**
     * {@inheritdoc}
     */
    public function getDateTime(): DateTime
    {
        return date_create_from_format('Y-m-d', $this->input('date'));
    }

    /**
     * {@inheritdoc}
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
