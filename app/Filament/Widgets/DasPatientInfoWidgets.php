<?php
namespace App\Filament\Widgets;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Patients;
use Faker\Provider\ar_EG\Text;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;

class DasPatientInfoWidgets extends BaseWidget
{
    protected function getStats(): array
    {
        
        return [

            
            
            Stat::make('You have', Appointment::where('patient_id', Auth::user()->patient->id)->count())
                ->description('Total Appointments')
                ->chart([0, 30, 60, 65, 70, 75, 80])
                ->color('rand'),
           
        ];
    }
    public static function canView(): bool
    {
        return auth()->user()->role === 'patient';
    }
}