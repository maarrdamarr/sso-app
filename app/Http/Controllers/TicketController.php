<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class TicketController extends Controller
{
    // form bikin tiket (user)
    public function create()
    {
        return view('tickets.create');
    }

    // simpan tiket (user)
    public function store(Request $request)
    {
        $data = $request->validate([
            'subject' => 'required|string|max:200',
            'description' => 'nullable|string',
            'priority' => 'nullable|in:low,medium,high',
        ]);

        Ticket::create([
            'user_id'    => Auth::id(),
            'subject'    => $data['subject'],
            'description'=> $data['description'] ?? null,
            'priority'   => $data['priority'] ?? 'medium',
            'status'     => 'open',
        ]);

        return redirect()->route('tickets.my')->with('success', 'Tiket berhasil dibuat.');
    }

    // user lihat tiket miliknya
    public function my()
    {
        $tickets = Ticket::where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('tickets.my', compact('tickets'));
    }

    // admin lihat semua tiket
    public function index()
    {
        $tickets = Ticket::with('user', 'handler')->latest()->get();
        return view('tickets.index', compact('tickets'));
    }

    // admin ubah status
    public function updateStatus(Request $request, Ticket $ticket)
    {
        $request->validate([
            'status' => 'required|in:open,in-progress,closed',
        ]);

        $data = [
            'status'     => $request->status,
            'handled_by' => Auth::id(),
        ];

        if ($request->status === 'closed') {
            $data['closed_at'] = Carbon::now();
        }

        $ticket->update($data);

        return back()->with('success', 'Status tiket diperbarui.');
    }
}
