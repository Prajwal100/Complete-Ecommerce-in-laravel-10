<?php

    namespace App\Models;

    use Eloquent;
    use Illuminate\Database\Eloquent\Builder;
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Support\Carbon;

    /**
     * App\Models\Notification
     *
     * @property int $id
     * @property string $type
     * @property string $notifiable_type
     * @property int $notifiable_id
     * @property string $data
     * @property string|null $read_at
     * @property Carbon|null $created_at
     * @property Carbon|null $updated_at
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
        use HasFactory;

        protected $fillable = ['data', 'type', 'notifiable', 'read_at'];
    }
