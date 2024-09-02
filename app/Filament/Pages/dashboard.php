<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BasePage;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Facades\Auth;

class Dashboard extends BasePage
{
    protected static ?string $slug = 'dashboard';
    protected static string $routePath = '/';

    public function getTitle(): string
    {
        $userRole = Auth::user()->role;
        return $userRole === 'doctor' ? 'Doctor Dashboard' : ($userRole === 'patient' ? 'Patient Dashboard' : 'Admin Dashboard');
    }

    public function getSubheading(): HtmlString
    {
        $user = auth()->user();

        $welcomeMessage = '<div class="text-gray-800 text-lg font-semibold mt-5">
        Welcome, ' . htmlspecialchars($user->name) . '!
    </div>';

        return new HtmlString($welcomeMessage);
    }
}