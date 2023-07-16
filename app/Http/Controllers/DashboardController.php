<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Product;
use App\Models\User;
use App\Models\Order;

class DashboardController extends Controller
{
    public function index()
    {
        $threeMonthsAgo = Carbon::now()->subMonths(3);

        $sales = Order::where('created_at', '>=', $threeMonthsAgo)->selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, SUM(grand_total) as SALES')->groupBy('month')->orderBy('month')->get();

        return view('admin.dashboard', [
            'productCount' => Product::count(),
            'orderCount' => Order::count(),
            'customerCount' => User::where('role', 'user')->count(),
            'income' => Order::where('status', 'success')->select('grand_total')->sum('grand_total'),
            'salesData' => json_encode([
                'labels' => $sales->pluck('month'),
                'datasets' => [[
                    'label' => 'Sales',
                    'data' => $sales->pluck('sales')->map(function($item) {
                        return 'Rp ' . number_format($item, 0, ',', '.');
                    }),
                    'backgroundColor' => 'rgba(0, 123, 255, 0.5)',
                    'borderColor' => 'rgba(0, 123, 255, 1)',
                    'borderWidth' => 2,
                    'tension' => 0.4,
                    'fill' => true
                ]],
            ]),
        ]);
    }
}
