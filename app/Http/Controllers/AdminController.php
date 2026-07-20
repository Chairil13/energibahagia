<?php

namespace App\Http\Controllers;

use App\Models\Donasi;

class AdminController extends Controller
{
    public function getNotifications()
    {
        $notifications = Donasi::where('status', 'pending')
            ->whereNotNull('bukti_transfer')
            ->orderBy('updated_at', 'desc')
            ->take(5)
            ->get()
            ->map(function ($item) {
                return [
                    'id' => 'donasi_bukti_'.$item->id.'_'.$item->updated_at->timestamp,
                    'type' => 'donasi',
                    'title' => 'Donasi Perlu Dikonfirmasi',
                    'message' => $item->nama.' sudah upload bukti transfer Rp '.number_format($item->nominal, 0, ',', '.'),
                    'time' => $item->updated_at->diffForHumans(),
                    'link' => route('admin.donasi.index'),
                ];
            });

        return response()->json($notifications);
    }
}
