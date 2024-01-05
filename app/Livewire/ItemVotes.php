<?php

namespace App\Livewire;

use App\Models\Vote;
use Livewire\Component;
use App\Traits\MapsModels;
use App\Contracts\Vote\Votable;
use Illuminate\Database\Eloquent\Collection;

class ItemVotes extends Component
{
    use MapsModels;

    public int $voteAmount;

    public int $votesFromUser;

    public bool $upvoted;

    public bool $downvoted;

    public ?string $type = null;

    public ?int $modelId = null;

    /**
     * Create a new component instance.
     *
     * @param  Votable|array|null  $votable
     * @param  ?Collection  $votes
     */
    public function mount(Votable|array|null $votable = null, $votes = null)
    {
        if (! isset($votes)) {
            $votes = is_array($votable) ?
                Vote::query()
                    ->where('votable_type', $this->mapToClassName($votable['model_type']))
                    ->where('votable_id', $votable['model_id'])
                    ->get() :
                $votable->votes()->get();

            if ($votable instanceof Votable) {
                $this->type = $votable->modelType();
                $this->modelId = $votable->getId();
            } else {
                // TODO: Throw error if values are not found?
                $this->type = $votable['model_type'];
                $this->modelId = $votable['model_id'];
            }
        }

        $this->voteAmount = $votes->sum('amount');

        $this->votesFromUser = $votes
            ->where('user_id', auth()->id())
            ->sum('amount');

        $this->upvoted = $this->votesFromUser > 0;

        $this->downvoted = $this->votesFromUser < 0;

        $this->type ??= empty($votes->first())
            ? 'N/A'
            : $this->mapToCodeName($votes->first()->votable_type);

        $this->modelId ??= empty($votes->first())
            ? 0
            : $votes->first()->votable_id;
    }

    protected function vote(bool $upvote)
    {
        /** @var Vote $vote */
        $vote = Vote::query()
            ->where('votable_type', $this->mapToClassName($this->type))
            ->where('user_id', auth()->id())
            ->where('votable_id', $this->modelId)
            ->first();

        if (is_null($vote)) {
            Vote::query()
                ->create([
                    'amount' => 1,
                    'user_id' => auth()->id(),
                    'votable_type' => $this->mapToClassName($this->type),
                    'votable_id' => $this->modelId,
                ]);

            $this->setVoteType($upvote);

            $this->voteAmount = $upvote ?
                    $this->voteAmount + 1 :
                    $this->voteAmount - 1;
        } else {
            $neutral = $vote->amount === 0;

            if ($neutral) {
                $this->voteAmount = $upvote ?
                    $this->voteAmount + 1 :
                    $this->voteAmount - 1;

                $vote->vote($upvote);
                $vote->save();
                $this->setVoteType($upvote);
            } else {
                $switch = ($this->upvoted && ! $upvote) || ($this->downvoted && $upvote);

                if ($switch) {
                    $this->voteAmount = $upvote ?
                        $this->voteAmount + 2 :
                        $this->voteAmount - 2;

                    $vote->vote($upvote, true);
                } else {
                    $this->voteAmount = $upvote ?
                        $this->voteAmount - 1 :
                        $this->voteAmount + 1;

                    $vote->resetVote();
                }

                $vote->save();

                // Set vote type
                $switch ? $this->setVoteType($upvote) : $this->setVoteNeutral();
            }
        }
    }

    public function setVoteNeutral(): void
    {
        $this->upvoted = false;
        $this->downvoted = false;
    }

    public function setVoteType(bool $upvoted): void
    {
        $this->upvoted = $upvoted;
        $this->downvoted = ! $upvoted;
    }

    public function upvote()
    {
        $this->vote(true);
    }

    public function downvote()
    {
        $this->vote(false);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('livewire.item-votes');
    }
}
