<?php

namespace App\View\Components;

use Illuminate\View\Component;

class StatusBadge extends Component
{
    public $status;

    public function __construct($status)
    {
        $this->status = $status;
    }

    public function render()
    {
        $class = match($this->status) {
            'selesai' => 'bg-green-500 text-white',
            'dalam_antrian' => 'bg-yellow-500 text-white',
            'ditolak' => 'bg-red-500 text-white',
            default => 'bg-yellow-500 text-white',
        };

        return view('components.status-badge', ['class' => $class]);
    }
}
