<?php

namespace App\Http\Controllers;

use App\Models\Milestone;

class JourneyController extends Controller
{
    /**
     * 受講生の「学びの軌跡」を表示する。
     */
    public function index()
    {
        $milestones = Milestone::orderBy('phase_order')
            ->orderBy('position')
            ->get();

        // フェーズ単位にグルーピング
        $phases = $milestones
            ->groupBy('phase')
            ->map(function ($items) {
                $first = $items->first();

                return [
                    'name' => $first->phase,
                    'icon' => $first->phase_icon,
                    'order' => $first->phase_order,
                    'items' => $items,
                ];
            })
            ->sortBy('order')
            ->values();

        $total = $milestones->count();
        $completed = $milestones->where('completed', true)->count();
        $percent = $total > 0 ? (int) round($completed / $total * 100) : 0;

        return view('journey', [
            'phases' => $phases,
            'total' => $total,
            'completed' => $completed,
            'percent' => $percent,
        ]);
    }
}
