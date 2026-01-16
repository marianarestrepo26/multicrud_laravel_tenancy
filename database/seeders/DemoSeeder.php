<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Tenant;
use App\Models\Product;
use Illuminate\Support\Facades\Hash;

class DemoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Create Central Admin
        if (!User::where('email', 'admin@central.com')->exists()) {
            User::create([
                'name' => 'Super Admin',
                'email' => 'admin@central.com',
                'password' => Hash::make('password'),
            ]);
            $this->command->info('Central Admin created: admin@central.com / password');
        }

        // 2. Tenants Data
        $tenants = [
            [
                'id' => 'cocina',
                'name' => 'Todo Cocina',
                'type' => 'cocina',
                'products' => [
                    ['name' => 'Juego de Sartenes', 'price' => 45.99, 'description' => 'Sartenes antiadherentes de alta calidad.'],
                    ['name' => 'Licuadora Potente', 'price' => 89.50, 'description' => 'Licuadora de 10 velocidades.'],
                    ['name' => 'Juego de Cuchillos', 'price' => 25.00, 'description' => 'Acero inoxidable profesional.'],
                ]
            ],
            [
                'id' => 'ferreteria',
                'name' => 'Ferretería El Tornillo',
                'type' => 'ferreteria',
                'products' => [
                    ['name' => 'Taladro Percutor', 'price' => 120.00, 'description' => 'Taladro profesional 700W.'],
                    ['name' => 'Juego de Destornilladores', 'price' => 15.00, 'description' => 'Punta magnética.'],
                    ['name' => 'Martillo', 'price' => 8.50, 'description' => 'Mango de madera.'],
                ]
            ],
            [
                'id' => 'joyeria',
                'name' => 'Joyería Elegance',
                'type' => 'joyeria',
                'products' => [
                    ['name' => 'Anillo de Oro', 'price' => 250.00, 'description' => 'Oro de 18 kilates.'],
                    ['name' => 'Collar de Perlas', 'price' => 180.00, 'description' => 'Perlas cultivadas.'],
                    ['name' => 'Reloj de Lujo', 'price' => 500.00, 'description' => 'Cronógrafo automático.'],
                ]
            ],
            [
                'id' => 'gamer',
                'name' => 'Gamer Zone',
                'type' => 'gamer',
                'products' => [
                    ['name' => 'Teclado Mecánico', 'price' => 85.00, 'description' => 'RGB Switches Blue.'],
                    ['name' => 'Mouse Gaming', 'price' => 45.00, 'description' => 'Sensor óptico 16000 DPI.'],
                    ['name' => 'Silla Gamer', 'price' => 200.00, 'description' => 'Ergonómica y reclinable.'],
                ]
            ],
            [
                'id' => 'papeleria',
                'name' => 'Papelería Creativa',
                'type' => 'papeleria',
                'products' => [
                    ['name' => 'Cuaderno Premium', 'price' => 12.00, 'description' => 'Hojas de 90g, tapa dura.'],
                    ['name' => 'Set de Plumas', 'price' => 8.00, 'description' => 'Tinta gel de colores.'],
                    ['name' => 'Organizador de Escritorio', 'price' => 15.00, 'description' => 'Madera bambú.'],
                ]
            ],
        ];

        foreach ($tenants as $data) {
            $tenantId = $data['id'];

            // Create or update tenant
            $tenant = Tenant::find($tenantId);
            if (!$tenant) {
                $tenant = Tenant::create([
                    'id' => $tenantId,
                    'name' => $data['name'],
                    'type' => $data['type'],
                ]);
                $tenant->domains()->create(['domain' => $tenantId . '.localhost']);
                $this->command->info("Tenant created: {$data['name']} ({$tenantId}.localhost)");
            }

            // Seed tenant data
            $tenant->run(function () use ($data, $tenantId) {
                // Admin User
                if (!User::where('email', "admin@{$tenantId}.com")->exists()) {
                    User::create([
                        'name' => 'Admin ' . $data['name'],
                        'email' => "admin@{$tenantId}.com",
                        'password' => Hash::make('password'),
                    ]);
                }

                // Products
                foreach ($data['products'] as $prodData) {
                    if (!Product::where('name', $prodData['name'])->exists()) {
                        Product::create($prodData);
                    }
                }
            });
        }
    }
}
