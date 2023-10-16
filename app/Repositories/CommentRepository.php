<?php

namespace App\Repositories;

use App\Support\Utils;
use App\Models\Comment;

class CommentRepository
{
    /**
     * Get comments list with pagination.
     * @param  string  $order
     * @param  string  $sort
     * @param  boolean $cursor
     * @param  integer $limit
     * @return \Illuminate\Pagination\CursorPaginator|Paginator
     */
    public function getList($order, $sort, $cursor, $limit = 25)
    {
        $query = Comment::whereNull('parent_id')
            ->orderBy($order, $sort);

        if ($cursor === false) {
            $q = $query->simplePaginate($limit);
            // Paginator with custom order|sort
            return $q->withQueryString();
        }
        // CursorPaginator with default order (LIFO)
        return $query->cursorPaginate($limit);
    }

    /**
     * Get comments for single thread.
     * @param  int|null $id Top level comment id
     * @return array
     */
    public function getThread(?int $id = null)
    {
        $thread = null;

        if ($id) {
            $thread = Comment::where('id', $id);
        } elseif (! $id && Comment::count()) {
            $thread = Comment::whereNull('parent_id')->latest();
        }

        // Thread list with replies and cursor pagination:
        // $threads = Comment::orderBy('id', 'desc')
        //     ->cursorPaginate(1);

        return $thread ? [$thread->first()] : [];
    }

    /**
     * Get form data.
     * @param  int    $id
     * @param  string $token
     * @return array
     */
    public function formData(?int $id, ?string $token)
    {
        // Default form action
        $action = 'create';

        $comment = null;
        // Get comment entry
        if ($id) {
            $comment = Comment::find($id);
        }

        // Editing message mode
        if ($comment && $token) {
            // Verify token? ...
            // We verified the token in FormRequest
            $action = 'update';
        }

        // Reply to message mode
        if ($comment && $action == 'create') {
            // Meta data
            $_comment = [
                'user_name' => $comment->user_name,
                'text'      => $comment->text,
            ];

            $parentId = $comment->id;
            $comment = new \stdClass;
            $comment->parent_id = $parentId;
        }

        return [
            'action'   => $action,
            'token'    => $token ?? null,
            '_comment' => $_comment ?? null,
            'comment'  => $comment ?: new \stdClass,
        ];
    }

    /**
     * Insert new entry.
     * @param  array  $data
     * @return \App\Models\Comment
     */
    public function insert(array $data)
    {
        // Normalize parent_id value
        $pid = $data['parent_id']
            ? (integer) $data['parent_id']
            : null;

        // Get the parent comment level value
        $parentLevel = $pid !== null
            ? Comment::where('id', $pid)->value('level')
            : 0;

        $level = $parentLevel < 5 ? ++$parentLevel : 5;

        // TODO: put attachments data to json.
        $extra = null;

        $comment = Comment::create([
            'parent_id' => $pid,
            'user_name' => $data['user_name'],
            'email'     => $data['email'],
            'home_page' => $data['home_page'],
            'text'      => $data['text'],
            'extra'     => $extra,
            'level'     => $level,
        ]);

        // Set entry token to access to editing
        $comment['token'] = Utils::getToken($comment['id']);

        return $comment;
    }

    /**
     * Update entry.
     * @param  array  $data
     * @return \App\Models\Comment
     */
    public function update(array $data)
    {
        // TODO: put attachments data to json.
        $extra = null;

        $comment = Comment::find($data['id']);

        $comment->user_name = $data['user_name'];
        $comment->email     = $data['email'];
        $comment->home_page = $data['home_page'];
        $comment->text      = $data['text'];
        $comment->extra     = $extra;
        $comment->save();

        $comment->token = $data['token'];

        return $comment;
    }

}
