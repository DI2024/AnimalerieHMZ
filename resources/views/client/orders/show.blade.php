@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-12">
    <div class="max-w-[1280px] mx-auto px-6">
        
        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
            <div>
                <h1 class="text-2xl md:text-4xl font-bold text-blue-600 mb-2 break-all">
                    {{ $order->order_number }}
                </h1>
                <p class="text-gray-600 text-sm">
                    Commandé le {{ $order->created_at->format('d/m/Y à H:i') }}
                </p>
            </div>
            <a href="{{ route('orders.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2.5 px-5 rounded-lg transition flex items-center justify-center gap-2 self-start sm:self-auto w-full sm:w-auto">
                <span class="material-symbols-outlined text-lg">arrow_back</span>
                Retour
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- Left: Order Details -->
            <div class="lg:col-span-2 space-y-6">
                
                <!-- Status Card -->
                <div class="bg-white rounded-xl p-4 md:p-6 border border-gray-200 shadow-sm">
                    <h2 class="font-semibold text-xl mb-4 text-gray-900">Statut de la commande</h2>
                    <div class="flex items-center gap-4">
                        <span class="inline-block px-5 py-2.5 rounded-full text-base md:text-lg font-semibold bg-{{ $order->status_color }}/10 text-{{ $order->status_color }}">
                            {{ $order->status_label }}
                        </span>
                    </div>
                </div>

                <!-- Order Items -->
                <div class="bg-white rounded-xl p-4 md:p-6 border border-gray-200 shadow-sm">
                    <h2 class="font-semibold text-xl mb-6 text-gray-900">Articles commandés</h2>
                    <div class="space-y-4">
                        @foreach($order->items as $item)
                            @php
                                $imageUrl = $item->product_image && str_starts_with($item->product_image, 'http') 
                                    ? $item->product_image 
                                    : asset($item->product_image);
                            @endphp
                            <div class="bg-gray-50 rounded-xl overflow-hidden border border-gray-200">
                                <!-- Product Row -->
                                <div class="flex flex-col sm:flex-row sm:items-center gap-4 p-4">
                                    <div class="flex items-center gap-4 w-full sm:w-auto">
                                        <img src="{{ $imageUrl }}" 
                                             alt="{{ $item->product_name }}" 
                                             class="w-16 h-16 sm:w-20 sm:h-20 object-contain rounded-lg bg-white p-1 flex-shrink-0"
                                             onerror="this.src='{{ asset('images/placeholder.svg') }}'">
                                        <div class="flex-1 min-w-0">
                                            <h4 class="font-semibold text-gray-900 text-sm sm:text-base break-words">{{ $item->product_name }}</h4>
                                            @if($item->product_sku)
                                                <p class="text-[10px] sm:text-xs text-gray-500">SKU: {{ $item->product_sku }}</p>
                                            @endif
                                            <p class="text-xs sm:text-sm text-gray-600 mt-1">
                                                {{ number_format($item->price, 2, ',', ' ') }} MAD × {{ $item->quantity }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="flex justify-between items-center sm:block w-full sm:w-auto pt-3 sm:pt-0 border-t border-gray-200 sm:border-none">
                                        <span class="sm:hidden text-xs font-semibold text-gray-500">Sous-total :</span>
                                        <p class="text-base sm:text-xl font-bold text-gray-900 whitespace-nowrap text-right">{{ number_format($item->subtotal, 2, ',', ' ') }} MAD</p>
                                    </div>
                                </div>

                                <!-- Review Accordion (Only if order is delivered and product exists) -->
                                @if($order->status === 'delivered' && $item->product)
                                    @php
                                        $existingReview = \App\Models\Review::where('user_id', auth()->id())
                                            ->where('product_id', $item->product_id)
                                            ->where('order_id', $order->id)
                                            ->first();
                                    @endphp
                                    <div class="border-t border-gray-200">
                                        <button onclick="toggleReviewAccordion({{ $item->id }})" class="w-full px-4 py-3 bg-gray-100/50 hover:bg-gray-100 flex items-center justify-between text-sm font-semibold text-[#003e87] transition-colors focus:outline-none">
                                            <span class="flex items-center gap-2">
                                                <span class="material-symbols-outlined text-lg">rate_review</span>
                                                {{ $existingReview ? 'Votre avis sur ce produit' : 'Donner votre avis sur ce produit' }}
                                            </span>
                                            <span class="material-symbols-outlined transition-transform duration-200" id="accordion-icon-{{ $item->id }}">
                                                expand_more
                                            </span>
                                        </button>
                                        
                                        <div id="accordion-content-{{ $item->id }}" class="hidden px-4 py-4 bg-white border-t border-gray-100">
                                            @if($existingReview)
                                                <!-- Existing Review Display -->
                                                <div class="space-y-2">
                                                    <div class="flex items-center gap-2">
                                                        <div class="flex text-amber-400">
                                                            @for($i = 1; $i <= 5; $i++)
                                                                <span class="material-symbols-outlined text-sm {{ $i <= $existingReview->rating ? 'fill-1' : '' }}">star</span>
                                                            @endfor
                                                        </div>
                                                        <span class="text-xs text-gray-500 font-medium">Posté le {{ $existingReview->created_at->format('d/m/Y') }}</span>
                                                    </div>
                                                    <p class="text-gray-700 text-sm italic">"{{ $existingReview->comment }}"</p>
                                                </div>
                                            @else
                                                <!-- Review Form -->
                                                <form action="{{ route('orders.reviews.store', [$order->id, $item->product_id]) }}" method="POST" class="space-y-4">
                                                    @csrf
                                                    
                                                    <!-- Rating Input -->
                                                    <div class="space-y-1">
                                                        <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider">Votre Note :</label>
                                                        <div class="flex gap-1">
                                                            @for($i = 1; $i <= 5; $i++)
                                                                <button type="button" onclick="setRating({{ $item->id }}, {{ $i }})" onmouseover="hoverStars({{ $item->id }}, {{ $i }})" onmouseout="resetStars({{ $item->id }})" class="star-btn-{{ $item->id }} focus:outline-none" data-val="{{ $i }}">
                                                                    <span class="material-symbols-outlined text-2xl text-gray-300 transition-colors duration-200">star</span>
                                                                </button>
                                                            @endfor
                                                        </div>
                                                        <input type="hidden" name="rating" id="rating-input-{{ $item->id }}" value="" required>
                                                    </div>

                                                    <!-- Comment Input -->
                                                    <div class="space-y-1">
                                                        <label for="comment-{{ $item->id }}" class="block text-xs font-bold text-gray-700 uppercase tracking-wider">Votre Commentaire :</label>
                                                        <textarea name="comment" id="comment-{{ $item->id }}" rows="3" required minlength="3" placeholder="Qu'avez-vous pensé de ce produit ?" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-[#003e87] focus:border-transparent"></textarea>
                                                    </div>

                                                    <!-- Submit Button -->
                                                    <button type="submit" class="w-full sm:w-auto px-6 py-2.5 bg-[#003e87] hover:bg-[#0855b1] text-white font-semibold rounded-lg text-sm transition-colors shadow-md hover:shadow-lg">
                                                        Soumettre mon avis
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Customer Notes -->
                @if($order->customer_notes)
                    <div class="bg-blue-50 rounded-xl p-4 md:p-6 border border-blue-200">
                        <h3 class="font-semibold text-lg mb-3 text-blue-900 flex items-center gap-2">
                            <span class="material-symbols-outlined">note</span>
                            Vos notes
                        </h3>
                        <p class="text-blue-800 text-sm">{{ $order->customer_notes }}</p>
                    </div>
                @endif
            </div>

            <!-- Right: Summary & Info -->
            <div class="lg:col-span-1 space-y-6">
                
                <!-- Order Summary -->
                <div class="bg-white rounded-xl p-4 md:p-6 border border-gray-200 shadow-sm sticky top-6">
                    <h2 class="font-semibold text-xl mb-6 text-gray-900">Résumé</h2>
                    
                    <div class="space-y-3 mb-6">
                        <div class="flex justify-between text-gray-600">
                            <span>Sous-total</span>
                            <span>{{ number_format($order->subtotal, 2, ',', ' ') }} MAD</span>
                        </div>
                        <div class="flex justify-between text-gray-600">
                            <span>Livraison</span>
                            @if($order->shipping_cost == 0)
                                <span class="text-green-500 font-semibold">Gratuit</span>
                            @else
                                <span>{{ number_format($order->shipping_cost, 2, ',', ' ') }} MAD</span>
                            @endif
                        </div>
                        <div class="flex justify-between text-gray-600">
                            <span>TVA</span>
                            <span>{{ number_format($order->tax, 2, ',', ' ') }} MAD</span>
                        </div>
                        @if($order->discount > 0)
                            <div class="flex justify-between text-green-500">
                                <span>Réduction</span>
                                <span>-{{ number_format($order->discount, 2, ',', ' ') }} MAD</span>
                            </div>
                        @endif
                    </div>
                    
                    <div class="pt-6 border-t border-gray-200">
                        <div class="flex justify-between items-center">
                            <span class="text-xl font-semibold text-gray-900">Total</span>
                            <span class="text-3xl font-bold text-gray-900">{{ number_format($order->total, 2, ',', ' ') }} MAD</span>
                        </div>
                    </div>
                </div>

                <!-- Shipping Address -->
                <div class="bg-white rounded-xl p-4 md:p-6 border border-gray-200 shadow-sm">
                    <h3 class="font-semibold text-lg mb-4 text-gray-900 flex items-center gap-2">
                        <span class="material-symbols-outlined text-blue-600">local_shipping</span>
                        Livraison
                    </h3>
                    <div class="text-gray-700 space-y-1">
                        <p class="font-semibold text-gray-900">{{ $order->shipping_name }}</p>
                        <p>{{ $order->shipping_address_line_1 }}</p>
                        @if($order->shipping_address_line_2)
                            <p>{{ $order->shipping_address_line_2 }}</p>
                        @endif
                        <p>{{ $order->shipping_postal_code }} {{ $order->shipping_city }}</p>
                        <p>{{ $order->shipping_country }}</p>
                        <p class="mt-3 flex items-center gap-1">
                            <span class="material-symbols-outlined text-sm">phone</span>
                            {{ $order->shipping_phone }}
                        </p>
                        <p class="flex items-center gap-1">
                            <span class="material-symbols-outlined text-sm">email</span>
                            {{ $order->shipping_email }}
                        </p>
                    </div>
                </div>

                <!-- Payment Method -->
                <div class="bg-white rounded-xl p-4 md:p-6 border border-gray-200 shadow-sm">
                    <h3 class="font-semibold text-lg mb-4 text-gray-900 flex items-center gap-2">
                        <span class="material-symbols-outlined text-blue-600">payments</span>
                        Paiement
                    </h3>
                    <p class="text-gray-700">
                        {{ ucfirst(str_replace('_', ' ', $order->payment_method)) }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function toggleReviewAccordion(itemId) {
        const content = document.getElementById('accordion-content-' + itemId);
        const icon = document.getElementById('accordion-icon-' + itemId);
        
        if (content.classList.contains('hidden')) {
            content.classList.remove('hidden');
            icon.style.transform = 'rotate(180deg)';
        } else {
            content.classList.add('hidden');
            icon.style.transform = 'rotate(0deg)';
        }
    }

    // Keep track of the active rating selected for each form
    const selectedRatings = {};

    function setRating(itemId, rating) {
        selectedRatings[itemId] = rating;
        document.getElementById('rating-input-' + itemId).value = rating;
        
        // Highlight active stars
        updateStarsDisplay(itemId, rating);
    }

    function hoverStars(itemId, rating) {
        // Highlight temporarily up to rating
        updateStarsDisplay(itemId, rating);
    }

    function resetStars(itemId) {
        // Reset to currently selected rating (or none)
        const rating = selectedRatings[itemId] || 0;
        updateStarsDisplay(itemId, rating);
    }

    function updateStarsDisplay(itemId, rating) {
        const stars = document.querySelectorAll('.star-btn-' + itemId + ' span');
        stars.forEach((star, idx) => {
            if (idx < rating) {
                star.classList.add('fill-1', 'text-amber-400');
                star.classList.remove('text-gray-300');
            } else {
                star.classList.remove('fill-1', 'text-amber-400');
                star.classList.add('text-gray-300');
            }
        });
    }
</script>
@endsection
