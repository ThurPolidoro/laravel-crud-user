<?php

namespace App\Services;

use App\Models\CustomerModel;

/**
 * Class DeleteCustomerService
 * @package App\Services
 */
class DeleteCustomerService
{
    public function __construct(
        private int $id
    ) {
    }

    public function deleteCustomer(): bool
    {
        return CustomerModel::deleteCustomer($this->id);
    }
}
