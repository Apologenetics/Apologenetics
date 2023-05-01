<div class="flex flex-col space-y-4 w-full">
    <!-- Title & Type -->
    <div class="flex flex-row space-x-4 w-full">
        <h3 class="text-2xl font-bold text-sky-900">{{ $model->title }}</h3>
    </div>
    <!-- Controls -->
    <div class="flex flex-row space-x-4 w-full">
        <!-- Nugget Type -->
        <div class="flex flex-col space-y-2">
            <label class="text-md font-semibold" for="type">Type:</label>
            <select id="type" wire:model="type" class="rounded-xl">
                @forelse(\App\Models\Nugget::NUGGET_TYPES as $nuggetType)
                    <option value="{{ $nuggetType }}">{{ ucwords($nuggetType) }}</option>
                @empty
                    <option></option>
                @endforelse
            </select>
        </div>
        <!-- Nugget For -->
        <div class="flex flex-col space-y-2">
            <label class="text-md font-semibold" for="type">For:</label>
            <select id="type" wire:model="type" class="rounded-xl">
                @forelse(\App\Models\Nugget::NUGGETS_FROM as $nuggetFor)
                    <option value="{{ $nuggetFor }}">{{ ucwords($nuggetFor) }}</option>
                @empty
                    <option></option>
                @endforelse
            </select>
        </div>
    </div>
</div>
