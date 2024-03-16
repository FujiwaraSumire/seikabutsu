<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
use Kyslik\ColumnSortable\Sortable;

class Post extends Model
{
    use SoftDeletes;
    use HasFactory;
    use Sortable;
    
    public static function groupByAttributes()
    {
    $completedTasks = static::where('check', 1)
        ->orderByRaw('ISNULL(priority_id), priority_id ASC')
        ->orderByRaw('ISNULL(deadline), deadline ASC')
        ->get()
        ->groupBy(['category_id', 'priority_id']);

    $incompleteTasks = static::where('check', 0)
        ->orderByRaw('ISNULL(priority_id), priority_id ASC')
        ->orderByRaw('ISNULL(deadline), deadline ASC')
        ->get()
        ->groupBy(['category_id', 'priority_id']);

    $groupedTasks = [];

    foreach ($completedTasks as $category => $priorityGroup) {
        foreach ($priorityGroup as $priority => $posts) {
            $groupedTasks[$category][$priority] = $posts;
        }
    }

    foreach ($incompleteTasks as $category => $priorityGroup) {
        foreach ($priorityGroup as $priority => $posts) {
            if (!isset($groupedTasks[$category][$priority])) {
                $groupedTasks[$category][$priority] = $posts;
            } else {
                foreach ($posts as $post) {
                    $groupedTasks[$category][$priority][] = $post;
                }
            }
        }
    }

    return $groupedTasks;
    }

                
    protected $fillable = [
        'title',
        'body',
        'category_id',
        'check',
        'user_id',
        'deadline',
        'priority_id'
    ];
    
    public $sortable = [
        'category_id',
        'prriority_id',
        'deadline'
        // 追加のソート可能なカラムをここに追加します
    ];
    
    public function complete()
        {
        $this->update(['check' => 1]);
        }

    public function incomplete()
        {
        $this->update(['check' => 0]);
        }
    
    // updated_atで降順に並べたあと、limitで件数制限をかける
    function getPaginateByLimit(int $limit_count = 5)
    
        {
        return $this::with('category')->orderBy('updated_at', 'DESC')->paginate($limit_count);
        }
    
    public function getFormattedDueDateAttribute()
        {
    return Carbon::createFromFormat('Y-m-d', $this->attributes['deadline'])
        ->format('Y/m/d');
        }
       
    // Categoryに対するリレーション

    //「1対多」の関係なので単数系に
    public function category()
        {
        return $this->belongsTo(Category::class);
        }

    // Userに対するリレーション

    //「1対多」の関係なので単数系に
    public function user()
        {
        return $this->belongsTo(User::class);
        }

    // Priorityに対するリレーション

    //「1対多」の関係なので単数系に
    public function priority()
        {
         return $this->belongsTo(Priority::class);
        }
}