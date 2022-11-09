<?php

namespace App\Models;

use App\Core\Services\UUIDTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;

class Opposition extends Model
{
    use HasFactory;
    use UUIDTrait;

    public $keyType = "string";
    public $incrementing = false;

    protected $fillable = [
        'id',
        'name',
        'period',
        'is_visible'
    ];

    public array $allowedSorts = [
        'name',
        'period',
        "created-at"
    ];

    public array $adapterSorts = [
        'name' => "Name",
        'period' => "Period",
        "created-at" => "CreatedAt",
    ];

    public array $allowedFilters = [
        "name",
        "period",
        "created-at",
        "search",
        "day",
        "month",
        "year",
        "date"
    ];

    public array $adapterFilters = [
        "name" => "Name",
        "period" => "Period",
        "created-at" => "CreatedAt",
        "search" => "Search",
        "day" => "Day",
        "month" => "Month",
        "year" => "Year",
        "date" => "Date",
    ];

    public array $allowedIncludes = [];

    public array $adapterIncludes = [];

     protected $casts = [
         'id' => 'string'
     ];

    /* -------------------------------------------------------------------------------------------------------------- */
    // Sorts functions

    public function sortName(Builder $query, $direction): void{
        $query->orderBy('name', $direction);
    }

    public function sortPeriod(Builder $query, $direction): void{
        $query->orderBy('period', $direction);
    }

    public function sortCreatedAt(Builder $query, $direction): void{
        $query->orderBy('created_at', $direction);
    }

    /* -------------------------------------------------------------------------------------------------------------- */
    // Filters functions

    public function filterName(Builder $query, $value): void{
        $query->where('name', 'LIKE', "%{$value}%");
    }
    public function filterPeriod(Builder $query, $value): void{
        $query->where('period', 'LIKE', "%{$value}%");
    }
    public function filterCreatedAt (Builder $query, $value): void {
        $query->whereDate('created_at',$value);
    }
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
            $query->where('name', 'LIKE' , "%{$value}%")
                ->orWhere('period', 'LIKE' , "%{$value}%");
        });
    }

    /* -------------------------------------------------------------------------------------------------------------- */
     // Relationships methods


}