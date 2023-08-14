<?php

namespace App\Http\Requests\Payment;

use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;

class StripeRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $userId = null;

        if (!auth('sanctum')?->user()?->hasRole('admin')) {
            $userId = auth('sanctum')->id();
        }

        return [
            'order_id'  => [
                empty(request('parcel_id')) ? 'required' : 'nullable',
                Rule::exists('orders', 'id')
                    ->whereNull('deleted_at')
                    ->when(!empty($userId), fn($q) => $q->where('user_id', $userId))
            ],
            'parcel_id'  => [
                empty(request('order_id')) ? 'required' : 'nullable',
                Rule::exists('parcel_orders', 'id')
                    ->whereNull('deleted_at')
                    ->when(!empty($userId), fn($q) => $q->where('user_id', $userId))
            ],
        ];
    }

}
