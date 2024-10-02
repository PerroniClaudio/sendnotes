<?php

use Livewire\Volt\Component;

new class extends Component {
    //

    public $noteTitle;
    public $noteRecipient;
    public $noteBody;
    public $noteSendDate;

    public function submit() {
        $this->validate([
            'noteTitle' => 'required|string|min:5',
            'noteRecipient' => 'required|email',
            'noteBody' => 'required|string|min:20',
            'noteSendDate' => 'required|date'
        ]);

        Auth::user()->notes()->create([
            'title' => $this->noteTitle,
            'recipient' => $this->noteRecipient,
            'body' => $this->noteBody,
            'send_date' => $this->noteSendDate,
            'is_published' => true
        ]);

        redirect()->route('notes.index');
    }

    public function with(): array {
        return [
            'title' => 'Create notes'
        ];
    }
}; ?>

<div> 
   <form wire:submit='submit' class="space-y-1">
        <x-input wire:model="noteTitle" label="Title" placeholder="{{ fake()->sentence() }}" />
        <x-textarea wire:model="noteBody" label="Body" placeholder="{{ fake()->sentence() }}" />
        <x-input icon="user" wire:model="noteRecipient" type="email" label="Recipient" placeholder="{{ fake()->email() }}" />
        <x-input icon="calendar" wire:model="noteSendDate" type="date" label="Send date" />
        <div class="pt-4">
            <x-button primary type="submit" spinner>Create note</x-button>
        </div>
        <x-errors />
   </form>
</div>
