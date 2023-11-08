<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    //
    public function ReportView()
    {
        return view('backend.report.report_view');
    }

    public function SearchByDate(Request $request)
    {
        // Get date on search input
        $date = new DateTime($request->date);
        $format_date = $date->format('d F Y');

        $orders = Order::where('order_date', $format_date)->latest()->get();

        return view('backend.report.report_by_date', compact('orders', 'format_date'));
    }

    public function SearchByMonth(Request $request)
    {
        // Get month select
        $month = $request->month;
        $month_year = $request->month_year;

        $orders = Order::where('order_month', $month)->where('order_year', $month_year)->latest()->get();

        return view('backend.report.report_by_month', compact('orders', 'month', 'month_year'));
    }

    public function SearchByYear(Request $request)
    {
        // Get year select
        $year = $request->year;

        $orders = Order::where('order_year', $year)->latest()->get();

        return view('backend.report.report_by_year', compact('orders', 'year'));
    }

    public function ReportOrderByUser(Request $request)
    {
        $users = User::where('role', 'user')->latest()->get();

        return view('backend.report.report_oder_by_user', compact('users'));
    }

    public function SearchByUser(Request $request)
    {
        $user_id = $request->user;

        $user_name = User::where('id', $user_id)->first();

        $orders = Order::where('user_id', $user_id)->latest()->get();

        return view('backend.report.report_oder_by_user_show', compact('orders', 'user_name'));
    }
}
