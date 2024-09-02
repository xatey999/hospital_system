<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AppointmentResource\Pages;
use App\Filament\Resources\AppointmentResource\RelationManagers;
use App\Models\Appointment;
use App\Models\Department;
use App\Models\Doctor;
use App\Models\Patients;
use App\Models\Schedule;
use Faker\Core\Color;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Carbon;

class AppointmentResource extends Resource
{
    protected static ?string $model = Appointment::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-check';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('patient_id')
                    ->label('Patient Name')
                    ->hidden(function () {
                        return Auth::user()->role === 'patient';
                    })
                    ->disabledOn('edit')
                    ->options(function () {
                        $patient = Patients::with(['user'])->get();
                        return $patient->pluck('user.name', 'id')->filter(function ($name) {
                            return !is_null($name);
                        })->toArray();
                    })
                    ->required(),

                Forms\Components\Select::make('department_id')
                    ->label('Select Department')
                    ->hiddenOn(['edit', 'view'])
                    ->options(function () {
                        $departments = Department::with('doctors')->get();
                        return $departments->pluck('name', 'id')->filter(function ($name) {
                            return !is_null($name);
                        })->toArray();
                    })
                    ->live()
                    ->required(),

                Forms\Components\Select::make('doctor_id')
                    ->label('Select Doctor')
                    ->hidden(function () {
                        return Auth::user()->role === 'patient';
                    })
                    ->hiddenOn(['view', 'edit'])
                    ->options(function (Forms\Get $get) {
                        $doctors = Doctor::with('user')->get();
                        return $doctors->where('department_id', $get('department_id'))->pluck('user.name', 'id')->toArray();
                    })
                    ->disabled(fn(Forms\Get $get): bool => !filled($get('department_id')))
                    ->live()
                    ->required(),

                Forms\Components\DatePicker::make('appointment_date')
                    ->hiddenOn(['edit'])
                    ->reactive()
                    ->required(),

                Forms\Components\Select::make('schedule_id')
                    ->label('Available Time Slots')
                    ->options(function (Forms\Get $get) {
                        $doctor_id = $get('doctor_id');
                        $appointment_date = $get('appointment_date');

                        if ($doctor_id && $appointment_date) {
                            $day = Carbon::parse($appointment_date)->format('l');

                            $schedules = Schedule::where('doctor_id', $doctor_id)
                                ->where('day', $day)
                                ->get();

                            return $schedules->mapWithKeys(function ($schedule) {
                                return [$schedule->id => $schedule->start_time . ' - ' . $schedule->end_time];
                            })->toArray();
                        }

                        return [];
                    })
                    ->hiddenOn(['edit', 'view'])
                    ->disabled(fn(Forms\Get $get): bool => !filled($get('doctor_id')) || !filled($get('appointment_date')))
                    ->reactive()
                    ->afterStateUpdated(function (callable $set, $state) {
                        if ($state) {
                            $schedule = Schedule::find($state);
                            if ($schedule) {
                                $set('appointment_time', $schedule->start_time);
                            }
                        }
                    })
                    ->required(),

                Forms\Components\Select::make('appointment_time')
                    ->label('Appointment Time')
                    ->hidden()
                    ->required(),

                Forms\Components\RichEditor::make('appointment_reason')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        $userId = Auth::user()->id;

        return $table
            ->modifyQueryUsing(function (Builder $query) use ($userId) {
                if (auth()->user()->role === 'admin') {
                    return;
                }
                if (auth()->user()->role === 'patient') {
                    // Patient sees only their own appointments
                    $query->whereHas('patient', function (Builder $query) use ($userId) {
                        $query->where('user_id', $userId);
                    });
                }
                if (auth()->user()->role === 'doctor') {
                    // Doctor sees only their own appointments
                    $query->whereHas('doctor', function (Builder $query) use ($userId) {
                        $query->where('user_id', $userId);
                    });
                }
            })
            ->columns([
                Tables\Columns\TextColumn::make('patient.user.name')
                    ->label('Patient Name')
                    ->numeric()
                    ->hidden(fn ()=> Auth::user()->role === 'patient')
                    ->sortable(),
                Tables\Columns\TextColumn::make('doctor.user.name')
                    ->label('Doctor Name')
                    ->numeric()
                    ->sortable()
                    ->visible(fn() => Auth::user()->role === 'admin' || Auth::user()->role === 'patient'),
                Tables\Columns\TextColumn::make('doctor.department.name')
                    ->label('Department')
                    ->numeric()
                    ->sortable()
                    ->visible(fn() => Auth::user()->role === 'admin' || Auth::user()->role === 'patient'),
                Tables\Columns\TextColumn::make('appointment_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('appointment_time')
                    ->formatStateUsing(fn($state) => Carbon::parse($state)->format('g:i A')),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('Reshedule')
                    ->visible(fn($record) => auth()->user()->role === 'doctor')
                    ->form(function ($record) {
                        return [
                            DatePicker::make('date')
                                ->default($record->appointment_date)
                                ->native(false)
                        ];
                    })
                    ->action(function ($record, $data) {
                        $record->appointment_date = $data['date'];
                        $record->save();
                    })
                    ->icon('heroicon-m-clock')
                    ->color('info')
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAppointments::route('/'),
            'create' => Pages\CreateAppointment::route('/create'),
            'view' => Pages\ViewAppointment::route('/{record}'),
            'edit' => Pages\EditAppointment::route('/{record}/edit'),
        ];
    }
}
