<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class HeaderEvent extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'desc',
        'held',
        'event_schedule',
        'event_time',
    ];

    public static function getUsers($search_keyword) {
        $events = DB::table('header_events');


        if($search_keyword && !empty($search_keyword)) {
            $events->where(function($q) use ($search_keyword) {
                $q->where('header_events.name', 'like', "%{$search_keyword}%")
                ->orWhere('header_events.held', 'like', "%{$search_keyword}%");
            });
        }
        //return $events->paginate(PER_PAGE_LIMIT);
    }
}
