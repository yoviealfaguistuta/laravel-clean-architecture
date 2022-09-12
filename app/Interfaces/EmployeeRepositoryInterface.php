<?php

namespace App\Interfaces;

interface EmployeeRepositoryInterface 
{
    public function createEmployee(array $input);
}