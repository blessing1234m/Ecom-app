@extends('layouts.app')

@section('title', 'Accueil - Ecom-App')

@section('content')
    <!-- Bannière Slideshow avec animation d'entrée -->
    <section class="relative h-[410px] overflow-hidden max-w-7xl mx-auto my-4 rounded-xl shadow-lg border-4 animate-fade-in">
        <div class="swiper banner-swiper h-full">
            <div class="swiper-wrapper">
                @foreach ($banners as $banner)
                    <div class="swiper-slide h-[410px] relative">
                        @if ($banner->image)
                            <img src="{{ Storage::url($banner->image) }}" alt="{{ $banner->title }}"
                                class="absolute inset-0 w-full h-full object-cover z-0 transition-transform duration-700 hover:scale-105" />
                        @else
                            <div class="absolute inset-0 bg-gray-200"></div>
                        @endif
                        <div class="absolute inset-0 bg-black bg-opacity-40 z-10"></div>
                        <div class="absolute inset-0 flex flex-col items-center justify-center z-20 px-4">
                            <div class="text-center text-white max-w-2xl mx-auto transform transition-all duration-1000">
                                <h1 class="text-4xl font-bold mb-4 animate-slide-down">{{ $banner->title }}</h1>
                                <p class="text-lg mb-6 animate-slide-up delay-200">{{ $banner->description }}</p>
                                @if ($banner->button_text)
                                    <a href="{{ $banner->button_link }}"
                                        class="inline-block bg-primary-600 text-white px-6 py-3 rounded-lg hover:bg-primary-700 transition transform hover:scale-105 animate-bounce-in delay-500 mx-auto">
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

    <!-- Catégories avec animation stagger -->
    <section class="container mx-auto px-4 py-2 overflow-hidden">
        <div class="flex flex-wrap justify-center gap-3 py-2">
            @foreach ($categories as $index => $category)
                <a href="{{ route('products.index', ['category' => $category->slug]) }}"
                    class="flex items-center px-4 py-1 bg-green-100 rounded-full text-gray-700 font-medium shadow-sm hover:bg-green-200 transition-all duration-300 hover:scale-105 animate-stagger-item hover:shadow-lg"
                    style="animation-delay: {{ $index * 100 }}ms">
                    {{ $category->name }}
                </a>
            @endforeach
        </div>
    </section>

    <!-- Produits Populaires avec animations avancées -->
    <section class="container mx-auto px-4 py-8 bg-gray-50 overflow-hidden">
        <h2 class="text-3xl font-bold text-center mb-8 animate-fade-in">Produits Populaires</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6">
            @foreach ($featuredProducts as $index => $product)
                <div class="product-card bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-all duration-500 transform hover:-translate-y-3 animate-product-card"
                    style="animation-delay: {{ $index * 100 }}ms" data-product-index="{{ $index }}">
                    <div class="relative overflow-hidden group">
                        <div class="h-48 bg-gray-200 flex items-center justify-center overflow-hidden">
                            @if ($product->image)
                                <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}"
                                    class="h-full w-full object-cover transition-all duration-700 group-hover:scale-110">
                                <!-- Overlay au survol -->
                                <div
                                    class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 transition-all duration-500 flex items-center justify-center">
                                    <div
                                        class="opacity-0 group-hover:opacity-100 transform translate-y-4 group-hover:translate-y-0 transition-all duration-500 delay-200">
                                        <a href="{{ route('products.show', $product->slug) }}"
                                            class="bg-white text-primary-600 px-4 py-2 rounded-lg font-semibold hover:bg-primary-600 hover:text-white transition-colors duration-300">
                                            Voir détails
                                        </a>
                                    </div>
                                </div>
                            @else
                                <span class="text-gray-500">Image non disponible</span>
                            @endif
                        </div>
                        @if ($product->has_discount)
                            <span
                                class="absolute top-2 right-2 bg-red-500 text-white px-2 py-1 text-xs rounded-full animate-pulse shadow-lg">
                                -{{ $product->discount_percentage }}%
                            </span>
                        @endif
                        <!-- Badge Nouveau pour les produits récents -->
                        @if ($product->created_at->gt(now()->subDays(7)))
                            <span
                                class="absolute top-2 left-2 bg-green-500 text-white px-2 py-1 text-xs rounded-full animate-bounce shadow-lg">
                                Nouveau
                            </span>
                        @endif
                    </div>

                    <div class="p-4">
                        <h3 class="text-lg font-semibold mb-2 group">
                            <a href="{{ route('products.show', $product->slug) }}"
                                class="hover:text-primary-600 transition-colors duration-300 relative">
                                {{ $product->name }}
                                <span
                                    class="absolute bottom-0 left-0 w-0 h-0.5 bg-primary-600 group-hover:w-full transition-all duration-300"></span>
                            </a>
                        </h3>

                        <!-- Rating avec animation étoile par étoile -->
                        <div class="flex items-center mb-2">
                            @for ($i = 1; $i <= 5; $i++)
                                <svg class="w-5 h-5 {{ $i <= 5 ? 'text-green-500' : 'text-gray-300' }} transition-all duration-300 hover:scale-125 hover:rotate-12 star-rating"
                                    style="animation-delay: {{ $i * 100 }}ms" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.967a1 1 0 00.95.69h4.175c.969 0 1.371 1.24.588 1.81l-3.38 2.455a1 1 0 00-.364 1.118l1.287 3.966c.3.922-.755 1.688-1.54 1.118l-3.38-2.454a1 1 0 00-1.175 0l-3.38 2.454c-.784.57-1.838-.196-1.54-1.118l1.287-3.966a1 1 0 00-.364-1.118L2.05 9.394c-.783-.57-.38-1.81.588-1.81h4.175a1 1 0 00.95-.69l1.286-3.967z" />
                                </svg>
                            @endfor
                            <span
                                class="ml-2 text-green-700 text-sm font-medium transition-all duration-300 hover:text-green-800 hover:scale-105 stock-indicator"
                                data-stock="{{ $product->stock }}">
                                ({{ $product->stock }})
                            </span>
                        </div>

                        <!-- Description avec effet de révélation -->
                        <p class="text-gray-600 text-sm mb-4 line-clamp-2 transition-all duration-300 hover:text-gray-800 description-trigger cursor-pointer"
                            data-full-description="{{ $product->description }}">
                            {{ Str::limit($product->description, 80) }}
                        </p>

                        <!-- Prix avec animations -->
                        <div class="flex justify-between items-center">
                            <div class="flex items-center space-x-2 price-container">
                                <span
                                    class="text-primary-600 font-bold text-lg transition-all duration-300 hover:scale-105 hover:text-primary-700 current-price">
                                    {{ number_format($product->price, 0, ',', ' ') }} FCFA
                                </span>
                                @if ($product->has_discount)
                                    <span
                                        class="text-gray-400 text-sm line-through transition-all duration-300 hover:line-through-0 original-price">
                                        {{ number_format($product->compare_price, 0, ',', ' ') }} FCFA
                                    </span>
                                @endif
                            </div>

                            <!-- Bouton Ajouter avec animation améliorée -->
                            @include('components.add-to-cart-button', [
                                'productId' => $product->id,
                                'class' =>
                                    'add-to-cart-btn bg-primary-600 text-white px-4 py-2 rounded-lg hover:bg-primary-700 transition-all duration-300 transform hover:scale-110 hover:shadow-xl active:scale-95 group relative overflow-hidden',
                                'text' => 'Ajouter',
                            ])
                        </div>

                        <!-- Indicateur de stock animé -->
                        {{-- <div class="mt-3">
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                @php
                                    $stockPercentage = min(100, ($product->stock / 50) * 100);
                                    $stockColor =
                                        $stockPercentage > 50
                                            ? 'bg-green-500'
                                            : ($stockPercentage > 20
                                                ? 'bg-yellow-500'
                                                : 'bg-red-500');
                                @endphp
                                <div class="h-2 rounded-full {{ $stockColor }} transition-all duration-1000 ease-out stock-bar"
                                    style="width: {{ $stockPercentage }}%" data-stock-percentage="{{ $stockPercentage }}">
                                </div>
                            </div>
                            <div class="flex justify-between text-xs text-gray-500 mt-1">
                                <span>Stock</span>
                                <span class="font-semibold stock-count">{{ $product->stock }} disponible(s)</span>
                            </div>
                        </div> --}}
                    </div>

                    <!-- Effet de brillance au survol -->
                    <div
                        class="absolute inset-0 bg-gradient-to-r from-transparent via-white to-transparent transform -skew-x-12 -translate-x-full group-hover:translate-x-full transition-transform duration-1000 shine-effect">
                    </div>
                </div>
            @endforeach
        </div>

        <div class="text-center mt-12">
            <a href="{{ route('products.index') }}"
                class="inline-block bg-gradient-to-r from-primary-600 to-primary-700 text-white px-8 py-4 rounded-lg hover:from-primary-700 hover:to-primary-800 transition-all duration-500 transform hover:scale-105 hover:shadow-2xl animate-pulse-slow relative overflow-hidden group">
                <span class="relative z-10">Voir tous les produits</span>
                <div
                    class="absolute inset-0 bg-gradient-to-r from-transparent via-white to-transparent transform -skew-x-12 -translate-x-full group-hover:translate-x-full transition-transform duration-1000">
                </div>
            </a>
        </div>
    </section>

    <!-- Section FAQ avec animations améliorées -->
    @if ($faqs->count() > 0)
        <section class="container mx-auto px-4 py-16 overflow-hidden">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-start">
                <!-- Colonne gauche : Titre et bouton -->
                <div class="animate-slide-in-left">
                    <h2 class="text-3xl font-bold text-orange-500 mb-4 animate-bounce">FAQ</h2>
                    <h3 class="text-4xl font-bold text-gray-900 mb-6 animate-typing">Vous avez une question?<br>nous avons
                        la réponse</h3>
                    <p class="text-lg text-gray-700 mb-8 animate-fade-in delay-300">
                        Nous savons que vous avez des questions pertinentes concernant nos produits et services, pour cela
                        nous avons pioché pour vous les plus essentielles pour vous, ou sinon vous pourrez toujours nous
                        envoyer la vôtre par courriel.
                    </p>
                </div>
                <!-- Colonne droite : FAQ -->
                <div class="bg-white rounded-xl border border-primary p-8 animate-slide-in-right">
                    @foreach ($faqs as $index => $faq)
                        <div class="mb-6 transition-all duration-300 hover:bg-gray-50 rounded-lg p-3">
                            <button
                                class="w-full text-left flex justify-between items-center text-lg font-medium text-primary focus:outline-none faq-question transition-all duration-300 hover:text-orange-600"
                                data-faq-index="{{ $index }}">
                                <span class="transition-colors duration-300">{{ $faq->question }}</span>
                                <svg class="w-6 h-6 text-gray-500 transition-all duration-300 faq-icon transform hover:scale-125"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <div class="faq-answer text-gray-500 mt-2 hidden transition-all duration-500 transform">
                                {{ $faq->answer }}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- Témoignages clients avec animations -->
  @if (isset($testimonials) && $testimonials->count())
<section class="container mx-auto px-4 py-12 overflow-hidden">
    <h2 class="text-3xl font-bold text-center mb-8 text-primary-400 animate-fade-in">_TÉMOIGNAGES_</h2>

    <div class="relative">
        <!-- Carousel Container -->
        <div class="swiper testimonials-swiper px-12">
            <div class="swiper-wrapper">
                @foreach ($testimonials as $testimonial)
                    <div class="swiper-slide">
                        <div class="bg-white rounded-xl shadow-lg p-6 flex flex-col items-center text-center transition-all duration-500 transform hover:-translate-y-3 hover:shadow-2xl mx-2">
                            <!-- Photo -->
                            @if ($testimonial->photo)
                                <div class="relative mb-4">
                                    <img src="{{ asset('storage/' . $testimonial->photo) }}" alt="photo"
                                        class="h-20 w-20 rounded-full object-cover border-4 border-primary-100 transition-all duration-500 hover:scale-110 hover:rotate-3">
                                    <div class="absolute -bottom-2 -right-2 w-8 h-8 bg-green-500 rounded-full flex items-center justify-center">
                                        <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    </div>
                                </div>
                            @else
                                <div class="relative mb-4">
                                    <div class="h-20 w-20 rounded-full bg-gradient-to-br from-primary-100 to-primary-200 flex items-center justify-center mb-3 transition-all duration-500 hover:scale-110 hover:rotate-3">
                                        <svg class="w-10 h-10 text-primary-600" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 12c2.7 0 5-2.3 5-5s-2.3-5-5-5-5 2.3-5 5 2.3 5 5 5zm0 2c-3.3 0-10 1.7-10 5v3h20v-3c0-3.3-6.7-5-10-5z"/>
                                        </svg>
                                    </div>
                                    <div class="absolute -bottom-2 -right-2 w-8 h-8 bg-green-500 rounded-full flex items-center justify-center">
                                        <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    </div>
                                </div>
                            @endif

                            <!-- Rating -->
                            <div class="flex items-center justify-center mb-4">
                                @for ($i = 1; $i <= 5; $i++)
                                    <span class="{{ $i <= $testimonial->rating ? 'text-yellow-400' : 'text-gray-300' }} text-xl transition-transform duration-300 hover:scale-125 transform hover:rotate-12">&#9733;</span>
                                @endfor
                            </div>

                            <!-- Message -->
                            <p class="text-gray-700 italic mb-4 transition-colors duration-300 hover:text-gray-900 text-lg leading-relaxed">
                                "{{ $testimonial->message }}"
                            </p>

                            <!-- Name -->
                            <div class="font-semibold text-gray-900 transition-colors duration-300 hover:text-primary-600 text-xl">
                                {{ $testimonial->name }}
                            </div>

                            <!-- Company/Position (si disponible) -->
                            @if($testimonial->company || $testimonial->position)
                                <div class="text-gray-500 text-sm mt-2">
                                    {{ $testimonial->position }}{{ $testimonial->position && $testimonial->company ? ' at ' : '' }}{{ $testimonial->company }}
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Navigation Buttons -->
            <div class="swiper-button-next testimonial-next"></div>
            <div class="swiper-button-prev testimonial-prev"></div>

            <!-- Pagination -->
            <div class="swiper-pagination testimonial-pagination mt-8"></div>
        </div>

        <!-- Gradient Overlays -->
        <div class="absolute left-0 top-0 bottom-0 w-12 bg-gradient-to-r from-white to-transparent z-10 pointer-events-none"></div>
        <div class="absolute right-0 top-0 bottom-0 w-12 bg-gradient-to-l from-white to-transparent z-10 pointer-events-none"></div>
    </div>
</section>

@push('styles')
<style>
    /* Styles personnalisés pour le carousel témoignages */
    .testimonials-swiper {
        padding: 20px 0;
    }

    .swiper-slide {
        opacity: 0.4;
        transform: scale(0.8);
        transition: all 0.5s ease;
    }

    .swiper-slide-active {
        opacity: 1;
        transform: scale(1);
    }

    .swiper-slide-next,
    .swiper-slide-prev {
        opacity: 0.7;
        transform: scale(0.9);
    }

    /* Navigation buttons */
    .testimonial-next,
    .testimonial-prev {
        background: white;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }

    .testimonial-next::after,
    .testimonial-prev::after {
        font-size: 18px;
        color: #4F46E5;
        font-weight: bold;
    }

    .testimonial-next:hover,
    .testimonial-prev:hover {
        background: #4F46E5;
        transform: scale(1.1);
    }

    .testimonial-next:hover::after,
    .testimonial-prev:hover::after {
        color: white;
    }

    /* Pagination */
    .testimonial-pagination .swiper-pagination-bullet {
        width: 12px;
        height: 12px;
        background: #E5E7EB;
        opacity: 1;
        transition: all 0.3s ease;
    }

    .testimonial-pagination .swiper-pagination-bullet-active {
        background: #4F46E5;
        transform: scale(1.2);
    }

    /* Animation d'entrée des slides */
    @keyframes slideInFromBottom {
        from {
            opacity: 0;
            transform: translateY(50px) scale(0.8);
        }
        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    .swiper-slide-active .bg-white {
        animation: slideInFromBottom 0.6s ease-out;
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialisation du carousel témoignages
        new Swiper('.testimonials-swiper', {
            loop: true,
            slidesPerView: 1,
            spaceBetween: 30,
            centeredSlides: true,
            grabCursor: true,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            navigation: {
                nextEl: '.testimonial-next',
                prevEl: '.testimonial-prev',
            },
            pagination: {
                el: '.testimonial-pagination',
                clickable: true,
                dynamicBullets: true,
            },
            breakpoints: {
                640: {
                    slidesPerView: 1,
                    spaceBetween: 20,
                },
                768: {
                    slidesPerView: 2,
                    spaceBetween: 30,
                },
                1024: {
                    slidesPerView: 3,
                    spaceBetween: 30,
                },
            },
            effect: 'coverflow',
            coverflowEffect: {
                rotate: 0,
                stretch: 0,
                depth: 100,
                modifier: 2.5,
                slideShadows: false,
            },
            on: {
                init: function() {
                    // Animation initiale
                    this.slides.forEach((slide, index) => {
                        slide.style.transitionDelay = `${index * 100}ms`;
                    });
                },
                slideChange: function() {
                    // Réinitialiser les délais pour l'animation
                    this.slides.forEach((slide) => {
                        slide.style.transitionDelay = '0ms';
                    });
                }
            }
        });

        // Interaction au survol des étoiles
        document.querySelectorAll('.testimonials-swiper .swiper-slide').forEach(slide => {
            slide.addEventListener('mouseenter', function() {
                if (this.classList.contains('swiper-slide-active')) {
                    const stars = this.querySelectorAll('span.text-yellow-400, span.text-gray-300');
                    stars.forEach((star, index) => {
                        setTimeout(() => {
                            star.style.transform = 'scale(1.3) rotate(12deg)';
                            setTimeout(() => {
                                star.style.transform = 'scale(1.1)';
                            }, 150);
                        }, index * 100);
                    });
                }
            });

            slide.addEventListener('mouseleave', function() {
                const stars = this.querySelectorAll('span.text-yellow-400, span.text-gray-300');
                stars.forEach(star => {
                    star.style.transform = 'scale(1)';
                });
            });
        });

        // Animation des cartes au survol
        document.querySelectorAll('.testimonials-swiper .bg-white').forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-12px) scale(1.02)';
            });

            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(-8px) scale(1)';
            });
        });
    });
</script>
@endpush
@endif

@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <style>

        /* Animations personnalisées */
        .animate-fade-in {
            animation: fadeIn 1s ease-in-out;
        }

        .animate-slide-down {
            animation: slideDown 0.8s ease-out;
        }

        .animate-slide-up {
            animation: slideUp 0.8s ease-out;
        }

        .animate-slide-in-left {
            animation: slideInLeft 1s ease-out;
        }

        .animate-slide-in-right {
            animation: slideInRight 1s ease-out;
        }

        .animate-bounce-in {
            animation: bounceIn 1s ease-out;
        }

        .animate-stagger-item {
            animation: fadeInUp 0.6s ease-out forwards;
            opacity: 0;
        }

        .animate-product-card {
            animation: productCardEntrance 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94) forwards;
            opacity: 0;
            transform: translateY(50px) rotateX(10deg);
        }

        .animate-testimonial {
            animation: fadeInUp 0.8s ease-out forwards;
            opacity: 0;
        }

        .animate-pulse-slow {
            animation: pulse 2s infinite;
        }

        .animate-typing {
            animation: typing 3s steps(40, end), blink-caret 0.75s step-end infinite;
            overflow: hidden;
            white-space: nowrap;
            border-right: 3px solid;
        }

        .animate-bounce {
            animation: bounce 2s infinite;
        }

        /* Keyframes */
        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-50px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(50px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-100px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(100px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes bounceIn {
            0% {
                opacity: 0;
                transform: scale(0.3);
            }

            50% {
                opacity: 1;
                transform: scale(1.05);
            }

            70% {
                transform: scale(0.9);
            }

            100% {
                opacity: 1;
                transform: scale(1);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes productCardEntrance {
            0% {
                opacity: 0;
                transform: translateY(50px) rotateX(10deg);
            }

            100% {
                opacity: 1;
                transform: translateY(0) rotateX(0);
            }
        }

        @keyframes typing {
            from {
                width: 0
            }

            to {
                width: 100%
            }
        }

        @keyframes blink-caret {

            from,
            to {
                border-color: transparent
            }

            50% {
                border-color: orange
            }
        }

        @keyframes bounce {

            0%,
            20%,
            50%,
            80%,
            100% {
                transform: translateY(0);
            }

            40% {
                transform: translateY(-10px);
            }

            60% {
                transform: translateY(-5px);
            }
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.8;
            }
        }

        @keyframes starPopIn {
            0% {
                opacity: 0;
                transform: scale(0) rotate(-180deg);
            }

            100% {
                opacity: 1;
                transform: scale(1) rotate(0);
            }
        }

        @keyframes stockFill {
            0% {
                transform: scaleX(0);
            }

            100% {
                transform: scaleX(1);
            }
        }

        @keyframes confettiFall {
            0% {
                transform: translate(0, 0) rotate(0deg);
                opacity: 1;
            }

            100% {
                transform: translate(var(--confetti-x), 100px) rotate(360deg);
                opacity: 0;
            }
        }

        /* Animations FAQ améliorées */
        .faq-item {
            transition: all 0.3s ease;
        }

        .faq-item:hover {
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        .faq-question {
            transition: all 0.2s ease;
        }

        .faq-answer {
            animation: fadeIn 0.3s ease-in-out;
        }

        .faq-icon {
            transition: transform 0.3s ease;
        }

        .rotate-180 {
            transform: rotate(180deg);
        }

        /* Animation des étoiles de rating */
        .star-rating {
            animation: starPopIn 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55) forwards;
            opacity: 0;
            transform: scale(0);
        }

        /* Animation de la barre de stock */
        .stock-bar {
            animation: stockFill 1.5s ease-out forwards;
            transform-origin: left;
        }

        /* Effet de brillance */
        .shine-effect {
            opacity: 0.3;
        }

        /* Animation du bouton ajouter au panier */
        .add-to-cart-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
            transition: left 0.5s;
        }

        .add-to-cart-btn:hover::before {
            left: 100%;
        }

        /* Animation de pulse pour les produits en promo */
        @keyframes promoPulse {

            0%,
            100% {
                box-shadow: 0 0 0 0 rgba(239, 68, 68, 0.7);
            }

            50% {
                box-shadow: 0 0 0 10px rgba(239, 68, 68, 0);
            }
        }

        .product-card:hover {
            animation: promoPulse 2s infinite;
        }

        /* Effet de profondeur */
        .product-card {
            perspective: 1000px;
        }

        .product-card:hover {
            transform: translateY(-10px) rotateX(5deg) rotateY(5deg);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }

        /* Délais d'animation */
        .delay-200 {
            animation-delay: 200ms;
        }

        .delay-500 {
            animation-delay: 500ms;
        }
    </style>
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <script>
        // Swiper initialization for the banner
        document.addEventListener('DOMContentLoaded', function() {
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
                effect: 'fade',
                fadeEffect: {
                    crossFade: true
                },
            });
        });

        // FAQ Accordion functionality avec animations améliorées
        document.addEventListener('DOMContentLoaded', function() {
            const faqQuestions = document.querySelectorAll('.faq-question');

            faqQuestions.forEach(btn => {
                btn.addEventListener('click', function() {
                    const answer = this.parentElement.querySelector('.faq-answer');
                    const icon = this.querySelector('.faq-icon');
                    const isOpen = !answer.classList.contains('hidden');

                    // Ferme toutes les réponses
                    document.querySelectorAll('.faq-answer').forEach(a => {
                        a.classList.add('hidden');
                        a.style.transform = 'translateY(-10px)';
                    });
                    document.querySelectorAll('.faq-icon').forEach(i => i.classList.remove(
                        'rotate-180'));

                    // Si pas ouvert, on ouvre celui cliqué
                    if (!isOpen) {
                        answer.classList.remove('hidden');
                        answer.style.transform = 'translateY(0)';
                        icon.classList.add('rotate-180');

                        // Animation d'entrée
                        setTimeout(() => {
                            answer.style.opacity = '1';
                        }, 50);
                    }
                });
            });

            // Open first FAQ by default
            if (faqQuestions.length > 0) {
                setTimeout(() => {
                    faqQuestions[0].click();
                }, 1000);
            }
        });

        // Animation au scroll pour tous les éléments
        document.addEventListener('DOMContentLoaded', function() {
            const animatedElements = document.querySelectorAll(
                '.animate-stagger-item, .animate-product-card, .animate-testimonial');

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const element = entry.target;
                        const index = element.dataset.productIndex || 0;

                        if (element.classList.contains('animate-product-card')) {
                            // Animation séquentielle pour les produits
                            setTimeout(() => {
                                element.style.opacity = '1';
                                element.style.transform = 'translateY(0) rotateX(0)';

                                // Animation des étoiles
                                const stars = element.querySelectorAll('.star-rating');
                                stars.forEach((star, starIndex) => {
                                    setTimeout(() => {
                                        star.style.opacity = '1';
                                        star.style.transform =
                                            'scale(1) rotate(0)';
                                    }, starIndex * 100 + 500);
                                });

                                // Animation de la barre de stock
                                const stockBar = element.querySelector('.stock-bar');
                                if (stockBar) {
                                    setTimeout(() => {
                                        stockBar.style.transform = 'scaleX(1)';
                                    }, 800);
                                }
                            }, index * 150);
                        } else {
                            // Animation normale pour autres éléments
                            element.style.opacity = '1';
                            element.style.transform = 'translateY(0)';
                        }
                    }
                });
            }, {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            });

            // Observer tous les éléments animés
            animatedElements.forEach(el => {
                observer.observe(el);
            });

            // Interaction de description des produits
            document.querySelectorAll('.description-trigger').forEach(trigger => {
                trigger.addEventListener('click', function() {
                    const fullDescription = this.dataset.fullDescription;
                    const isExpanded = this.classList.contains('line-clamp-2');

                    if (isExpanded) {
                        this.textContent = fullDescription;
                        this.classList.remove('line-clamp-2');
                        this.classList.add('bg-yellow-50', 'p-2', 'rounded');
                    } else {
                        this.textContent = fullDescription.substring(0, 80) + '...';
                        this.classList.add('line-clamp-2');
                        this.classList.remove('bg-yellow-50', 'p-2', 'rounded');
                    }
                });
            });

            // Animation du stock au survol
            document.querySelectorAll('.stock-indicator').forEach(indicator => {
                indicator.addEventListener('mouseenter', function() {
                    const stock = this.dataset.stock;
                    this.textContent = `(${stock} en stock)`;
                    this.classList.add('font-bold', 'text-green-800');
                });

                indicator.addEventListener('mouseleave', function() {
                    const stock = this.dataset.stock;
                    this.textContent = `(${stock})`;
                    this.classList.remove('font-bold', 'text-green-800');
                });
            });

            // Fonctionnalité panier avec animations
            document.querySelectorAll('.add-to-cart').forEach(button => {
                button.onclick = function() {
                    const productId = this.dataset.productId;
                    const button = this;

                    // Animation du bouton
                    button.classList.add('scale-95');

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

                                // Animation de confirmation
                                button.classList.remove('scale-95');
                                button.classList.add('bg-green-500');
                                setTimeout(() => {
                                    button.classList.remove('bg-green-500');
                                }, 1000);

                                // Effet de particules
                                createConfettiEffect(button);
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            showNotification('Erreur lors de l\'ajout au panier', 'error');
                            button.classList.remove('scale-95');
                        });
                }
            });

            function updateCartCount() {
                fetch('{{ route('cart.count') }}')
                    .then(response => response.json())
                    .then(data => {
                        document.querySelectorAll('.cart-count').forEach(element => {
                            // Animation du compteur
                            element.style.transform = 'scale(1.5)';
                            element.textContent = data.total_items;
                            setTimeout(() => {
                                element.style.transform = 'scale(1)';
                            }, 300);
                        });
                    });
            }

            function showNotification(message, type = 'info') {
                const notification = document.createElement('div');
                notification.className = `fixed top-4 right-4 z-50 p-4 rounded-lg shadow-lg text-white transform transition-all duration-500 translate-x-full ${
                    type === 'success' ? 'bg-green-500' : type === 'error' ? 'bg-red-500' : 'bg-blue-500'
                }`;
                notification.textContent = message;
                document.body.appendChild(notification);

                // Animation d'entrée
                setTimeout(() => {
                    notification.classList.remove('translate-x-full');
                }, 100);

                setTimeout(() => {
                    notification.classList.add('translate-x-full');
                    setTimeout(() => notification.remove(), 500);
                }, 3000);
            }

            function createConfettiEffect(element) {
                const rect = element.getBoundingClientRect();
                for (let i = 0; i < 10; i++) {
                    const confetti = document.createElement('div');
                    confetti.className = 'fixed w-2 h-2 bg-green-500 rounded-full z-50';
                    confetti.style.left = rect.left + rect.width / 2 + 'px';
                    confetti.style.top = rect.top + rect.height / 2 + 'px';
                    const randomX = Math.random() * 200 - 100;
                    confetti.style.setProperty('--confetti-x', randomX + 'px');
                    confetti.style.animation = `confettiFall ${Math.random() * 1 + 1}s forwards`;
                    document.body.appendChild(confetti);

                    setTimeout(() => confetti.remove(), 2000);
                }
            }
        });
    </script>
@endpush
