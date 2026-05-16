<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OfferSeeder extends Seeder
{
    public function run(): void
    {
        $offers = [
            [
                'title' => "Jusqu'à 25% de remise",
                'subtitle' => 'Sur toute la gamme Chien',
                'badge' => 'Offre Spéciale',
                'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuAx-idpF478hzoaaBIUHLUhWNsH922i7ik4yZ4LO2wsFxOXaaH0vCZmjypSNPW30ShDtsjn1yqpnEmIm97kK9VU2iG19ZN0Q_Bc01sr9tKItR4y8LpQcFN8bjT3Gitg7YSmWhoFXxNmov5igt9yvFvKOsFHinogyokHHUyUpIb_jSnIM_foyONoR63ppruzz3Kjj8Q09IM4NcqFWBLcnyUiLmE9JLA5fHEoOWGVZ_SAE5fIRWwLEjQDLqOAa20bHz9MgNHftU0xCdA',
                'link' => '/categories/chiens',
                'bg_color' => '#0855b1',
                'is_active' => true,
            ],
            [
                'title' => '-15% sur les Accessoires',
                'subtitle' => 'Pour Chats et Rongeurs',
                'badge' => 'Exclusivité Web',
                'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuAD1AcP45gJpBLS8Tr-pXiMNBhB2iQJSA2af3qaDZ7Y417iW3jYCPMEXodTymh_btgwzlODtmGfx9-9WBkmqrr92jmmOl6Hza6t5TQcw34Wpzi1TDXqjiwXuSGQQifpo2cGqNLGMLJfYc4Aj2c7zH9Fns2agYHMc6JfqKBDoNvaF9nY6Bo7nEr_DfAPkZIxRgoqa0c5x6SpMwoaoUhfwM8UHOGaNy0FYVCh2S0XffBGisL1pEt11w0B4A0aiW25uQwPR5_UGGg2YU4',
                'link' => '/categories/chats',
                'bg_color' => '#4fa5d8',
                'is_active' => true,
            ],
            [
                'title' => 'Pack Bienvenue',
                'subtitle' => 'Offert pour votre 1ère commande',
                'badge' => 'Nouveauté',
                'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBqASyV7URQYtB7AufDQq3zsXl7XSv9FkFZ2rS7cvCY8SjFBpNtd44dmKeXIseCB9VNUADcDBsTZFb6lITNOv2FLAuO2mwJu_CqbbtFdL1nnCHvOh3gcNgP6etzuggSPuFxOHrjFd94gobAlyjJdlEbFYg-J5N8E9XGz90YLgl0NJs0XhBpPwWcq_WERVUX8hBqXIcEE5Wjyp6mSiNEde_o2uE8CHpFJxQr9iCfpJSCMSWgZ8U6B2nbcBOlsTz53qAdUrzB7JupVkA',
                'link' => '/offres',
                'bg_color' => '#ffffff',
                'is_active' => true,
            ],
        ];

        foreach ($offers as $offer) {
            \App\Models\Offer::create($offer);
        }
    }
}
