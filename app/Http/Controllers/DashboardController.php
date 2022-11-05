<?php

namespace App\Http\Controllers;

use App\Http\Resources\DashboardResource;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class DashboardController extends Controller
{
    public function Chart()
    {
        Gate::authorize('view', ['orders']);
        $orders = Order::query()
            ->join('order_items', 'orders.id', '=', 'order_items.order_id')
            ->selectRaw("DATE_FORMAT(orders.created_at, '%Y-%m-%d') as Date, sum(order_items.quantity*order_items.price) as Sum")
            ->groupBy('Date')
            // ->selectRaw("CONCAT(orders.first_name,' ',orders.last_name) as Name,DATE_FORMAT(orders.created_at, '%d-%M-%Y') as Date, sum(order_items.quantity*order_items.price) as Total")
            // ->groupBy('Date', "Name")
            ->get();
        return DashboardResource::collection($orders);
    }
}
