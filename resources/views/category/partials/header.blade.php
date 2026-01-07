    <!-- Modern Hero Header -->
    <div class="container mx-auto px-4 mt-4" id="category-header">
        <div class="relative py-12 rounded-3xl overflow-hidden shadow-xl isolate mb-8">
            <!-- Dynamic Background -->
            <div class="absolute inset-0 bg-[#03352c] z-0">
                <div class="absolute inset-0 bg-gradient-to-br from-[#044a3d] to-[#01221c] opacity-90"></div>
            </div>

            <!-- Ambient Glow Effects -->
            <div class="absolute -top-24 -right-24 w-64 h-64 bg-[#ccfd62]/10 rounded-full blur-[60px] animate-pulse">
            </div>
            <div class="absolute top-1/2 -left-24 w-48 h-48 bg-white/5 rounded-full blur-[50px]"></div>

            <!-- Geometric Pattern -->
            <div class="absolute inset-0 opacity-10 pointer-events-none"
                style="background-image: radial-gradient(circle, #ffffff 1.5px, transparent 1.5px); background-size: 30px 30px;">
            </div>

            <div class="relative z-10 px-4 text-center">
                <!-- Floating Glassy Icon -->
                <div class="w-20 h-20 mx-auto mb-6 relative group perspective-1000">
                    <!-- Outer Glow -->
                    <div
                        class="absolute inset-0 bg-[#ccfd62]/20 rounded-2xl blur-lg group-hover:blur-xl transition duration-500 scale-110">
                    </div>

                    <!-- Glass Container -->
                    <div
                        class="relative w-full h-full bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl flex items-center justify-center p-4 shadow-[0_8px_32px_0_rgba(0,0,0,0.36)] ring-1 ring-white/30 transform group-hover:-translate-y-1 transition-all duration-500 group-hover:rotate-3">
                        <img src="{{ $category->icon_url }}"
                            class="w-full h-full object-contain brightness-0 invert drop-shadow-lg group-hover:scale-110 transition duration-500">
                    </div>
                </div>

                <!-- Typography -->
                <h1 class="text-4xl md:text-5xl font-extrabold text-white mb-3 tracking-tight drop-shadow-md">
                    {{ $categoryName }}
                </h1>

                <div class="inline-block relative group cursor-default">
                    <p
                        class="text-[#e0e7e6] font-medium text-lg md:text-xl max-w-2xl mx-auto leading-relaxed tracking-wide">
                        Premium <span class="text-[#ccfd62] font-bold">{{ strtolower($categoryName) }}</span> sourced
                        with care.
                    </p>
                    <!-- Animated Underline -->
                    <div
                        class="absolute -bottom-3 left-1/2 -translate-x-1/2 w-16 h-0.5 bg-[#ccfd62] rounded-full group-hover:w-32 transition-all duration-300">
                    </div>
                </div>
            </div>
        </div>
    </div>
