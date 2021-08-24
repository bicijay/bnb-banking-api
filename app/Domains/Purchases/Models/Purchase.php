<?php


namespace App\Domains\Purchases\Models;


use App\Domains\Purchases\QueryBuilders\PurchaseQueryBuilder;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Purchase extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'amount',
        'description',
        'purchased_at',
        'transaction_id',
        'user_id'
    ];

    public static function query(): PurchaseQueryBuilder|Builder
    {
        return parent::query();
    }

    public function newEloquentBuilder($query): PurchaseQueryBuilder
    {
        return new PurchaseQueryBuilder($query);
    }
}
