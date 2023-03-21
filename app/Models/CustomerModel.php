<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerModel extends Model
{
    use HasFactory;

    protected $table = 'customers';
    protected $fillable = [
        'name',
        'email',
        'phone'
    ];

    static function createCustomer(string $name, string $email, string $phone): object
    {
        $customer = CustomerModel::create([
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
        ]);

        return $customer;
    }

    static function updateCustomer(int $id, string $name, string $email, string $phone): object
    {
        $customer = CustomerModel::find($id);

        if ($customer === null)
            throw new Exception("O cliente não existe em nosso sistema.", 400);

        $customer->update([
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
        ]);

        return $customer;
    }

    static function deleteCustomer(int $id): bool
    {
        $customer = CustomerModel::find($id);

        if ($customer === null)
            throw new Exception("O cliente não existe em nosso sistema.", 404);

        return $customer->delete();
    }

    static function recoverCustomer(int $id): object
    {
        $customer = CustomerModel::select('id', 'name', 'email', 'phone')->find($id);

        if ($customer === null)
            throw new Exception("O cliente não existe em nosso sistema.", 404);

        return $customer;
    }

    static function recoverCustomers(): object
    {
        $customer = CustomerModel::select('id', 'name', 'email', 'phone')->get();

        if ($customer === null)
            throw new Exception("O cliente não existe em nosso sistema.", 404);

        return $customer;
    }
}
