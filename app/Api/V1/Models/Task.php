<?php namespace App\Api\V1\Models;

/**
 * Created by PhpStorm.
 * User: Ronny
 * Date: 12/29/16
 * Time: 19:03
 */

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $primarykey = 'id';

    protected $table = 'tasks';

    protected $fillable = [ 'title', 'description', 'due_description', 'user_id' ];

    public static function rules()
    {
        return [
            'title' => 'required',
            'description' => 'required',
            'due_description' => 'required|date_format:"Y-m-d"',
        ];
    }

    protected $dates = ["deleted_at"];

    public static $storeFields = ['title', 'description', 'due_description'];

    public static $updateFields = ['id', 'title', 'description', 'due_description'];

    /**
     * Eloquent relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Eloquent relationship
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function priorities()
    {
        return $this->hasMany(Prorities::class);
    }
}
