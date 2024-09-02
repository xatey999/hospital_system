<?php
namespace App\Filament\Widgets;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Patients;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;

class DasDoctorInfoWidgets extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            
            Stat::make('Appointments', Appointment::where('doctor_id', Auth::user()->doctor->id)->count())
                ->description('Total Appointments')
                ->chart([0, 30, 60, 65, 70, 75, 80])
                ->color('rand'),
           
        ];
    }
    public static function canView(): bool
    {
        return auth()->user()->role === 'doctor';
    }
}