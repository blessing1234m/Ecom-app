<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Confirmation de commande - {{ $order->order_number }}</title>
    <style>
        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            font-size: 12px;
            line-height: 1.4;
            color: #333;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #3b82f6;
            padding-bottom: 20px;
        }
        .header h1 {
            color: #3b82f6;
            margin: 0;
            font-size: 24px;
        }
        .header p {
            margin: 5px 0;
            color: #666;
        }
        .section {
            margin-bottom: 25px;
        }
        .section-title {
            background-color: #f8fafc;
            padding: 8px 12px;
            border-left: 4px solid #3b82f6;
            margin-bottom: 15px;
            font-weight: bold;
            color: #1e293b;
        }
        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }
        .info-item {
            margin-bottom: 8px;
        }
        .info-label {
            font-weight: bold;
            color: #64748b;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin: 15px 0;
        }
        .table th {
            background-color: #f1f5f9;
            padding: 10px;
            text-align: left;
            border: 1px solid #e2e8f0;
            font-weight: bold;
        }
        .table td {
            padding: 10px;
            border: 1px solid #e2e8f0;
        }
        .table .text-right {
            text-align: right;
        }
        .table .text-center {
            text-align: center;
        }
        .totals {
            width: 300px;
            margin-left: auto;
            margin-top: 20px;
        }
        .total-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid #e2e8f0;
        }
        .total-row.final {
            font-weight: bold;
            font-size: 14px;
            border-top: 2px solid #3b82f6;
            border-bottom: none;
            margin-top: 5px;
            padding-top: 12px;
        }
        .status-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: bold;
            text-transform: uppercase;
        }
        .status-pending { background-color: #fef3c7; color: #92400e; }
        .status-confirmed { background-color: #dbeafe; color: #1e40af; }
        .status-processing { background-color: #e0e7ff; color: #3730a3; }
        .status-shipped { background-color: #ede9fe; color: #5b21b6; }
        .status-delivered { background-color: #d1fae5; color: #065f46; }
        .status-cancelled { background-color: #fee2e2; color: #991b1b; }
        .footer {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #e2e8f0;
            text-align: center;
            color: #64748b;
            font-size: 11px;
        }
        .logo {
            text-align: center;
            margin-bottom: 10px;
        }
        .logo-text {
            font-size: 18px;
            font-weight: bold;
            color: #3b82f6;
        }
    </style>
</head>
<body>
    <div class="logo">
        <div class="logo-text">Ecom-App</div>
        <div style="font-size: 10px; color: #64748b;">Votre boutique en ligne de confiance</div>
    </div>

    <div class="header">
        <h1>CONFIRMATION DE COMMANDE</h1>
        <p>Numéro de commande: <strong>{{ $order->order_number }}</strong></p>
        <p>Date de commande: <strong>{{ $order->created_at->format('d/m/Y à H:i') }}</strong></p>
    </div>

    <!-- Informations de commande -->
    <div class="section">
        <div class="section-title">Informations de la commande</div>
        <div class="info-grid">
            <div>
                <div class="info-item">
                    <span class="info-label">Numéro de commande:</span> {{ $order->order_number }}
                </div>
                <div class="info-item">
                    <span class="info-label">Date:</span> {{ $order->created_at->format('d/m/Y') }}
                </div>
                <div class="info-item">
                    <span class="info-label">Heure:</span> {{ $order->created_at->format('H:i') }}
                </div>
                <div class="info-item">
                    <span class="info-label">Statut:</span>
                    <span class="status-badge status-{{ $order->status }}">
                        @switch($order->status)
                            @case('pending') En attente @break
                            @case('confirmed') Confirmée @break
                            @case('processing') En traitement @break
                            @case('shipped') Expédiée @break
                            @case('delivered') Livrée @break
                            @case('cancelled') Annulée @break
                        @endswitch
                    </span>
                </div>
            </div>
            <div>
                <div class="info-item">
                    <span class="info-label">Mode de paiement:</span> Paiement à la livraison
                </div>
                <div class="info-item">
                    <span class="info-label">Mode de livraison:</span> Livraison standard
                </div>
            </div>
        </div>
    </div>

    <!-- Informations client -->
    <div class="section">
        <div class="section-title">Informations client</div>
        <div class="info-grid">
            <div>
                <div class="info-item">
                    <span class="info-label">Nom complet:</span> {{ $order->customer_name }}
                </div>
                @if($order->customer_email)
                <div class="info-item">
                    <span class="info-label">Email:</span> {{ $order->customer_email }}
                </div>
                @endif
                <div class="info-item">
                    <span class="info-label">Téléphone:</span> {{ $order->customer_phone }}
                </div>
            </div>
            <div>
                <div class="info-item">
                    <span class="info-label">Adresse de livraison:</span><br>
                    {{ nl2br($order->customer_address) }}
                </div>
            </div>
        </div>
    </div>

    <!-- Articles commandés -->
    <div class="section">
        <div class="section-title">Articles commandés</div>
        <table class="table">
            <thead>
                <tr>
                    <th>Produit</th>
                    <th class="text-center">Quantité</th>
                    <th class="text-right">Prix unitaire</th>
                    <th class="text-right">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->items as $item)
                <tr>
                    <td>{{ $item->product->name }}</td>
                    <td class="text-center">{{ $item->quantity }}</td>
                    <td class="text-right">{{ number_format($item->unit_price, 0, ',', ' ') }} FCFA</td>
                    <td class="text-right">{{ number_format($item->total_price, 0, ',', ' ') }} FCFA</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Totaux -->
    <div class="section">
        <div class="section-title">Récapitulatif</div>
        <div class="totals">
            <div class="total-row">
                <span>Sous-total:</span>
                <span>{{ number_format($order->subtotal, 0, ',', ' ') }} FCFA</span>
            </div>
            <div class="total-row">
                <span>Frais de livraison:</span>
                <span>{{ number_format($order->shipping, 0, ',', ' ') }} FCFA</span>
            </div>
            <div class="total-row final">
                <span>Total général:</span>
                <span>{{ number_format($order->total_amount, 0, ',', ' ') }} FCFA</span>
            </div>
        </div>
    </div>

    <!-- Notes -->
    @if($order->notes)
    <div class="section">
        <div class="section-title">Notes supplémentaires</div>
        <div style="background-color: #f8fafc; padding: 15px; border-radius: 4px;">
            {{ nl2br($order->notes) }}
        </div>
    </div>
    @endif

    <!-- Instructions -->
    <div class="section">
        <div class="section-title">Informations importantes</div>
        <div style="background-color: #f0f9ff; padding: 15px; border-radius: 4px; border-left: 4px solid #0ea5e9;">
            <p><strong>Paiement:</strong> Le paiement s'effectue en espèces à la livraison.</p>
            <p><strong>Livraison:</strong> Vous serez contacté au numéro fourni pour confirmer la livraison.</p>
            <p><strong>Délai:</strong> Livraison sous 1 à 3 jours ouvrables.</p>
            <p><strong>Contact:</strong> Pour toute question, contactez-nous au +228 XX XX XX XX</p>
        </div>
    </div>

    <div class="footer">
        <p>Ecom-App - {{ config('app.url') }}</p>
        <p>Ce document est une confirmation de votre commande et fait foi de preuve d'achat.</p>
        <p>Généré le {{ now()->format('d/m/Y à H:i') }}</p>
    </div>
</body>
</html>
