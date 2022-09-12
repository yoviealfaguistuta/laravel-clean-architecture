<?php

namespace App\Repositories;

use App\Interfaces\EmployeeRepositoryInterface;
use App\Models\Employee;

class EmployeeRepository implements EmployeeRepositoryInterface 
{
    public function createEmployee(array $input) 
    {
        // Membuat data pegawai
        return Employee::create([
            'name' => $input['name'],
            'salary' => $input['salary'],
        ]);
    }
}