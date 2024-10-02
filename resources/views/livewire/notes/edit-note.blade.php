<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use App\Models\Note;

new #[Layout('layouts.app')] class extends Component {

    public Note $note;
    public $noteTitle;
    public $noteRecipient;
    public $noteBody;
    public $noteSendDate;
    public $noteIsPublished;

    public function mount(Note $note) {
        $this->authorize('update', $note);
        $this->fill($note);

        $this->noteTitle = $note->title;
        $this->noteRecipient = $note->recipient;
        $this->noteBody = $note->body;
        $this->noteSendDate = $note->send_date->format('Y-m-d');
        $this->noteIsPublished = $note->is_published;
        
    }

    public function saveNote() {
        $this->validate([
            'noteTitle' => 'required|string|min:5',
            'noteRecipient' => 'required|email',
            'noteBody' => 'required|string|min:20',
            'noteSendDate' => 'required|date',
            'noteIsPublished' => 'required|boolean'
        ]);

        $this->note->update([
            'title' => $this->noteTitle,
            'recipient' => $this->noteRecipient,
            'body' => $this->noteBody,
            'send_date' => $this->noteSendDate,
            'is_published' => $this->noteIsPublished
        ]);

        $this->dispatch('note-saved');

        // redirect()->route('notes.index');
    }
}; 

?>



    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Edit a note') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <form wire:submit='saveNote' class="space-y-1">
                <x-input wire:model="noteTitle" label="Title" placeholder="{{ fake()->sentence() }}" />
                <x-textarea wire:model="noteBody" label="Body" placeholder="{{ fake()->sentence() }}" />
                <x-input icon="user" wire:model="noteRecipient" type="email" label="Recipient" placeholder="{{ fake()->email() }}" />
                <x-input icon="calendar" wire:model="noteSendDate" type="date" label="Send date" />
                <x-checkbox label="Note published" wire:model='noteIsPublished' />

                <div class="flex justify-between pt-4">
                    <x-button primary type="submit" spinner>Save note</x-button>
                    <x-button flat negative href="{{route('notes.index')}}">Back to notes</x-button>
                </div>

                <x-action-message on="note-saved" class="text-primary-500" />
                <x-errors />
            </form>
        </div>
    </div>

