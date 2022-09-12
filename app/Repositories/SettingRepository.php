<?php

namespace App\Repositories;

use App\Interfaces\SettingRepositoryInterface;
use App\Models\Setting;

class SettingRepository implements SettingRepositoryInterface 
{
    public function updateSetting(array $input) 
    {
        // Mengubah pengaturan metode yang digunakan
        $data = Setting::where('key', $input['key'])->update([
            'value' => $input['value'],
        ]);
        return $data;
    }
}