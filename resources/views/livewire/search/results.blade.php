<div class="flex flex-col w-full space-y-6">
    @forelse ($results as $typeKey => $result)
        <div class="w-full bg-white rounded-2xl shadow-lg p-8 flex flex-col space-y-4">
            <!-- Type -->
            <h2 class="text-3xl font-bold text-sky-900">{{ \Illuminate\Support\Str::plural($typeKey, $result->count()) }}</h2>
            <pre>
                {{ json_encode($result, JSON_PRETTY_PRINT) }}
            </pre>
        </div>
    @empty
        <div class="w-full h-full justify-center items-center">
            <h2 class="text-2xl font-semibold text-sky-900">No Results...</h2>
        </div>
    @endforelse
</div>
