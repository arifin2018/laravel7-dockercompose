<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Resources\OrderResource;

class OrderController extends Controller
{
    public function index()
    {
        Gate::authorize('view', ['orders']);
        $order = Order::with(['orderItems'])->paginate();
        return OrderResource::collection($order);
    }

    public function show($id)
    {
        Gate::authorize('view', ['orders']);
        return new OrderResource(Order::find($id));
    }

    public function exportCSV()
    {
        Gate::authorize('view', ['orders']);
        $fileName = time() . ' - tasks.csv';

        $orders = OrderResource::collection(Order::all());
        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('name', 'email', 'total', 'product title', 'price', 'quantity');

        $callback = function () use ($orders, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($orders as $order) {
                $row['name']  = $order->name;
                $row['email']    = $order->email;
                $row['total']  = $order->total;

                // fputcsv($file, array($row['name'], $row['email'], $row['total'], '', '', ''));

                foreach ($order->orderItems as $orderItem) {
                    $row['product_title']  = $orderItem->product_title;
                    $row['price']    = $orderItem->price;
                    $row['quantity']  = $orderItem->quantity;

                    fputcsv($file, array($row['name'], $row['email'], $row['total'], $row['product_title'], $row['price'], $row['quantity']));
                }
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
