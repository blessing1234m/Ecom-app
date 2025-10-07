@extends('layouts.app')

@section('title', 'Accueil - Ecom-App')

@section('content')
    <!-- Bannière Slideshow centrée et limitée en largeur -->
    <section class="relative h-[400px] overflow-hidden max-w-7xl mx-auto my-8 rounded-xl shadow-lg border-4 ">
        <div class="swiper banner-swiper h-full">
            <div class="swiper-wrapper">
                @foreach ($banners as $banner)
                    <div class="swiper-slide h-[400px] relative">
                        @if ($banner->image)
                            <img src="{{ Storage::url($banner->image) }}"
                                 alt="{{ $banner->title }}"
                                 class="absolute inset-0 w-full h-full object-cover object-center z-0" />
                        @else
                            <div class="absolute inset-0 bg-gray-200"></div>
                        @endif
                        <div class="absolute inset-0 bg-black bg-opacity-40 z-10"></div>
                        <div class="absolute inset-0 flex flex-col items-center justify-center z-20 px-4">
                            <div class="text-center text-white max-w-2xl mx-auto">
                                <h1 class="text-4xl font-bold mb-4">{{ $banner->title }}</h1>
                                <p class="text-lg mb-6">{{ $banner->description }}</p>
                                @if ($banner->button_text)
                                    <a href="{{ $banner->button_link }}"
                                       class="inline-block bg-primary-600 text-white px-6 py-3 rounded-lg hover:bg-primary-700 transition mx-auto">
                                        {{ $banner->button_text }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="swiper-pagination"></div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </section>

    <!-- Catégories -->
    <section class="container mx-auto px-4 py-12">
        {{-- <h2 class="text-3xl font-bold text-center mb-8 ">Catégories</h2> --}}
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            @foreach ($categories as $category)
                <a href="{{ route('products.index', ['category' => $category->slug]) }}"
                    class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition group">
                    <div class="h-32 bg-gray-200 flex items-center justify-center group-hover:bg-gray-300 transition">
                        @if ($category->image)
                            <img src="{{ Storage::url($category->image) }}" alt="{{ $category->name }}"
                                class="h-full w-full object-cover">
                        @else
                            <span class="text-gray-500">{{ $category->name }}</span>
                        @endif
                    </div>
                    <div class="p-4 text-center">
                        <h3 class="font-semibold text-gray-800">{{ $category->name }}</h3>
                        <p class="text-sm text-gray-600 mt-1">{{ $category->products_count }} produits</p>
                    </div>
                </a>
            @endforeach
        </div>
    </section>

    <!-- Produits Populaires -->
    <section class="container mx-auto px-4 py-12 bg-gray-50">
        <h2 class="text-3xl font-bold text-center mb-8">Produits Populaires</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach ($featuredProducts as $product)
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
                    <div class="relative">
                        <div class="h-48 bg-gray-200 flex items-center justify-center">
                            @if ($product->image)
                                <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}"
                                    class="h-full w-full object-cover">
                            @else
                                <span class="text-gray-500">Image non disponible</span>
                            @endif
                        </div>
                        @if ($product->has_discount)
                            <span class="absolute top-2 right-2 bg-red-500 text-white px-2 py-1 text-xs rounded">
                                -{{ $product->discount_percentage }}%
                            </span>
                        @endif
                    </div>
                    <div class="p-4">
                        <h3 class="text-lg font-semibold mb-2">
                            <a href="{{ route('products.show', $product->slug) }}"
                                class="hover:text-primary-600 transition">
                                {{ $product->name }}
                            </a>
                        </h3>
                        <p class="text-gray-600 text-sm mb-4 line-clamp-2">{{ Str::limit($product->description, 80) }}</p>
                        <div class="flex justify-between items-center">
                            <div class="flex items-center space-x-2">
                                <span class="text-primary-600 font-bold">{{ number_format($product->price, 0, ',', ' ') }}
                                    FCFA</span>
                                @if ($product->has_discount)
                                    <span
                                        class="text-gray-400 text-sm line-through">{{ number_format($product->compare_price, 0, ',', ' ') }}
                                        FCFA</span>
                                @endif
                            </div>
                            @include('components.add-to-cart-button', [
                                'productId' => $product->id,
                                'class' =>
                                    'bg-primary-500 text-white px-4 py-2 rounded hover:bg-primary-600 transition',
                                'text' => 'Ajouter',
                            ])
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="text-center mt-8">
            <a href="{{ route('products.index') }}"
                class="inline-block bg-gray-800 text-white px-6 py-3 rounded-lg hover:bg-gray-700 transition">
                Voir tous les produits
            </a>
        </div>
        {{-- ... le code existant des bannières, catégories et produits populaires ... --}}

<!-- Section FAQ -->
@if($faqs->count() > 0)
<section class="container mx-auto px-4 py-16">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-start">
        <!-- Colonne gauche : Titre et bouton -->
        <div>
            <h2 class="text-3xl font-bold text-orange-500 mb-4">FAQ</h2>
            <h3 class="text-4xl font-bold text-gray-900 mb-6">Vous avez une question?<br>nous avons la réponse</h3>
            <p class="text-lg text-gray-700 mb-8">
                Nous savons que vous avez des question pertinentes concernant nos produits et services, pour cela nous avons pioché pour vous les plus essentielles pour vous, ou sinon vous pourrez toujours nous envoyer la vôtre par courriel.
            </p>
            {{-- <a href="mailto:contact@ecom-app.tg"
               class="inline-flex items-center justify-center px-8 py-4 bg-orange-500 text-white text-xl font-semibold rounded-lg hover:bg-orange-600 transition">
                Nous écrire
                <svg class="w-6 h-6 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
            </a> --}}
        </div>
        <!-- Colonne droite : FAQ -->
        <div class="bg-white rounded-xl border border-primary p-8">
            @foreach($faqs as $index => $faq)
                <div class="mb-6">
                    <button class="w-full text-left flex justify-between items-center text-lg font-medium text-primary focus:outline-none faq-question"
                            data-faq-index="{{ $index }}">
                        <span>{{ $faq->question }}</span>
                        <svg class="w-6 h-6 text-gray-500 transition-transform faq-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div class="faq-answer text-gray-500 mt-2 hidden">
                        {{ $faq->answer }}
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

@push('styles')
<style>
    .faq-item {
        transition: all 0.3s ease;
    }

    .faq-item:hover {
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    }

    .faq-question {
        transition: background-color 0.2s ease;
    }

    .faq-answer {
        animation: fadeIn 0.3s ease-in-out;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>
@endpush

@push('scripts')
<script>
    // FAQ Accordion functionality
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.faq-question').forEach(btn => {
            btn.addEventListener('click', function() {
                const answer = this.parentElement.querySelector('.faq-answer');
                const icon = this.querySelector('.faq-icon');
                const isOpen = !answer.classList.contains('hidden');

                // Ferme toutes les réponses
                document.querySelectorAll('.faq-answer').forEach(a => a.classList.add('hidden'));
                document.querySelectorAll('.faq-icon').forEach(i => i.classList.remove('rotate-180'));

                // Si déjà ouvert, on ferme (donc rien à faire)
                // Sinon, on ouvre celui cliqué
                if (!isOpen) {
                    answer.classList.remove('hidden');
                    icon.classList.add('rotate-180');
                }
            });
        });

        // Open first FAQ by default
        if (faqQuestions.length > 0) {
            faqQuestions[0].click();
        }
    });

    // Smooth scroll to FAQ section
    function scrollToFAQ() {
        const faqSection = document.getElementById('faq-accordion');
        if (faqSection) {
            faqSection.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    }
</script>
@endpush
    </section>
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <script>
        // Swiper initialization for the banner
        document.addEventListener('DOMContentLoaded', function () {
            new Swiper('.banner-swiper', {
                loop: true,
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                autoplay: {
                    delay: 4000,
                    disableOnInteraction: false,
                },
            });
        });

        // Add to cart functionality
        document.querySelectorAll('.add-to-cart').forEach(button => {
            button.addEventListener('click', function() {
                const productId = this.dataset.productId;

                fetch('{{ route('cart.add') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            product_id: productId,
                            quantity: 1
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            updateCartCount();
                            showNotification('Produit ajouté au panier !', 'success');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        showNotification('Erreur lors de l\'ajout au panier', 'error');
                    });
            });
        });

        function showNotification(message, type = 'info') {
            // Create notification element
            const notification = document.createElement('div');
            notification.className = `fixed top-4 right-4 z-50 p-4 rounded-lg shadow-lg text-white ${
            type === 'success' ? 'bg-green-500' : type === 'error' ? 'bg-red-500' : 'bg-blue-500'
        }`;
            notification.textContent = message;

            document.body.appendChild(notification);

            // Remove after 3 seconds
            setTimeout(() => {
                notification.remove();
            }, 3000);
        }
    </script>
@endpush
