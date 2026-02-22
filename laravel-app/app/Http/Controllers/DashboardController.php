<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $boutiqueId = auth()->id();
        
        $stats = [
            'total' => \App\Models\Commande::where('boutique_id', $boutiqueId)->count(),
            'todo' => \App\Models\Commande::where('boutique_id', $boutiqueId)->where('status', 'todo')->count(),
            'in_progress' => \App\Models\Commande::where('boutique_id', $boutiqueId)->where('status', 'in_progress')->count(),
            'completed' => \App\Models\Commande::where('boutique_id', $boutiqueId)->where('status', 'completed')->count(),
            'high_priority' => \App\Models\Commande::where('boutique_id', $boutiqueId)->where('is_high_priority', true)->count(),
            'overdue' => \App\Models\Commande::where('boutique_id', $boutiqueId)->where('status', 'overdue')->count(),
        ];

        return view('dashboard', compact('stats'));
    }
}
