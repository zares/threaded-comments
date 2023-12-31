<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\CommentRepository;
use App\Http\Requests\RemoveCommentRequest;
use App\Http\Requests\CommentRequest;

class CommentsController extends Controller
{
    /**
     * Constructor.
     * @param CommentRepository $repository
     */
    public function __construct(
        private CommentRepository $repository
    ) {}

    /**
     * Top level comment list.
     * @param  Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function list(Request $request)
    {
        $view   = $request->query('index') ? 'index' : 'items';
        $order  = $request->query('orderby') ?: 'id';
        $sort   = $request->query('sort') ?: 'desc';
        $cursor = $order == 'id';

        $entries = $this->repository
            ->getList($order, $sort, $cursor);

        return response()->json([
            'html' => view("list.{$view}", [
                'comments' => $entries
            ])->render()
        ]);
    }

    /**
     * Thread of comments.
     * @param  int|null $id Thread id
     * @return \Illuminate\Http\JsonResponse
     */
    public function thread(?int $id = null)
    {
        // Get the singlle thread
        $entries = $this->repository
            ->getThread($id);

        return response()->json([
            'html' => view('thread.index', [
                'comments' => $entries
            ])->render()
        ]);
    }

    /**
     * The Comment form.
     * @param  int|null $id    Comment id
     * @param  string   $token Comment token
     * @return \Illuminate\Http\JsonResponse
     */
    public function form(?int $id = null, string $token = '')
    {
        // Reset math captcha
        app('captcha')->reset();

        // Get data to fill the form
        $formData = $this->repository
            ->formData($id, $token);

        return response()->json([
            'html' => view('form.full',
                $formData
            )->render()
        ]);
    }

    /**
     * Create comment.
     * @param  CommentRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(CommentRequest $request)
    {
        // Insert new comment entry
        $entry = $this->repository
            ->insert($request->validated());

        return response()->json([
            'id'   => $entry['id'],
            'html' => view('thread.items', [
                'parent'   => $entry['parent_id'],
                'comments' => [$entry]
            ])->render()
        ]);
    }

    /**
     * Update comment.
     * @param  CommentRequest $request
     * @return Illuminate\Http\JsonResponse
     */
    public function update(CommentRequest $request)
    {
        // Update comment entry
        $entry = $this->repository
            ->update($request->validated());

        return response()->json([
            'id'   => $entry->id,
            'html' => view('thread.items', [
                'parent'   => $entry->parent_id,
                'comments' => [$entry]
            ])->render()
        ]);
    }

    /**
     * Remove comment.
     * @param  RemoveCommentRequest $request
     * @return Illuminate\Http\JsonResponse
     */
    public function remove(RemoveCommentRequest $request)
    {
        $result = $this->repository
            ->remove($request->validated());

        if (! $result) {
            return response()->json([
                'You cannot delete a message that has replies.'
            ], 409);
        }

        return response()->json([]);
    }

}
