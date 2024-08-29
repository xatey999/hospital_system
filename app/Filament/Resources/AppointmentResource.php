<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AppointmentResource\Pages;
use App\Filament\Resources\AppointmentResource\RelationManagers;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Patients;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
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
                ->hidden(function (){ 
                    // if (Auth::user()->role === 'admin'){
                    //     return false;
                    // } 
                    // if (Auth::user()->role === 'doctor'){
                    //     return false;
                    // }
                    if (Auth::user()->role === 'patient')
                    return true;
                })
                // ->hiddenOn(['view','edit'])  
                ->options(function () {
                    $patient = Patients::with('user')->get();
                    return $patient->pluck('user.name', 'id')->filter(function ($name) {
                        return !is_null($name);
                    })->toArray();
                })
                    ->required(),
                Forms\Components\Select::make('doctor_id')
                ->label('Select Doctor')
                ->hidden(function (){
                    return Auth::user()->role === 'patient';
                })
                ->hiddenOn(['view','edit'])
                ->options(function () {
                    $doctor = Doctor::with('user')->get();
                    return $doctor->pluck('user.name', 'id')->filter(function ($name) {
                        return !is_null($name);
                    })->toArray();
                })
                    ->required(),
                Forms\Components\DatePicker::make('appointment_date')
                    ->required(),
                Forms\Components\TimePicker::make('appointment_time')
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
                    ->sortable(),
                Tables\Columns\TextColumn::make('doctor.user.name')
                    ->label('Doctor Name')
                    ->numeric()
                    ->sortable(),
                    Tables\Columns\TextColumn::make('doctor.department.name')
                    ->label('Department')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('appointment_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('appointment_time')
                ->formatStateUsing(fn ($state) => Carbon::parse($state)->format('g:i A')),
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
