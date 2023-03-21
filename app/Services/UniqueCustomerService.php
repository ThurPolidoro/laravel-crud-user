<?php

namespace App\Services;

use App\Models\CustomerModel;

/**
 * Class UniqueCustomerService
 * @package App\Services
 */
class UniqueCustomerService
{

    public function __construct(
        private int $id
    ) {
    }

    public function getDataFromASingleCustomer(): object
    {
        return CustomerModel::recoverCustomer($this->id);
    }
}
