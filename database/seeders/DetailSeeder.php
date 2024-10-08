<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $details = ['Alarma','Amoblado', 'Ascensor',
                    'Balcón','Baño Auxiliar','Baño de Servicio','Bar',
                    'Calefacción', 'Cancha de Tennis','Cancha Deportiva','Chimenea','CCTV','Cocina', 'Comedor',
                    'Citofono', 'Cocina Integral', 'Cocina Semi Integral','Cocina Tipo Americano','Cocina Tradicional',
                    'Condominio','Conjunto Cerrado','Cuarto de Conductores', 'Cuarto de Servicios',
                    'Deposito Bodega','Despensa',
                    'Estudio','Estufa','Estractor',
                    'Fuente de Agua',
                    'Garaje Parqueadero', 'Gas Natural', 'Gimnasio',
                    'Hall de Alcobas','Horno',
                    'Jardín', 'Jaula de Golf',
                    'Lavandero','Lavadora','Lavaplatos',
                    'Nevera',
                    'Parqueadero de Visitantes', 'Permite Mascotas', 'Piscina','Piso en Baldosin',
                    'Piso en Baldoza', 'Piso en Ceramica', 'Piso en Granito', 'Piso en Marmol',
                    'Piso Entapetado', 'Piso en Porcelanato', 'Porteria Vigilancia','Proyecto',
                    'Recepción','Remodelado',
                    'Sabana','Sala','Sala de Estar','Sala de Internet','Sala de Juegos','Sala de Reuniones','Sala-Comedor',
                    'Salón Comunal','Salón de Conferencias','Sauna Turco Jacuzzi',
                    'Techo de Drywall','Techo de Eternit','Techo de Machimbre','Techo de Yeso o Acabado','Terraza',
                    'Vista Panoramica','Vivienda Bifamiliar','Vivienda Multifamiliar',
                    'Zona de BBQ','Zona de Lavanderia','Zona Social','Zonas Verdes'
        ];

        foreach ($details as $detail) {
            \App\Models\Detail::create([
                'name' => $detail,
                'slug' => \Str::slug($detail),
                'is_active' => true,
            ]);
        }
    }
}
