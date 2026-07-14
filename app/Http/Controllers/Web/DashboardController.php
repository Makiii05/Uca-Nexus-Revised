<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $type = auth()->user()->type;

        $view = match ($type) {
            'admin' => 'portals.admin.dashboard',
            'registrar' => 'portals.registrar.dashboard',
            'accounting' => 'portals.accounting.dashboard',
            'admission' => 'portals.admission.dashboard',
            default => abort(403, 'Unauthorized portal access.'),
        };

        return view($view);
    }
}
