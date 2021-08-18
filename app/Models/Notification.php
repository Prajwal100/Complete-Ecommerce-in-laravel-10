<?php

  /**
   * Created by Zoran Shefot Bogoevski.
   */

  namespace App\Models;

  use Carbon\Carbon;
  use Eloquent;
  use Illuminate\Database\Eloquent\Builder;
  use Illuminate\Database\Eloquent\Model;

  /**
   * Class Notification
   *
   * @property string $id
   * @property string $type
   * @property string $notifiable_type
   * @property int $notifiable_id
   * @property string $data
   * @property Carbon|null $read_at
   * @property Carbon|null $created_at
   * @property Carbon|null $updated_at
   * @package App\Models
   * @method static Builder|Notification newModelQuery()
   * @method static Builder|Notification newQuery()
   * @method static Builder|Notification query()
   * @method static Builder|Notification whereCreatedAt($value)
   * @method static Builder|Notification whereData($value)
   * @method static Builder|Notification whereId($value)
   * @method static Builder|Notification whereNotifiableId($value)
   * @method static Builder|Notification whereNotifiableType($value)
   * @method static Builder|Notification whereReadAt($value)
   * @method static Builder|Notification whereType($value)
   * @method static Builder|Notification whereUpdatedAt($value)
   * @mixin Eloquent
   */
  class Notification extends Model
  {

    protected $table = 'notifications';
    public $incrementing = false;

    protected $casts = [
        'notifiable_id' => 'int',
    ];

    protected $dates = [
        'read_at',
    ];

    protected $fillable = [
        'type',
        'notifiable_type',
        'notifiable_id',
        'data',
        'read_at',
    ];
  }
