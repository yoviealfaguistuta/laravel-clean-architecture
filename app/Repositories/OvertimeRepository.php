<?php

namespace App\Repositories;
use App\Interfaces\OvertimeRepositoryInterface;
use App\Models\Employee;
use App\Models\Overtime;
use App\Models\Setting;
use Carbon\Carbon;

class OvertimeRepository implements OvertimeRepositoryInterface 
{
    public function createOvertime(array $input) 
    {
        // Membuat data waktu lembur
        return Overtime::create([
            'employee_id' => $input['employee_id'],
            'date' => $input['date'],
            'time_started' => $input['time_started'],
            'time_ended' => $input['time_ended'],
        ]);
    }

    public function calculateOvertimePays(array $input) 
    {
        // Menampilkan rekap detail lembur dan biaya yang diberikan
        $setting = Setting::with('Reference')->first();

        // Jika filter bulan tidak di isi maka tampilkan semua
        if (count($input) > 0) {

            // Memisahkan tahun dan bulan dari YYYY-MM
            $substring = explode('-', $input['month'], 2);
            $month = $substring[1];
            $year = $substring[0];
    
            // Menampilkan data pegawai beserta riwayat lembur
            $data = Employee::with(
                ['Overtime'
                    // Filter bulan dan tahun
                    => fn($query) => $query
                    ->whereYear('date', '=', $year)
                    ->whereMonth('date', '=', $month)
                ])
            ->whereHas('Overtime', fn ($query) => 
                // Filter bulan dan tahun
                $query->whereYear('date', '=', $year)->whereMonth('date', '=', $month)
            )
            ->get();

        } else {
            // Menampilkan data pegawai beserta riwayat 
            // lembur tanpa filter bulan dan tahun
            $data = Employee::with('Overtime')->get();
        }

        // Perulangan untuk
        // - Menghitung durasi jam total lembur
        // - Menentukan metode setting apa yang sedang aktif dan rumus yang digunakan
        // - Akumulasi total biaya yang diberikan untuk waktu lembur
        for ($i=0; $i < count($data); $i++) { 
            $overtime_duration_total = 0;

            for ($k=0; $k < count($data[$i]->overtime); $k++) {

                // Mendapatkan waktu lembur dengan mengurangi waktu akhir dengan waktu mulai,
                // Jika waktu tidak kelipatan dari 1 jam maka akan di bulatkan kebawah 
                $time_started = Carbon::parse($data[$i]->overtime[$k]['time_started']);
                $time_ended = Carbon::parse($data[$i]->overtime[$k]['time_ended']);
                $overtime_duration = $time_started->diffInHours($time_ended);
                
                // Alokasi durasi lembur ke collection
                $data[$i]->overtime[$k]['overtime_duration'] = $overtime_duration;

                // Menjumlahkan seluruh total waktu lembur yang pernah dilakukan
                $overtime_duration_total += $overtime_duration;
            }

            // Alokasi seluruh total waktu lembur ke collection
            $data[$i]['overtime_duration_total'] = $overtime_duration_total;

            // Cek setting yang sedang aktif sekarang
            if ($setting->value === 1) {

                // Mereplace dengan rumus yang ada di tabel "expression"
                $replace_expression = str_replace(
                    [
                        'salary', 
                        'overtime_duration_total'
                    ],
                    [
                        $data[$i]['salary'], 
                        $overtime_duration_total
                    ], 
                    $setting->reference->expression
                );
                
                // Eksekusi string menjadi sebuah rumus yang dapat di eksekusi
                // dan mendapatkan jumlah yang harus dibayar
                $amount = eval('return ' . $replace_expression . ';');
            } else {
                // Mereplace dengan rumus yang ada di tabel "expression"
                $replace_expression = str_replace('overtime_duration_total', $overtime_duration_total, $setting->reference->expression);
                
                // Eksekusi string menjadi sebuah rumus yang dapat di eksekusi 
                // dan mendapatkan jumlah yang harus dibayar
                $amount = eval('return ' . $replace_expression . ';');
            }

            // Alokasi jumlah yang harus dibayar ke collection
            $data[$i]['amount'] = $amount;
        }
        return $data;
    }
}