<?php

namespace App\Filament\Resources\UserResource\Pages\Auth;

use App\Filament\Resources\UserResource;
use Faker\Provider\Base;
use Filament\Resources\Pages\Page;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Component;
use Filament\Pages\Auth\Register as BaseRegister;

class Register extends BaseRegister
{

    protected function getForms(): array
    {
        return [
            'form' => $this->form(
                $this->makeForm()
                    ->schema([
                        $this->getNameFormComponent(),
                        $this->getEmailFormComponent(),
                        $this->getRoleFormComponent(),
                        $this->getPasswordFormComponent(),
                        $this->getPasswordConfirmationFormComponent(),
                    ])
                    ->statePath('data'),
            ),
        ];
    }

    protected function getRoleFormComponent(): Component
    {
        return Select::make('role')
            ->options([
                'doctor' => 'Doctor',
                'patient' => 'Patient',
            ])
            ->default('patient')
            ->required();
    }
}
