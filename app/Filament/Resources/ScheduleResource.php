<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ScheduleResource\Pages;
use App\Filament\Resources\ScheduleResource\RelationManagers;
use App\Models\Doctor;
use App\Models\Schedule;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\Relationship;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Carbon;

class ScheduleResource extends Resource
{
    protected static ?string $model = Schedule::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('doctor_id')
                    ->label('Doctor')
                    ->hidden(fn ()=> Auth::user()->role === 'doctor')
                    ->options(function () {
                        $doctors = Doctor::with('user')->get();
                        return $doctors->pluck('user.name', 'id')->filter(function ($name) {
                            return !is_null($name);
                        })->toArray();
                    })
                    ->required(),
                Forms\Components\Select::make('day')
                    ->options([
                        'sunday' => 'Sunday',
                        'monday' => 'Monday',
                        'tuesday' => 'Tuesday',
                        'wednesday' => 'Wednesday',
                        'thursday' => 'Thursday',
                        'friday' => 'Friday',
                        'saturday' => 'Saturday',
                    ])
                    ->required(),
                Forms\Components\TimePicker::make('start_time')
                    ->required(),
                Forms\Components\TimePicker::make('end_time')
                    ->required(),
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
            if (auth()->user()->role === 'doctor') {
                // Doctor sees only their own appointments
                $query->whereHas('doctor', function (Builder $query) use ($userId) {
                    $query->where('user_id', $userId);
                });
            }
        })
            ->columns([
                Tables\Columns\TextColumn::make('doctor.user.name')
                    ->label('Doctor Name')
                    ->sortable(),
                Tables\Columns\TextColumn::make('day'),
                Tables\Columns\TextColumn::make('start_time')
                ->formatStateUsing(fn ($state) => Carbon::parse($state)->format('g:i A')),
                Tables\Columns\TextColumn::make('end_time')
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
            'index' => Pages\ListSchedules::route('/'),
            'create' => Pages\CreateSchedule::route('/create'),
            'view' => Pages\ViewSchedule::route('/{record}'),
            'edit' => Pages\EditSchedule::route('/{record}/edit'),
        ];
    }
}
