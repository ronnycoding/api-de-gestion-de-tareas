<?php namespace App\Api\V1\Models;

/**
 * Created by PhpStorm.
 * User: Ronny
 * Date: 12/29/16
 * Time: 21:01
 */

use Illuminate\Database\Eloquent\Model;

class Priorities extends Model
{
    protected $primarykey = 'id';

    protected $table = 'priorities';

    protected $fillable = [ 'name' , 'task_id'];

    public static $storeFields = [ 'name' , 'task_id'];

    public static function rules()
    {
        return [ 'name' => 'required' ];
    }

    protected $dates = ["deleted_at"];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}
