<?php

namespace App\Services;

use App\Models\CustomerModel;
use Exception;
use Illuminate\Support\Facades\Validator;

/**
 * Class UpdateCustomerService
 * @package App\Services
 */
class UpdateCustomerService
{
    private int $id;
    private string $name;
    private string $email;
    private string $phone;
    private string $phoneFormatted;

    public function __construct(int $id, array $fields)
    {
        $this->id = $id;
        $this->name = $fields['name'];
        $this->email = $fields['email'];
        $this->phone = $fields['phone'];
    }

    public function updateCustomerData(): object
    {
        $this->preparePhoneToValidate();
        $this->validateInfos();

        return $this->save();
    }

    private function preparePhoneToValidate(): void
    {
        $this->phoneFormatted = str_replace(' ', '', $this->phone);
    }

    private function validateInfos(): void
    {
        $rules = [
            'name' => 'required|string|min:3',
            'email' => 'required|email',
            'phone' => 'required|celular_com_codigo',
        ];

        $validator = Validator::make([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phoneFormatted,
        ], $rules);


        if ($validator->fails()) {
            if ($validator->fails('name')) {
                throw new Exception('Nome do customere informado não é válido.');
            } elseif ($validator->fails('email')) {
                throw new Exception('O email informado não é válido');
            } else {
                throw new Exception('O número de celular informado não é válido.');
            }
        }
    }

    private function save(): object
    {
        return CustomerModel::updateCustomer($this->id, $this->name, $this->email, $this->phone);
    }
}
