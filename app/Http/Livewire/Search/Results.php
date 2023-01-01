<?php

namespace App\Http\Livewire\Search;

use App\Traits\MapsModels;
use Livewire\Component;

class Results extends Component
{
    use MapsModels;

    public string $query = '';

    public ?string $type = null;

    public array $results = [];

    const SEARCHABLE_MODELS = [
      '\App\Models\Nugget',
      '\App\Models\Doctrine',
      '\App\Models\User',
      '\App\Models\Religion',
      '\App\Models\Denomination'
    ];

    public function mount()
    {
        foreach ($this->getTypes() ?? self::SEARCHABLE_MODELS as $type) {
            $results = call_user_func([$type, 'query'])
                ->scopes(['search' => [$this->query]])
                ->get();

            $key = $this->isClassName($type)
                ? $this->mapToCodeName($type)
                : $type;

            if ($results->isNotEmpty()) {
                $this->results[$key] = $results;
            }
        }
    }

    protected function getTypes(): ?array
    {
        if (empty($this->type)) {
            return null;
        }

        return array_map(
            fn(string $type) => trim(
                $this->isClassName($type) ? $this->mapToCodeName($type) : $type,
                ' '
            ),
            explode(',', $this->type)
        );
    }

    public function render()
    {
        return view('livewire.search.results');
    }
}
