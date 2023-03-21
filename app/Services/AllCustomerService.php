<?php

namespace App\Services;

use App\Models\CustomerModel;

/**
 * Class AllCustomerService
 * @package App\Services
 */
class AllCustomerService
{
    public function getDataFromAllCustomers(): object
    {
        return CustomerModel::recoverCustomers();
    }
}
