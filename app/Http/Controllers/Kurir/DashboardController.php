<?php
namespace App\Http\Controllers\Kurir;
use App\Http\Controllers\Controller;
use App\Models\Delivery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $kurirId = Auth::id();
        // Ambil tugas yang di-assign ke kurir ini DAN statusnya masih 'Diantar'
        $tugas_deliveries = Delivery::where('kurir_id', $kurirId)
                                    ->where('status', 'Diantar')
                                    ->with('order.user') // Muat relasi
                                    ->get();
                                    
        return view('kurir.dashboard.index', compact('tugas_deliveries'));
    }
}