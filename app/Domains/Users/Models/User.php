<?php


namespace App\Domains\Users\Models;


use App\Domains\Deposits\Models\Deposit;
use App\Domains\Deposits\QueryBuilders\DepositQueryBuilder;
use App\Domains\Images\Models\Image;
use App\Domains\Purchases\Models\Purchase;
use App\Domains\Transactions\Models\Transaction;
use App\Domains\Transactions\Models\UserBalance;
use App\Domains\Users\Enums\UserRoleEnum;
use App\Domains\Users\QueryBuilders\UserQueryBuilder;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'username',
        'email',
        'password',
        'role'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public static function query(): UserQueryBuilder|Builder
    {
        return parent::query();
    }

    public function newEloquentBuilder($query): UserQueryBuilder
    {
        return new UserQueryBuilder($query);
    }

    public function isAdmin(): bool
    {
        return $this->role === UserRoleEnum::admin()->value;
    }

    public function deposits(): HasMany|DepositQueryBuilder
    {
        return $this->hasMany(Deposit::class);
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    public function balance(): HasOne
    {
        return $this->hasOne(UserBalance::class);
    }

    public function purchases(): HasMany
    {
        return $this->hasMany(Purchase::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(Image::class);
    }
}
