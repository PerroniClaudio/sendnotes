<?php

    use Livewire\Volt\Component;
    use App\Models\Note;

    new class extends Component {
       public function with(): array {
           return [
               'notes' => Auth::user()->notes()->orderBy('send_date', 'desc')->get(),
               'title' => 'Show notes'
           ];
       }

       public function delete($noteId) {
            
            $note = Note::find($noteId);
            $this->authorize('delete', $note);
            $note->delete();
        
       }
    }; 

?>

<div>
    <div class="space-y-2">
        @unless($notes->isEmpty())
            <x-button primary right-icon="plus" href="{{route('notes.create')}}" wire:create>Create note</x-button>
            <div class="grid grid-cols-3 gap-4 mt-12">
                @foreach($notes as $note)
                    <x-card wire:key='{{ $note->id }}'>
                        <div class="flex items-center justify-between cursor-pointer">
                            <div>
                                <a href="{{ route('notes.edit', $note) }}" wire:navigate class="text-lg font-semibold hover:underline hover:text-teal-500"><span>{{ $note->title }}</span></a>
                                <p class="mt-2 text-xs">{{ Str::limit($note->body, 50)}}</p>
                            </div>
                            
                            <span class="text-xs text-gray-500">{{ $note->send_date->format('d/m/Y') }}</span>
                        </div>
                        <div class="flex items-end justify-between mt-4 space-x-1">
                            <div class="text-xs">Recipients: <span class="font-semibold">{{ $note->recipient }}</span></div>
                            <div>
                                <x-mini-button  outline rounded secondary icon="eye" />
                                <x-mini-button  outline rounded secondary icon="trash" wire:click="delete('{{ $note->id }}')" />
                            </div>
                        </div>
                    </x-card>
                @endforeach
            </div>
        @else
            <div class="text-center text-gray-500 dark:text-gray-400">
                <p class="text-xl font-bold">No notes yet</p>
                <p class="text-sm">Let's create our first note!</p>
                <x-button primary right-icon="plus" class="mt-6" href="{{route('notes.create')}}" wire:create>Create note</x-button>
            </div>
            
        @endunless
    </div>
</div>
