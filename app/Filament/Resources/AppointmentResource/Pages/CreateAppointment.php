<?php

namespace App\Filament\Resources\AppointmentResource\Pages;

use App\Filament\Resources\AppointmentResource;
use App\Models\Schedule;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateAppointment extends CreateRecord
{
    protected static string $resource = AppointmentResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        
        if (empty($data['patient_id'])) {
            $data['patient_id'] = auth()->user()->patient->id;
        }
        $schedule = Schedule::find($data['doctor_id']);
        if ($schedule) {
            $data['appointment_time'] = $schedule->start_time;
        }
        return $data;
    }
}
