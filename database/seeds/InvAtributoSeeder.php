<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class InvAtributoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('inv_atributos')->truncate();
        DB::table('inv_atributos')->insert(['id'=>1, 'atributo'=>'Tipo de adaptador']);
        DB::table('inv_atributos')->insert(['id'=>2, 'atributo'=>'T_E_Cable_Video_PANTALLA']);
        DB::table('inv_atributos')->insert(['id'=>3, 'atributo'=>'T_E_Cable_Video_TELEVISOR']);
        DB::table('inv_atributos')->insert(['id'=>4, 'atributo'=>'Cantidad de brazos']);
        DB::table('inv_atributos')->insert(['id'=>5, 'atributo'=>'Longitud']);
        DB::table('inv_atributos')->insert(['id'=>6, 'atributo'=>'Tipo silla']);
        DB::table('inv_atributos')->insert(['id'=>7, 'atributo'=>'Tipo microfono']);
        DB::table('inv_atributos')->insert(['id'=>8, 'atributo'=>'Marca Mouse']);
        DB::table('inv_atributos')->insert(['id'=>9, 'atributo'=>'Marca Teclado']);
        DB::table('inv_atributos')->insert(['id'=>10,'atributo'=>'Marca Ventilador']);
        DB::table('inv_atributos')->insert(['id'=>11,'atributo'=>'Mdelo']);
        DB::table('inv_atributos')->insert(['id'=>12,'atributo'=>'Serial']);
        DB::table('inv_atributos')->insert(['id'=>13,'atributo'=>'Velocidad']);
        DB::table('inv_atributos')->insert(['id'=>14,'atributo'=>'Tipo tv']);
        DB::table('inv_atributos')->insert(['id'=>15,'atributo'=>'LIcencia Windows']);
        DB::table('inv_atributos')->insert(['id'=>16,'atributo'=>'Windows']);
        DB::table('inv_atributos')->insert(['id'=>17,'atributo'=>'Tamaño tv']);
        DB::table('inv_atributos')->insert(['id'=>18,'atributo'=>'Tamaño pantalla']);
        DB::table('inv_atributos')->insert(['id'=>19,'atributo'=>'Tipo Disco duro']);
        DB::table('inv_atributos')->insert(['id'=>20,'atributo'=>'Capacidad Disco duro']);
        DB::table('inv_atributos')->insert(['id'=>21,'atributo'=>'Procesador']);
        DB::table('inv_atributos')->insert(['id'=>22,'atributo'=>'Tipo memoria ram']);
        DB::table('inv_atributos')->insert(['id'=>23,'atributo'=>'Capacidad memoria ram']);
        DB::table('inv_atributos')->insert(['id'=>24,'atributo'=>'Colores']);
        DB::table('inv_atributos')->insert(['id'=>25,'atributo'=>'Tipo de conexion']);
        DB::table('inv_atributos')->insert(['id'=>26,'atributo'=>'Tarjeta grafica']);

        Schema::enableForeignKeyConstraints();

    }
}
