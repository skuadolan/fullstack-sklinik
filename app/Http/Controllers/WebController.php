<?php

namespace App\Http\Controllers;

class WebController extends Controller
{
    public function WelcomeGet()
    {
        return self::inertiaView('Welcome');
    }

    public function DashboardGet()
    {
        return self::inertiaView('Dashboard');
    }

    public function DemoGet()
    {
        return self::inertiaView('Demo');
    }

    public function PatientsGet()
    {
        return self::inertiaView('Patients');
    }

    public function BillingGet()
    {
        return self::inertiaView('Billing');
    }

    public function InventoryGet()
    {
        return self::inertiaView('Inventory');
    }
}
