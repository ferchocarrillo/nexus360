<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InvEspecificacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        DB::table('inv_especificacions')->truncate();

        DB::table('inv_especificacions')->insert(['id'=>1,'id_atributo'=>2,'especificacion'=>'Cable DisplayPort']);
        DB::table('inv_especificacions')->insert(['id'=>2,'id_atributo'=>2,'especificacion'=>'Cable DVI']);
        DB::table('inv_especificacions')->insert(['id'=>3,'id_atributo'=>2,'especificacion'=>'Cable HDMI']);
        DB::table('inv_especificacions')->insert(['id'=>4,'id_atributo'=>2,'especificacion'=>'Cable VGA']);
        DB::table('inv_especificacions')->insert(['id'=>5,'id_atributo'=>3,'especificacion'=>'Cable HDMI']);
        DB::table('inv_especificacions')->insert(['id'=>6,'id_atributo'=>3,'especificacion'=>'Cable VGA']);
        DB::table('inv_especificacions')->insert(['id'=>7,'id_atributo'=>4,'especificacion'=>'2 brazos']);
        DB::table('inv_especificacions')->insert(['id'=>8,'id_atributo'=>4,'especificacion'=>'3 brazos']);
        DB::table('inv_especificacions')->insert(['id'=>9,'id_atributo'=>5,'especificacion'=>'1 metro']);
        DB::table('inv_especificacions')->insert(['id'=>10,'id_atributo'=>5,'especificacion'=>'2 metros']);
        DB::table('inv_especificacions')->insert(['id'=>11,'id_atributo'=>5,'especificacion'=>'3 metros']);
        DB::table('inv_especificacions')->insert(['id'=>12,'id_atributo'=>6,'especificacion'=>'Ejecutiva']);
        DB::table('inv_especificacions')->insert(['id'=>13,'id_atributo'=>6,'especificacion'=>'Gerencial']);
        DB::table('inv_especificacions')->insert(['id'=>14,'id_atributo'=>6,'especificacion'=>'Interlocutora']);
        DB::table('inv_especificacions')->insert(['id'=>15,'id_atributo'=>6,'especificacion'=>'Secretarial']);
        DB::table('inv_especificacions')->insert(['id'=>16,'id_atributo'=>6,'especificacion'=>'Cajero']);
        DB::table('inv_especificacions')->insert(['id'=>17,'id_atributo'=>7,'especificacion'=>'Dinamicos']);
        DB::table('inv_especificacions')->insert(['id'=>18,'id_atributo'=>7,'especificacion'=>'Conferencia']);
        DB::table('inv_especificacions')->insert(['id'=>19,'id_atributo'=>7,'especificacion'=>'Condensador']);
        DB::table('inv_especificacions')->insert(['id'=>20,'id_atributo'=>7,'especificacion'=>'Solapa']);
        DB::table('inv_especificacions')->insert(['id'=>21,'id_atributo'=>8,'especificacion'=>'Lenovo']);
        DB::table('inv_especificacions')->insert(['id'=>22,'id_atributo'=>8,'especificacion'=>'Seisa']);
        DB::table('inv_especificacions')->insert(['id'=>23,'id_atributo'=>8,'especificacion'=>'Hewlett-Packard']);
        DB::table('inv_especificacions')->insert(['id'=>24,'id_atributo'=>8,'especificacion'=>'Logitech']);
        DB::table('inv_especificacions')->insert(['id'=>25,'id_atributo'=>8,'especificacion'=>'Genius']);
        DB::table('inv_especificacions')->insert(['id'=>26,'id_atributo'=>8,'especificacion'=>'Dell']);
        DB::table('inv_especificacions')->insert(['id'=>27,'id_atributo'=>8,'especificacion'=>'Hacer']);
        DB::table('inv_especificacions')->insert(['id'=>28,'id_atributo'=>8,'especificacion'=>'LG']);
        DB::table('inv_especificacions')->insert(['id'=>29,'id_atributo'=>9,'especificacion'=>'Lenovo']);
        DB::table('inv_especificacions')->insert(['id'=>30,'id_atributo'=>9,'especificacion'=>'Seisa']);
        DB::table('inv_especificacions')->insert(['id'=>31,'id_atributo'=>9,'especificacion'=>'Hewlett-Packard']);
        DB::table('inv_especificacions')->insert(['id'=>32,'id_atributo'=>9,'especificacion'=>'Logitech']);
        DB::table('inv_especificacions')->insert(['id'=>33,'id_atributo'=>9,'especificacion'=>'Genius']);
        DB::table('inv_especificacions')->insert(['id'=>34,'id_atributo'=>9,'especificacion'=>'Dell']);
        DB::table('inv_especificacions')->insert(['id'=>35,'id_atributo'=>9,'especificacion'=>'Hacer']);
        DB::table('inv_especificacions')->insert(['id'=>36,'id_atributo'=>9,'especificacion'=>'LG']);
        DB::table('inv_especificacions')->insert(['id'=>37,'id_atributo'=>10,'especificacion'=>'Nex']);
        DB::table('inv_especificacions')->insert(['id'=>38,'id_atributo'=>10,'especificacion'=>'Samsung']);
        DB::table('inv_especificacions')->insert(['id'=>39,'id_atributo'=>10,'especificacion'=>'Bionaire']);
        DB::table('inv_especificacions')->insert(['id'=>40,'id_atributo'=>10,'especificacion'=>'Lileng']);
        DB::table('inv_especificacions')->insert(['id'=>41,'id_atributo'=>14,'especificacion'=>'Smart TV']);
        DB::table('inv_especificacions')->insert(['id'=>42,'id_atributo'=>14,'especificacion'=>'LED']);
        DB::table('inv_especificacions')->insert(['id'=>43,'id_atributo'=>16,'especificacion'=>'Windows 7 Pro']);
        DB::table('inv_especificacions')->insert(['id'=>44,'id_atributo'=>16,'especificacion'=>'Windows 10 Pro']);
        DB::table('inv_especificacions')->insert(['id'=>45,'id_atributo'=>17,'especificacion'=>'14"']);
        DB::table('inv_especificacions')->insert(['id'=>46,'id_atributo'=>17,'especificacion'=>'16"']);
        DB::table('inv_especificacions')->insert(['id'=>47,'id_atributo'=>17,'especificacion'=>'18"']);
        DB::table('inv_especificacions')->insert(['id'=>48,'id_atributo'=>17,'especificacion'=>'19"']);
        DB::table('inv_especificacions')->insert(['id'=>49,'id_atributo'=>17,'especificacion'=>'20"']);
        DB::table('inv_especificacions')->insert(['id'=>50,'id_atributo'=>17,'especificacion'=>'21"']);
        DB::table('inv_especificacions')->insert(['id'=>51,'id_atributo'=>17,'especificacion'=>'22"']);
        DB::table('inv_especificacions')->insert(['id'=>52,'id_atributo'=>17,'especificacion'=>'24"']);
        DB::table('inv_especificacions')->insert(['id'=>53,'id_atributo'=>17,'especificacion'=>'32"']);
        DB::table('inv_especificacions')->insert(['id'=>54,'id_atributo'=>17,'especificacion'=>'37"']);
        DB::table('inv_especificacions')->insert(['id'=>55,'id_atributo'=>17,'especificacion'=>'40"']);
        DB::table('inv_especificacions')->insert(['id'=>56,'id_atributo'=>17,'especificacion'=>'42"']);
        DB::table('inv_especificacions')->insert(['id'=>57,'id_atributo'=>17,'especificacion'=>'46"']);
        DB::table('inv_especificacions')->insert(['id'=>58,'id_atributo'=>17,'especificacion'=>'50"']);
        DB::table('inv_especificacions')->insert(['id'=>59,'id_atributo'=>17,'especificacion'=>'55"']);
        DB::table('inv_especificacions')->insert(['id'=>60,'id_atributo'=>17,'especificacion'=>'60"']);
        DB::table('inv_especificacions')->insert(['id'=>61,'id_atributo'=>17,'especificacion'=>'65"']);
        DB::table('inv_especificacions')->insert(['id'=>62,'id_atributo'=>17,'especificacion'=>'70"']);
        DB::table('inv_especificacions')->insert(['id'=>63,'id_atributo'=>17,'especificacion'=>'75"']);
        DB::table('inv_especificacions')->insert(['id'=>64,'id_atributo'=>18,'especificacion'=>'14"']);
        DB::table('inv_especificacions')->insert(['id'=>65,'id_atributo'=>18,'especificacion'=>'16"']);
        DB::table('inv_especificacions')->insert(['id'=>66,'id_atributo'=>18,'especificacion'=>'18"']);
        DB::table('inv_especificacions')->insert(['id'=>67,'id_atributo'=>18,'especificacion'=>'19"']);
        DB::table('inv_especificacions')->insert(['id'=>68,'id_atributo'=>18,'especificacion'=>'20"']);
        DB::table('inv_especificacions')->insert(['id'=>69,'id_atributo'=>18,'especificacion'=>'21"']);
        DB::table('inv_especificacions')->insert(['id'=>70,'id_atributo'=>18,'especificacion'=>'22"']);
        DB::table('inv_especificacions')->insert(['id'=>71,'id_atributo'=>19,'especificacion'=>'HDD mecanico']);
        DB::table('inv_especificacions')->insert(['id'=>72,'id_atributo'=>19,'especificacion'=>'SDD solido']);
        DB::table('inv_especificacions')->insert(['id'=>73,'id_atributo'=>20,'especificacion'=>'240 GB']);
        DB::table('inv_especificacions')->insert(['id'=>74,'id_atributo'=>20,'especificacion'=>'480 GB']);
        DB::table('inv_especificacions')->insert(['id'=>75,'id_atributo'=>20,'especificacion'=>'500 GB']);
        DB::table('inv_especificacions')->insert(['id'=>76,'id_atributo'=>20,'especificacion'=>'1 TB']);
        DB::table('inv_especificacions')->insert(['id'=>77,'id_atributo'=>21,'especificacion'=>'Core i 3']);
        DB::table('inv_especificacions')->insert(['id'=>78,'id_atributo'=>21,'especificacion'=>'Core i 5']);
        DB::table('inv_especificacions')->insert(['id'=>79,'id_atributo'=>21,'especificacion'=>'Core i 7']);
        DB::table('inv_especificacions')->insert(['id'=>80,'id_atributo'=>22,'especificacion'=>'DDR3']);
        DB::table('inv_especificacions')->insert(['id'=>81,'id_atributo'=>22,'especificacion'=>'DDR4']);
        DB::table('inv_especificacions')->insert(['id'=>82,'id_atributo'=>23,'especificacion'=>'1 GB ']);
        DB::table('inv_especificacions')->insert(['id'=>83,'id_atributo'=>23,'especificacion'=>'2 GB ']);
        DB::table('inv_especificacions')->insert(['id'=>84,'id_atributo'=>23,'especificacion'=>'4 GB ']);
        DB::table('inv_especificacions')->insert(['id'=>85,'id_atributo'=>23,'especificacion'=>'8 GB ']);
        DB::table('inv_especificacions')->insert(['id'=>86,'id_atributo'=>23,'especificacion'=>'12 GB ']);
        DB::table('inv_especificacions')->insert(['id'=>87,'id_atributo'=>23,'especificacion'=>'16 GB']);
        DB::table('inv_especificacions')->insert(['id'=>88,'id_atributo'=>24,'especificacion'=>'Negro ']);
        DB::table('inv_especificacions')->insert(['id'=>89,'id_atributo'=>24,'especificacion'=>'Blanco']);
        DB::table('inv_especificacions')->insert(['id'=>90,'id_atributo'=>24,'especificacion'=>'Gris']);
        DB::table('inv_especificacions')->insert(['id'=>91,'id_atributo'=>24,'especificacion'=>'Otros']);


    }
}
