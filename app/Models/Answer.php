<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Core\Services\UUIDTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;

class Answer extends Model
{
    use HasFactory;
    //use SoftDeletes;
    use UUIDTrait;

    protected $fillable = [
        "id",
        "answer",
        "is_grouper_answer",
        "is_correct_answer",
        "question_id",
    ];

    public array $allowedSorts = [
        "created-at"
    ];

    public array $adapterSorts = [
        "created-at" => "CreatedAt",
    ];

    public array $allowedFilters = [
        "search",
        "day",
        "month",
        "year",
        "date"
    ];

    public array $adapterFilters = [
        "search" => "Search",
        "day" => "Day",
        "month" => "Month",
        "year" => "Year",
        "date" => "Date",
    ];

    public array $allowedIncludes = [
        'question'
    ];

    public array $adapterIncludes = [];

     protected $casts = [
        'uuid' => 'string'
     ];

    public function getRouteKeyName(): string
    {
        return 'uuid';
    }


    /* -------------------------------------------------------------------------------------------------------------- */
    // Sorts functions

    public function sortCreatedAt(Builder $query, $direction): void{
        $query->orderBy('created_at', $direction);
    }

    /* -------------------------------------------------------------------------------------------------------------- */
    // Filters functions

    public function filterYear(Builder $query, $value): void{
        $query->whereYear('created_at', $value);
    }
    public function filterMonth(Builder $query, $value): void{
        $query->whereMonth('created_at', $value);
    }
    public function filterDay(Builder $query, $value): void{
        $query->whereDay('created_at', $value);
    }
    public function filterDate(Builder $query, $value): void{
        $query->whereDate('created_at', $value);
    }

    public function filterSearch(Builder $query, $value): void{
        $query->orWhere(function($query) use ($value) {
            $query->where('field', 'LIKE' , "%{$value}%")
                ->orWhere('other_field', 'LIKE' , "%{$value}%");
        });
    }

    /* -------------------------------------------------------------------------------------------------------------- */
     // Relationships methods

    public function question (): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Question::class);
    }
}
