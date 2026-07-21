<footer class="bg-[#183D57] text-white pt-16 pb-8 relative overflow-hidden">
    <div class="absolute inset-0 bg-grid-pattern opacity-5"></div>
    <div class="absolute top-0 left-0 w-96 h-96 bg-[#8AD337] rounded-full filter blur-3xl opacity-10"></div>
    <div class="absolute bottom-0 right-0 w-96 h-96 bg-[#8AD337] rounded-full filter blur-3xl opacity-10"></div>

    <div class="container mx-auto px-6 relative z-10">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
            <div>
                <div class="flex items-center space-x-3 mb-6">
                    <img src="{{ asset('images/logo.png') }}" alt="Energi Bahagia Logo"
                        class="h-20 w-auto brightness-0 invert">
                </div>
                <p class="text-gray-300 mb-6 leading-relaxed text-sm">
                    Bersama membangun masa depan yang lebih baik untuk mereka yang membutuhkan.
                </p>
                <div class="flex space-x-3">
                    <a href="https://www.facebook.com/official.energibahagia/"
                        class="w-10 h-10 bg-white/10 rounded-xl flex items-center justify-center hover:bg-[#8AD337] hover:text-[#183D57] transition-all duration-300 hover:scale-110 border border-[#8AD337]/20">
                        <i class="fab fa-facebook-f text-sm"></i>
                    </a>
                    <a href="https://www.instagram.com/energibahagia/"
                        class="w-10 h-10 bg-white/10 rounded-xl flex items-center justify-center hover:bg-[#8AD337] hover:text-[#183D57] transition-all duration-300 hover:scale-110 border border-[#8AD337]/20">
                        <i class="fab fa-instagram text-sm"></i>
                    </a>
                </div>
            </div>

            <div>
                <h4 class="text-sm font-bold mb-4 relative inline-block text-[#8AD337] uppercase tracking-wider">
                    Quick Links
                    <span class="absolute -bottom-2 left-0 w-8 h-0.5 bg-[#8AD337] rounded-full"></span>
                </h4>
                <ul class="space-y-2">
                    <li><a href="{{ route('profile') }}"
                            class="text-gray-300 hover:text-[#8AD337] transition-colors flex items-center group text-sm"><i
                                class="fas fa-chevron-right mr-2 text-[#8AD337] text-xs group-hover:translate-x-1 transition-transform"></i>Tentang
                            Kami</a></li>
                    <li><a href="{{ route('programs') }}"
                            class="text-gray-300 hover:text-[#8AD337] transition-colors flex items-center group text-sm"><i
                                class="fas fa-chevron-right mr-2 text-[#8AD337] text-xs group-hover:translate-x-1 transition-transform"></i>Program
                            Donasi</a></li>
                    <li><a href="{{ route('contact') }}"
                            class="text-gray-300 hover:text-[#8AD337] transition-colors flex items-center group text-sm"><i
                                class="fas fa-chevron-right mr-2 text-[#8AD337] text-xs group-hover:translate-x-1 transition-transform"></i>Kontak</a>
                    </li>
                </ul>
            </div>

            <div>
                <h4 class="text-sm font-bold mb-4 relative inline-block text-[#8AD337] uppercase tracking-wider">
                    Bantuan
                    <span class="absolute -bottom-2 left-0 w-8 h-0.5 bg-[#8AD337] rounded-full"></span>
                </h4>
                <ul class="space-y-2">
                    <li><a href="{{ route('cara.donasi') }}"
                            class="text-gray-300 hover:text-[#8AD337] transition-colors flex items-center group text-sm"><i
                                class="fas fa-chevron-right mr-2 text-[#8AD337] text-xs group-hover:translate-x-1 transition-transform"></i>Cara
                            Donasi</a></li>
                </ul>
            </div>

            <div>
                <h4 class="text-sm font-bold mb-4 relative inline-block text-[#8AD337] uppercase tracking-wider">
                    Kontak Kami
                    <span class="absolute -bottom-2 left-0 w-8 h-0.5 bg-[#8AD337] rounded-full"></span>
                </h4>
                <ul class="space-y-2">
                    <li class="flex items-start text-gray-300 text-sm">
                        <i class="fas fa-map-marker-alt mt-1 mr-3 text-[#8AD337]"></i>
                        <span>Jl. Laksdya Leo Watimena, Perumnas Waiheru Blok 1, Ambon, Maluku</span>
                    </li>
                    <li class="flex items-center text-gray-300 text-sm">
                        <i class="fas fa-phone mr-3 text-[#8AD337]"></i>
                        <span>+62 852-4383-1159</span>
                    </li>
                    <li class="flex items-center text-gray-300 text-sm">
                        <i class="fas fa-envelope mr-3 text-[#8AD337]"></i>
                        <span>energibahagiaindonesia@gmail.com</span>
                    </li>
                </ul>

                </div>
            </div>
        </div>

        <div class="border-t border-white/10 pt-6">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-400 text-xs">&copy; 2026 energibahagia.id. Hak Cipta Dilindungi.</p>
                <div class="flex space-x-4 mt-3 md:mt-0">
                    <a href="#"
                        class="text-gray-400 hover:text-[#8AD337] text-xs transition-colors uppercase tracking-wider">Sitemap</a>
                    <a href="#"
                        class="text-gray-400 hover:text-[#8AD337] text-xs transition-colors uppercase tracking-wider">Privacy</a>
                    <a href="#"
                        class="text-gray-400 hover:text-[#8AD337] text-xs transition-colors uppercase tracking-wider">Terms</a>
                </div>
            </div>
        </div>
    </div>
</footer>
