<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        $orders = Order::with('dishes')
                    ->where('restaurant_id', Auth::id())
                    ->get();
        
        // Calcola il conteggio degli ordini per ogni mese
        $orderCountPerMonth = $orders->groupBy(function ($order) {
            return Carbon::parse($order->created_at)->format('m/Y');
        })->map(function ($groupedOrders) {
            return $groupedOrders->count();
        });

        // Ordina il conteggio degli ordini per mese
        $orderCountPerMonth = $orderCountPerMonth->sortKeys();
        
        // Passa i dati al tuo view
        return view('dashboard', compact('orderCountPerMonth'));
    }
}
