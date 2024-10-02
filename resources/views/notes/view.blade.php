<x-guest-layout>
    <div class="flex flex-col justify-between">
        <h1 class="text-xl font-semibold leading-tight text-gray-800">{{ $note->title }}</h1>
    </div>

    <p class="mt-2 text-xs">{{ $note->body }}</p>

    <div class="flex items-center justify-end gap-2 mt-12">
        <h3 class="text-sm">{{ $user->name }}</h3>
        <livewire:heartreact :note="$note" :key="$note->id" />
    </div>
</x-guest-layout>