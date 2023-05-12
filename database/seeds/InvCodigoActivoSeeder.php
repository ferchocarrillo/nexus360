<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InvCodigoActivoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('inv_codigo_activo')->truncate();

DB::table('inv_codigo_activo')->insert(['articulo'=> 'Diadema','codigo'=> 'DM']);
DB::table('inv_codigo_activo')->insert(['articulo'=> 'Web Cam','codigo'=> 'CM']);
DB::table('inv_codigo_activo')->insert(['articulo'=> 'Pantalla','codigo'=> 'PT']);
DB::table('inv_codigo_activo')->insert(['articulo'=> 'Cpu','codigo'=> 'CPU']);
DB::table('inv_codigo_activo')->insert(['articulo'=> 'Todo En Uno - Cpu','codigo'=> 'AIO']);
DB::table('inv_codigo_activo')->insert(['articulo'=> 'Laptops','codigo'=> 'LTP']);
DB::table('inv_codigo_activo')->insert(['articulo'=> 'Base Refrigerante Laptop','codigo'=> 'BR']);
DB::table('inv_codigo_activo')->insert(['articulo'=> 'Brazos Soportes','codigo'=> 'BS']);
DB::table('inv_codigo_activo')->insert(['articulo'=> 'Televisor','codigo'=> 'TV']);
DB::table('inv_codigo_activo')->insert(['articulo'=> 'Muebles Y Enseres','codigo'=> 'ME']);
DB::table('inv_codigo_activo')->insert(['articulo'=> 'Sillas','codigo'=> 'SL']);
DB::table('inv_codigo_activo')->insert(['articulo'=> 'Nevera','codigo'=> 'NV']);
DB::table('inv_codigo_activo')->insert(['articulo'=> 'Cafetera','codigo'=> 'CF']);
DB::table('inv_codigo_activo')->insert(['articulo'=> 'Equipo De Servicio','codigo'=> 'HM']);
DB::table('inv_codigo_activo')->insert(['articulo'=> 'Huelleros','codigo'=> 'HE']);
DB::table('inv_codigo_activo')->insert(['articulo'=> 'Ventilador De Torre / Aire Acondicionador ','codigo'=> 'VT']);
DB::table('inv_codigo_activo')->insert(['articulo'=> 'Impresora','codigo'=> 'IP']);
DB::table('inv_codigo_activo')->insert(['articulo'=> 'Teléfonos','codigo'=> 'TEL']);
DB::table('inv_codigo_activo')->insert(['articulo'=> 'Routers Wifi','codigo'=> 'RS']);
DB::table('inv_codigo_activo')->insert(['articulo'=> 'Playstation ','codigo'=> 'PYL']);
DB::table('inv_codigo_activo')->insert(['articulo'=> 'Pach Panel','codigo'=> 'PP']);
DB::table('inv_codigo_activo')->insert(['articulo'=> 'Ups','codigo'=> 'UPS']);
DB::table('inv_codigo_activo')->insert(['articulo'=> 'Drone','codigo'=> 'DR']);
DB::table('inv_codigo_activo')->insert(['articulo'=> 'Tripode','codigo'=> 'TD']);
DB::table('inv_codigo_activo')->insert(['articulo'=> 'Flash','codigo'=> 'FD']);
DB::table('inv_codigo_activo')->insert(['articulo'=> 'Lente Y Adaptador','codigo'=> 'LTC']);
DB::table('inv_codigo_activo')->insert(['articulo'=> 'Micrófono','codigo'=> 'MF']);
DB::table('inv_codigo_activo')->insert(['articulo'=> 'Internet Cable','codigo'=> 'CIN']);
DB::table('inv_codigo_activo')->insert(['articulo'=> 'Vga Cable','codigo'=> 'CVG']);
DB::table('inv_codigo_activo')->insert(['articulo'=> 'Dvi Cable','codigo'=> 'CVI']);
DB::table('inv_codigo_activo')->insert(['articulo'=> 'Power Cable/Poder','codigo'=> 'CPO']);
DB::table('inv_codigo_activo')->insert(['articulo'=> 'Hdmi Cable','codigo'=> 'CHD']);
DB::table('inv_codigo_activo')->insert(['articulo'=> 'Displayport Cable ','codigo'=> 'CDP']);
DB::table('inv_codigo_activo')->insert(['articulo'=> 'Adaptador Hdmi A Vga','codigo'=> 'AHV']);
DB::table('inv_codigo_activo')->insert(['articulo'=> 'Adaptador Vga A Dvi','codigo'=> 'AVV']);
DB::table('inv_codigo_activo')->insert(['articulo'=> 'Adaptador Vga A Usb','codigo'=> 'AUV']);
DB::table('inv_codigo_activo')->insert(['articulo'=> 'Adaptador Vga A Displayport ','codigo'=> 'ADV']);
DB::table('inv_codigo_activo')->insert(['articulo'=> 'Adaptador Dvi A Displayport','codigo'=> 'AVD']);
DB::table('inv_codigo_activo')->insert(['articulo'=> 'Convertidores Dvi Macho A Vga ','codigo'=> 'CVM']);
DB::table('inv_codigo_activo')->insert(['articulo'=> 'Convertidores Dvi Hermbra A Vga ','codigo'=> 'CVH']);
DB::table('inv_codigo_activo')->insert(['articulo'=> 'Mouse/Ratón','codigo'=> 'MSE']);
DB::table('inv_codigo_activo')->insert(['articulo'=> 'Keyboard/Teclado','codigo'=> 'TCL']);
DB::table('inv_codigo_activo')->insert(['articulo'=> 'Fan/Ventilador','codigo'=> 'FAN']);
DB::table('inv_codigo_activo')->insert(['articulo'=> 'Discos Duro Mecanico Laptops/Portatil','codigo'=> 'DLM']);
DB::table('inv_codigo_activo')->insert(['articulo'=> 'Discos Duro Estado Solido Laptops/Portatil','codigo'=> 'DLS']);
DB::table('inv_codigo_activo')->insert(['articulo'=> 'Discos Duro Cpu Mecanico','codigo'=> 'DCM']);
DB::table('inv_codigo_activo')->insert(['articulo'=> 'Discos Duro Cpu Estado Solido','codigo'=> 'DCS']);
    }
}
