<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            ['key' => 'contact_email', 'value' => 'contact@animaleriehmz.ma'],
            ['key' => 'contact_phone', 'value' => '+212 626-911209'],
            ['key' => 'footer_description', 'value' => 'Animalerie HMZ - Votre boutique en ligne pour tous vos animaux de compagnie au Maroc.'],
            ['key' => 'footer_copyright', 'value' => '© 2024 Animalerie HMZ. Tous droits réservés.'],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(
                ['key' => $setting['key']],
                ['value' => $setting['value']]
            );
        }
    }
}
