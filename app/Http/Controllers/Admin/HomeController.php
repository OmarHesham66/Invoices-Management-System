<?php

namespace App\Http\Controllers\Admin;

use App\Models\Invoice;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $base = Invoice::get();
        $count_all_invoices = $base->count();
        $count_invoices_paid = $base->where('status', 'Paid')->count();;
        $count_invoices_un_paid = $base->where('status', 'Unpaid')->count();;
        $count_invoices_p_paid = $base->where('status', 'Partially paid')->count();;

        $chartjsBar = app()->chartjs
            ->name('barChartTest')
            ->type('bar')
            ->size(['width' => 400, 'height' => 200])
            ->labels(['Total Invoices', 'Total Invoices Paid', 'Total Invoices Partial Paid', 'Total Invoices Un-Paid'])
            ->datasets([
                [
                    "label" => 'Total Invoices',
                    'backgroundColor' => ['rgba(54, 162, 235, 0.3)', '#029666', ' #efa65f', '#f93a5a'],
                    'data' => [
                        100,
                        round(($count_invoices_paid / $count_all_invoices) * 100, 1),
                        round(($count_invoices_un_paid / $count_all_invoices) * 100, 1),
                        round(($count_invoices_p_paid / $count_all_invoices) * 100, 1),
                    ]
                ],
            ]);
        $chartjsPie = app()->chartjs
            ->name('pieChartTest')
            ->type('pie')
            ->size(['width' => 400, 'height' => 200])
            ->labels(['Total Invoices Paid', 'Total Invoices Partial Paid', 'Total Invoices Un-Paid'])
            ->datasets([
                [
                    "label" => "Precentge Of Total Invoices",
                    'backgroundColor' => ['#029666', ' #efa65f', '#f93a5a'],
                    'data' => [
                        // 100,
                        round(($count_invoices_paid / $count_all_invoices) * 100, 1),
                        round(($count_invoices_un_paid / $count_all_invoices) * 100, 1),
                        round(($count_invoices_p_paid / $count_all_invoices) * 100, 1),
                    ]
                ],
            ]);
        return view(
            'Site.index',
            compact(
                'count_all_invoices',
                'count_invoices_paid',
                'count_invoices_un_paid',
                'count_invoices_p_paid',
                'chartjsBar',
                'chartjsPie',
            )
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
