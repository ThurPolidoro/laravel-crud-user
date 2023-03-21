<?php

namespace App\Services;

use App\Models\CustomerModel;
use Exception;
use Illuminate\Support\Facades\Validator;

/**
 * Class CreateCustomerService
 * @package App\Services
 */
class CreateCustomerService
{
    private string $name;
    private string $email;
    private string $phone;
    private string $phoneFormatted;

    public function __construct(array $fields)
    {
        $this->name = $fields['name'];
        $this->email = $fields['email'];
        $this->phone = $fields['phone'];
    }

    public function createCustomer(): object
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
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|telefone_com_codigo',
        ];

        $validator = Validator::make([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phoneFormatted,
        ], $rules);


        if ($validator->fails()) {
            $errors = $validator->errors();

            if ($errors->has('name')) {
                throw new Exception('Nome do cliente informado não é válido. ');
            } elseif ($errors->has('email')) {
                throw new Exception('O email informado não é válido');
            } elseif ($errors->has('phone')) {
                throw new Exception('O número de celular informado não é válido.');
            }
        }
    }

    private function save(): object
    {
        return CustomerModel::createCustomer($this->name, $this->email, $this->phone);
    }
}
