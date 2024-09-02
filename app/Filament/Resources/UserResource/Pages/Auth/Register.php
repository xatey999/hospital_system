<?php

namespace App\Filament\Resources\UserResource\Pages\Auth;

use App\Models\Department;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Patients;
use App\Models\User;
use Filament\Forms\Components\Component;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
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
                        // Conditionally display fields for 'Patient' role
                        $this->getDateOfBirthFormComponent(),
                        $this->getGenderFormComponent(),
                        $this->getAddressFormComponent(),
                        // Conditionally display fields for 'Doctor' role
                        $this->getDoctorDescriptionFormComponent(),
                        $this->getDoctorPhoneFormComponent(),
                        $this->getDepartmentIdFormComponent(),
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
            ->required()
            ->reactive()
            ->afterStateUpdated(fn ($state, callable $set) => $this->updateFormFields($state, $set));
    }

    // Patient-specific fields
    protected function getDateOfBirthFormComponent(): Component
    {
        return DatePicker::make('date_of_birth')
            ->label('Date of Birth')
            ->required()
            ->native(false)
            ->hidden(fn (callable $get) => $get('role') !== 'patient');
    }

    protected function getGenderFormComponent(): Component
    {
        return Select::make('gender')
            ->options([
                'male' => 'Male',
                'female' => 'Female'
            ])
            ->required()
            ->hidden(fn (callable $get) => $get('role') !== 'patient');
    }

    protected function getAddressFormComponent(): Component
    {
        return TextInput::make('address')
            ->label('Address')
            ->required()
            ->hidden(fn (callable $get) => $get('role') !== 'patient');
    }

    // Doctor-specific fields
    protected function getDoctorDescriptionFormComponent(): Component
    {
        return RichEditor::make('doctor_description')
            ->label('Doctor Description')
            ->required()
            ->hidden(fn (callable $get) => $get('role') !== 'doctor');
    }

    protected function getDoctorPhoneFormComponent(): Component
    {
        return TextInput::make('doctor_phone')
            ->label('Doctor Phone')
            ->required()
            ->hidden(fn (callable $get) => $get('role') !== 'doctor');
    }

    protected function getDepartmentIdFormComponent(): Component
    {
        return Select::make('department_id')
            ->label('Department')
            ->options(Department::pluck('name', 'id')->toArray())
            ->required()
            ->hidden(fn (callable $get) => $get('role') !== 'doctor');
    }

    protected function beforeRegister(): void
    {
        // Prepare the data before saving the user
        $data = $this->form->getState();

        // Temporarily store the role-specific data in session
        session()->put('role_specific_data', [
            'role' => $data['role'],
            'date_of_birth' => $data['date_of_birth'] ?? null,
            'gender' => $data['gender'] ?? null,
            'address' => $data['address'] ?? null,
            'doctor_description' => $data['doctor_description'] ?? null,
            'doctor_phone' => $data['doctor_phone'] ?? null,
            'department_id' => $data['department_id'] ?? null,
        ]);

        // Remove role-specific fields from the main user data to avoid errors during registration
        $this->form->fill([
            'date_of_birth' => null,
            'gender' => null,
            'address' => null,
            'doctor_description' => null,
            'doctor_phone' => null,
            'department_id' => null,
        ]);
    }

    protected function afterRegister(): void
    {
        $user = User::latest()->first();
        $roleSpecificData = session()->get('role_specific_data');

        // Save the additional data based on the role
        if ($roleSpecificData['role'] === 'patient') {

            Patients::create([
                'user_id' => $user->id,
                'date_of_birth' => $roleSpecificData['date_of_birth'],
                'gender' => $roleSpecificData['gender'],
                'address' => $roleSpecificData['address'],
            ]);
        } elseif ($roleSpecificData['role'] === 'doctor') {
            Doctor::create([
                'user_id' => $user->id,
                'doctor_description' => $roleSpecificData['doctor_description'],
                'doctor_phone' => $roleSpecificData['doctor_phone'],
                'department_id' => $roleSpecificData['department_id'],
            ]);
        }

        // Clear the session data after usage
        session()->forget('role_specific_data');
    }

    protected function updateFormFields($role, callable $set)
    {
        // You can add any additional logic here if needed when the role changes
    }
}
