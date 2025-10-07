<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        Schema::create('faqs', function (Blueprint $table) {
            $table->id();
            $table->string('question');
            $table->text('answer');
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Données par défaut
        DB::table('faqs')->insert([
            [
                'question' => 'Comment passer une commande ?',
                'answer' => 'Pour passer une commande, parcourez nos produits, ajoutez les articles souhaités à votre panier, puis procédez au checkout. Remplissez vos informations de livraison et confirmez la commande.',
                'order' => 1,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question' => 'Quels sont les modes de paiement acceptés ?',
                'answer' => 'Nous acceptons uniquement le paiement en espèces à la livraison pour le moment. Vous payez lorsque vous recevez votre commande.',
                'order' => 2,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question' => 'Quels sont les délais de livraison ?',
                'answer' => 'Les délais de livraison sont de 1 à 3 jours ouvrables après confirmation de votre commande. Nous vous contacterons par téléphone pour coordonner la livraison.',
                'order' => 3,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question' => 'Puis-je modifier ou annuler ma commande ?',
                'answer' => 'Vous pouvez modifier ou annuler votre commande dans les 2 heures suivant sa passation. Contactez-nous directement par téléphone pour toute modification.',
                'order' => 4,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question' => 'Que faire si je ne suis pas satisfait de mon achat ?',
                'answer' => 'Votre satisfaction est notre priorité. En cas de problème avec votre commande, contactez-nous dans les 48 heures suivant la livraison pour une solution.',
                'order' => 5,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('faqs');
    }
};
