<?php

namespace App\Livewire;

use App\Models\Comment;
use App\Traits\MapsModels;
use LivewireUI\Modal\ModalComponent;
use App\Contracts\Comment\CreatesComment;

class CommentModal extends ModalComponent
{
    use MapsModels;

    public array $model;

    public ?string $content = null;

    public array $comments;

    public int $totalVotes;

    public array $state = [
        'comment' => '',
        'parent_id' => null,
    ];

    /**
     * Initialize Livewire components
     *
     * @param  int  $modelId
     * @param  string  $type
     * @return void
     *
     * @throws \Exception
     */
    public function mount(int $modelId, string $type)
    {
        if ($this->canMapToComment($type, true)) {
            $model = call_user_func([$this->mapToClassName($type), 'query'])
                ->with([
                    'votes',
                    'createdBy',
                    'commentsWithReplies.votes',
                    'commentsWithReplies.createdBy',
                    'commentsWithReplies.repliesWithEssentials',
                ])->find($modelId);

            // Comments are sorted by parent_id
            // Display differently when it has children
            // and display the children differently
            $model->commentsWithReplies->each(function (Comment $comment) {
                if (empty($comment->parent_id)) {
                    $this->comments[$comment->getKey()] = $comment->mapToCommentArray();
                }
            });

            $this->model = [
                'id' => $model->getKey(),
                'title' => $model->title,
                'content' => $model->description,
                'created_by' => $model->createdBy->username,
                'created_at' => $model->created_at->diffForHumans(),
                'updated_at' => $model->updated_at?->diffForHumans(),
                'user_id' => $model->createdBy->id,
                'model_type' => $type,
            ];

            $this->totalVotes = $model->votes->sum('amount');
        } else {
            // TODO: Custom exception
            throw new \Exception('Model type is not commentable');
        }
    }

    public function post(CreatesComment $createComment)
    {
        $createComment([
            'user_id' => auth()->id(),
            'commentable_id' => $this->model['id'],
            'commentable_type' => $this->mapToClassName($this->model['model_type']),
            'content' => $this->state['comment'],
            'parent_id' => $this->state['parent_id'],
        ]);

        $this->closeModal();
    }

    protected function getRecursiveIds(?array $root = null, bool $flat = true): array
    {
        $arr = [];

        foreach (($root ?? $this->comments) as $comment) {
            $arr[$comment->getKey()] = $comment->repliesWithEssentials->map(function ($item) use ($flat) {
                return [$item->getKey() => $this->getRecursiveIds($item->repliesWithEssentials, $flat)];
            });
        }

        return $arr;
    }

    public function getComment($id)
    {
        if (in_array($id, array_keys($this->comments))) {
            return $this->comments[$id];
        }

        // Search for structure

        return $comment;
    }

    public function reply(int $id)
    {
        $ids = $this->getRecursiveIds();

        if (in_array($id, $ids)) {
            $this->state['parent_id'] = $id;
        }
    }

    public function cancelReply()
    {
        $this->state['paren_id'] = null;
    }

    public function render()
    {
        return view('livewire.comment-modal');
    }
}
