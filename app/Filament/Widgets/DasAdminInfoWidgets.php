<?php
namespace App\Filament\Widgets;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Patients;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
class DasAdminInfoWidgets extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            
            Stat::make('Doctor', Doctor::count())
                ->description('Total Doctor')
                ->chart([0, 30, 60, 65, 70, 75, 80])
                ->color('rand'),

            Stat::make('Patient', Patients::count())
                ->description('Total Patients')
                ->chart([0, 30, 60, 65, 70, 75, 80])
                ->color('red'),

                Stat::make('Appointment', Appointment::count())
                ->description('Total Appointments')
                ->chart([0, 30, 60, 65, 70, 75, 80])
                ->color('red'),
           
        ];
    }
    public static function canView(): bool
    {
        return auth()->user()->role === 'admin';
    }
}