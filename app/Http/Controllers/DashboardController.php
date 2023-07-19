<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Product;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderStatus;

class DashboardController extends Controller
{
    public function index()
    {
        $time = Carbon::now()->subMonths(2);
        $time->day = 1;

        
        $sales = Order::where('created_at', '>=', $time)->selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, SUM(grand_total) as SALES')->groupBy('month')->orderBy('month')->get();
        
        
        $labels = $sales->pluck('month');
        
        $chartData = [
            'sales' => [],
            'labels' => []
        ];
        
        for ($i=0; $i < 3; $i++) { 
            $t = $time->year.'-'.$time->month;
            if (in_array($t, $labels)) {
                $chartData['sales'][] = 'Rp ' . number_format($sales->get($labels->search($t)), 0, ',', '.');
            } else {
                $chartData['sales'][] = 'Rp ' . number_format(0, 0, ',', '.');
            }
            $chartData['labels'][] = $t;
            $time->addMonth(1);
        }

        return view('admin.dashboard', [
            'productCount' => Product::count(),
            'orderCount' => Order::count(),
            'customerCount' => User::where('role', 'user')->count(),
            'income' => Order::where('status', OrderStatus::FINISHED)->select('grand_total')->sum('grand_total'),
            'salesData' => json_encode([
                'labels' => $chartData['labels'],
                'datasets' => [[
                    'label' => 'Sales',
                    'data' => $chartData['sales'],
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
