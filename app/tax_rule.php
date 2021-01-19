<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tax_rule extends Model
{

protected $table='tax_rules';
    protected $fillable = [
        'id', 'tax_rule_id', 'tax_class_id' , 'tax_rate_id' , 'based' , 'priority'
    ];
    public function tax_class()
    {
        return $this->beLongsTo('App\tax_class' , 'tax_class_id' , 'tax_class_id');
    }

    public function tax_rate()
    {
        return $this->beLongsTo('App\tax_rate' , 'tax_rate_id' , 'tax_rate_id');
    }
}
