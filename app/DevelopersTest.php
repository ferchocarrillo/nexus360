<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DevelopersTest extends Model
{
    protected $table = 'developers_tests';

    protected $fillable = [
        'idCase',
        'type_request',
        'rules_test',
        'routes_test',
        'views_test',
        'databases_test',
        'migration_test',
        'seeder_test',
        'export_test',
        'adminlte_test',
        'permission_test',
        'additional_test',
        'view_count',
        'elapsed_created',
        'created_at',
        'updated_at',
    ];



    public function creator(){
        return $this->belongsTo('App\User','required_by');
    }
}
