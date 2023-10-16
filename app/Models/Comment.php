<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    /**
     * The database table used by the model.
     * @var string
     */
    protected $table = 'comments';

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'parent_id',
        'user_name',
        'email',
        'home_page',
        'text',
        'extra',
        'level'
    ];

    /**
     * The attributes that should be cast.
     * @var array<string, string>
     */
    protected $casts = [
        'extra' => 'array',
    ];

    /**
     * Replies to comment.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function replies(): HasMany
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }

    /**
     * Parent comment.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Comment::class);
    }

}
