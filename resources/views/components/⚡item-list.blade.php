<?php

use Livewire\Volt\Component;
use Livewire\Attributes\On;
use App\Models\Item;

new class extends Component {
    public $items = [];

    public function mount()
    {
        $this->items = Item::latest()->get();
    }

    #[On('echo:data-channel,.data.updated')]
    public function refreshData()
    {
        $this->items = Item::latest()->get();
    }
}; ?>

<div>
    <table class="table">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Update Terakhir</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $item)
                <tr wire:key="item-{{ $item->id }}">
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->updated_at->diffForHumans() }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>