<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

class Faq extends Model
{
   use SoftDeletes;
  protected $fillable = [
    'faq_question',
    'faq_answer',
  ];
}
