<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Response;

class OrderPdfController extends Controller
{
    public function download(Order $order): Response
    {
        // Vérifier que la commande appartient bien au client (dans un vrai système avec auth)
        // Pour l'instant, nous autorisons le téléchargement sans authentification

        $order->load('items.product');

        $pdf = Pdf::loadView('front.orders.pdf', compact('order'));

        return $pdf->download("commande-{$order->order_number}.pdf");
    }

    public function view(Order $order): Response
    {
        $order->load('items.product');

        $pdf = Pdf::loadView('front.orders.pdf', compact('order'));

        return $pdf->stream("commande-{$order->order_number}.pdf");
    }
}
