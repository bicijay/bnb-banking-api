<?php


namespace App\Domains\Transactions\Models;


use App\Domains\Transactions\QueryBuilders\UserBalanceQueryBuilder;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class UserBalance extends Model
{
    use HasFactory, Notifiable;

    protected $table = "users_balance";

    protected $fillable = [
        'user_id',
        'current_balance',
        'total_incomes',
        'total_expenses'
    ];

    public static function query(): UserBalanceQueryBuilder|Builder
    {
        return parent::query();
    }

    public function newEloquentBuilder($query): UserBalanceQueryBuilder
    {
        return new UserBalanceQueryBuilder($query);
    }
}
