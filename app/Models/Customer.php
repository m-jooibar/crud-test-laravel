<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * @mixin \Eloquent
 */
class Customer extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function uuid(string $uuid): self
    {
        return static::where('uuid', $uuid)->first();
    }

    public function updateColumns(Collection $collection)
    {
        $columns = ['Firstname', 'Lastname', 'DateOfBirth', 'PhoneNumber', 'Email', 'BankAccountNumber'];
        foreach ($columns as $column) {
            if ($collection->has($column)) {
                $this->{$column} = $collection->get($column);
            }
        }
        $this->save();
    }
}
