<?php


namespace App\Domains\Transactions\Models;


use App\Domains\Transactions\QueryBuilders\TransactionQueryBuilder;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Transaction extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'type',
        'amount',
        'description',
        'user_id',
        'transaction_at'
    ];

    public static function query(): TransactionQueryBuilder|Builder
    {
        return parent::query();
    }

    public function newEloquentBuilder($query): TransactionQueryBuilder
    {
        return new TransactionQueryBuilder($query);
    }
}
