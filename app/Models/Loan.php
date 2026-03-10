<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    protected $fillable = [
        'borrower_name',
        'borrower_email',
        'book_title',
        'borrowed_at',
        'due_date',
        'returned',
        'status',
    ];
}