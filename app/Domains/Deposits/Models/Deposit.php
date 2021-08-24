<?php


namespace App\Domains\Deposits\Models;


use App\Domains\Deposits\QueryBuilders\DepositQueryBuilder;
use App\Domains\Images\Models\Image;
use App\Domains\Users\Models\User;
use App\Domains\Users\QueryBuilders\UserQueryBuilder;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Notifications\Notifiable;

class Deposit extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'amount',
        'description',
        'status',
        'image_id',
        'user_id',
        'transaction_id',
        'reviewed_by',
        'rejection_reason'
    ];

    public static function query(): DepositQueryBuilder|Builder
    {
        return parent::query();
    }

    public function newEloquentBuilder($query): DepositQueryBuilder
    {
        return new DepositQueryBuilder($query);
    }

    public function image(): HasOne
    {
        return $this->hasOne(Image::class, "id", "image_id");
    }

    public function user(): HasOne|UserQueryBuilder
    {
        return $this->hasOne(User::class, "id", "user_id");
    }
}
