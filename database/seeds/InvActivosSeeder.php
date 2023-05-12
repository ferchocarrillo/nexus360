<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class InvActivosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('inv_activos')->truncate();
DB::table('inv_activos')->insert(['articulo'=> 'Diadema','codigo'=> 'DM']);
DB::table('inv_activos')->insert(['articulo'=> 'Web Cam','codigo'=> 'CM']);
DB::table('inv_activos')->insert(['articulo'=> 'Pantalla','codigo'=> 'PT']);
DB::table('inv_activos')->insert(['articulo'=> 'Cpu','codigo'=> 'CPU']);
DB::table('inv_activos')->insert(['articulo'=> 'Todo En Uno - Cpu','codigo'=> 'AIO']);
DB::table('inv_activos')->insert(['articulo'=> 'Laptops','codigo'=> 'LTP']);
DB::table('inv_activos')->insert(['articulo'=> 'Base Refrigerante Laptop','codigo'=> 'BR']);
DB::table('inv_activos')->insert(['articulo'=> 'Brazos Soportes','codigo'=> 'BS']);
DB::table('inv_activos')->insert(['articulo'=> 'Televisor','codigo'=> 'TV']);
DB::table('inv_activos')->insert(['articulo'=> 'Muebles Y Enseres','codigo'=> 'ME']);
DB::table('inv_activos')->insert(['articulo'=> 'Sillas','codigo'=> 'SL']);
DB::table('inv_activos')->insert(['articulo'=> 'Nevera','codigo'=> 'NV']);
DB::table('inv_activos')->insert(['articulo'=> 'Cafetera','codigo'=> 'CF']);
DB::table('inv_activos')->insert(['articulo'=> 'Equipo De Servicio','codigo'=> 'HM']);
DB::table('inv_activos')->insert(['articulo'=> 'Huelleros','codigo'=> 'HE']);
DB::table('inv_activos')->insert(['articulo'=> 'Ventilador De Torre / Aire Acondicionador ','codigo'=> 'VT']);
DB::table('inv_activos')->insert(['articulo'=> 'Impresora','codigo'=> 'IP']);
DB::table('inv_activos')->insert(['articulo'=> 'Teléfonos','codigo'=> 'TEL']);
DB::table('inv_activos')->insert(['articulo'=> 'Routers Wifi','codigo'=> 'RS']);
DB::table('inv_activos')->insert(['articulo'=> 'Playstation ','codigo'=> 'PYL']);
DB::table('inv_activos')->insert(['articulo'=> 'Pach Panel','codigo'=> 'PP']);
DB::table('inv_activos')->insert(['articulo'=> 'Ups','codigo'=> 'UPS']);
DB::table('inv_activos')->insert(['articulo'=> 'Drone','codigo'=> 'DR']);
DB::table('inv_activos')->insert(['articulo'=> 'Tripode','codigo'=> 'TD']);
DB::table('inv_activos')->insert(['articulo'=> 'Flash','codigo'=> 'FD']);
DB::table('inv_activos')->insert(['articulo'=> 'Lente Y Adaptador','codigo'=> 'LTC']);
DB::table('inv_activos')->insert(['articulo'=> 'Micrófono','codigo'=> 'MF']);
DB::table('inv_activos')->insert(['articulo'=> 'Internet Cable','codigo'=> 'CIN']);
DB::table('inv_activos')->insert(['articulo'=> 'Vga Cable','codigo'=> 'CVG']);
DB::table('inv_activos')->insert(['articulo'=> 'Dvi Cable','codigo'=> 'CVI']);
DB::table('inv_activos')->insert(['articulo'=> 'Power Cable/Poder','codigo'=> 'CPO']);
DB::table('inv_activos')->insert(['articulo'=> 'Hdmi Cable','codigo'=> 'CHD']);
DB::table('inv_activos')->insert(['articulo'=> 'Displayport Cable ','codigo'=> 'CDP']);
DB::table('inv_activos')->insert(['articulo'=> 'Adaptador Hdmi A Vga','codigo'=> 'AHV']);
DB::table('inv_activos')->insert(['articulo'=> 'Adaptador Vga A Dvi','codigo'=> 'AVV']);
DB::table('inv_activos')->insert(['articulo'=> 'Adaptador Vga A Usb','codigo'=> 'AUV']);
DB::table('inv_activos')->insert(['articulo'=> 'Adaptador Vga A Displayport ','codigo'=> 'ADV']);
DB::table('inv_activos')->insert(['articulo'=> 'Adaptador Dvi A Displayport','codigo'=> 'AVD']);
DB::table('inv_activos')->insert(['articulo'=> 'Convertidores Dvi Macho A Vga ','codigo'=> 'CVM']);
DB::table('inv_activos')->insert(['articulo'=> 'Convertidores Dvi Hermbra A Vga ','codigo'=> 'CVH']);
DB::table('inv_activos')->insert(['articulo'=> 'Mouse/Ratón','codigo'=> 'MSE']);
DB::table('inv_activos')->insert(['articulo'=> 'Keyboard/Teclado','codigo'=> 'TCL']);
DB::table('inv_activos')->insert(['articulo'=> 'Fan/Ventilador','codigo'=> 'FAN']);
DB::table('inv_activos')->insert(['articulo'=> 'Discos Duro Mecanico Laptops/Portatil','codigo'=> 'DLM']);
DB::table('inv_activos')->insert(['articulo'=> 'Discos Duro Estado Solido Laptops/Portatil','codigo'=> 'DLS']);
DB::table('inv_activos')->insert(['articulo'=> 'Discos Duro Cpu Mecanico','codigo'=> 'DCM']);
DB::table('inv_activos')->insert(['articulo'=> 'Discos Duro Cpu Estado Solido','codigo'=> 'DCS']);
    }
}
