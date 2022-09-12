<?php

namespace App\Interfaces;

interface OvertimeRepositoryInterface 
{
    public function createOvertime(array $input);
    public function calculateOvertimePays(array $input);
}