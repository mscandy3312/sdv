<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    public function run()
    {
        $suppliers = [
            [
                'name' => 'TechCorp Solutions',
                'Legal Compliance' => 'Certificación ISO 9001, Licencias comerciales actualizadas',
                'General Supplier Profile' => 'Proveedor líder en soluciones tecnológicas con más de 10 años de experiencia',
                'Price' => 50000,
                'Technical Capability' => 'Equipo especializado en desarrollo de software y soporte técnico',
                'Technology and Infrastructure' => 'Data center propio, Infraestructura cloud, Sistemas redundantes',
                'Performance and Service Level' => 'SLA 99.9% uptime, Soporte 24/7, Tiempo de respuesta < 1 hora'
            ],
            [
                'name' => 'Industrial Supplies SA',
                'Legal Compliance' => 'Certificaciones de seguridad industrial, Permisos ambientales vigentes',
                'General Supplier Profile' => 'Distribuidor mayorista de equipos y materiales industriales',
                'Price' => 75000,
                'Technical Capability' => 'Personal certificado, Laboratorio de pruebas propio',
                'Technology and Infrastructure' => 'Almacenes automatizados, Sistema de gestión de inventario',
                'Performance and Service Level' => 'Entrega en 48 horas, Garantía de 2 años en productos'
            ],
            [
                'name' => 'LogisTrade Express',
                'Legal Compliance' => 'Licencias de transporte, Seguros de carga actualizados',
                'General Supplier Profile' => 'Empresa especializada en logística y distribución nacional',
                'Price' => 35000,
                'Technical Capability' => 'Flota propia de vehículos, Sistema GPS de seguimiento',
                'Technology and Infrastructure' => 'Centros de distribución en principales ciudades, Software de ruteo',
                'Performance and Service Level' => 'Entregas programadas, Rastreo en tiempo real, 98% entregas a tiempo'
            ]
        ];

        foreach ($suppliers as $supplier) {
            Supplier::create($supplier);
        }
    }
} 