<?php

use Livewire\Volt\Component;
use App\Models\Note;

new class extends Component {
    //
    public Note $note;
    public $heartcount; 

    public function mount(Note $note)
    {
        $this->note = $note;
        $this->heartcount = $note->heart_counter;
    }

    public function increase()
    {
        $this->heartcount++;
        $this->note->update(['heart_counter' => $this->heartcount]);
    }
    
}; ?>

<div>
    <x-button xs rose spinner wire:click="increase"  icon="heart">{{ $heartcount }}</x-button>
</div>