<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Masuk ke portal Serean Tobacco - Sentra Tembakau Pilihan Nusantara.">
    <title>Masuk — Serean Tobacco</title>

    
    <link rel="icon" type="image/png" href="{{ asset('logo.png') }}">

    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            espresso: '#3C220F',
                            dark: '#261509',
                            gold: '#B07B27',
                            goldHover: '#98661C',
                            surface: '#FAF8F5',
                            card: '#FFFFFF',
                            border: '#EDE7E1',
                            muted: '#6E6259',
                        }
                    },
                    fontFamily: {
                        serif: ['"Poppins"', 'system-ui', 'sans-serif'],
                        display: ['"Poppins"', 'system-ui', 'sans-serif'],
                        sans: ['"Poppins"', 'system-ui', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <style>
        * { box-sizing: border-box; }
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #FAF8F5;
            color: #261509;
        }
    </style>
</head>
<body class="min-h-screen bg-brand-surface antialiased flex flex-col justify-center">

    <div class="min-h-screen w-full flex flex-col lg:flex-row">

        
        <div class="hidden lg:flex lg:w-1/2 bg-brand-dark text-white relative flex-col justify-between p-12 lg:p-16 overflow-hidden">
            
            <div class="absolute inset-0 pointer-events-none select-none opacity-[0.04]" aria-hidden="true">
                <svg class="w-full h-full" xmlns="http://www.w3.org/2000/svg">
                    <defs>
                        <pattern id="tobacco-leaf-auth" width="70" height="70" patternUnits="userSpaceOnUse" patternTransform="rotate(25)">
                            <g transform="translate(10, 8) scale(0.22)" fill="none" stroke="#FFFFFF" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M50 5 C75 35, 82 85, 50 155 C18 85, 25 35, 50 5 Z" fill="#FFFFFF" fill-opacity="0.3"></path>
                                <path d="M50 15 L50 150 M50 45 L70 32 M50 70 L75 55 M50 95 L72 80 M50 120 L65 108 M50 45 L30 32 M50 70 L25 55 M50 95 L28 80 M50 120 L35 108"></path>
                            </g>
                        </pattern>
                    </defs>
                    <rect width="100%" height="100%" fill="url(#tobacco-leaf-auth)" />
                </svg>
            </div>

            
            <div class="absolute -top-32 -left-32 w-96 h-96 bg-brand-gold/20 rounded-full blur-3xl pointer-events-none"></div>
            <div class="absolute -bottom-32 -right-32 w-96 h-96 bg-brand-gold/15 rounded-full blur-3xl pointer-events-none"></div>

            
            <div class="relative z-10">
                <a href="{{ route('home') }}" class="inline-flex items-center gap-2 text-xs font-semibold text-white/80 hover:text-white px-4 py-2 rounded-full bg-white/10 hover:bg-white/15 border border-white/10 backdrop-blur-md transition-all duration-200 group">
                    <i class="fa-solid fa-arrow-left text-brand-gold text-xs group-hover:-translate-x-0.5 transition-transform"></i>
                    <span>Kembali ke Beranda</span>
                </a>
            </div>

            
            <div class="relative z-10 my-auto py-8 max-w-md mx-auto text-center flex flex-col items-center">
                
                <div class="p-4 rounded-2xl bg-white shadow-xl shadow-black/30 mb-6 flex items-center justify-center">
                    <img src="{{ asset('logo.png') }}" alt="Logo Serean Tobacco" class="h-16 w-auto object-contain">
                </div>

                <h1 class="font-serif font-extrabold text-3xl lg:text-4xl text-white leading-tight tracking-tight">
                    Serean Tobacco
                </h1>
                <p class="text-brand-gold font-medium text-sm mt-1.5 tracking-wide">
                    Sentra Tembakau Pilihan Nusantara
                </p>

                <p class="text-white/70 text-sm leading-relaxed mt-4 max-w-sm mx-auto">
                    Kualitas rajangan terbaik dan kemitraan terpercaya dari hulu hingga hilir tembakau Nusantara.
                </p>
            </div>

            
            <div class="relative z-10 pt-4 border-t border-white/10 text-xs text-white/50 text-center">
                <p>© {{ date('Y') }} Serean Tobacco • Situbondo, Jawa Timur</p>
            </div>
        </div>

        
        <div class="w-full lg:w-1/2 min-h-screen bg-brand-surface flex flex-col justify-center items-center p-6 sm:p-10 lg:p-16 relative">
            <div class="w-full max-w-md mx-auto">

                
                <div class="lg:hidden flex items-center justify-between mb-8">
                    <a href="{{ route('home') }}" class="inline-flex items-center gap-1.5 text-xs font-semibold text-brand-muted hover:text-brand-espresso">
                        <i class="fa-solid fa-arrow-left text-brand-gold text-xs"></i>
                        <span>Beranda</span>
                    </a>
                    <span class="text-[11px] font-semibold text-brand-gold uppercase tracking-wider">Serean Tobacco</span>
                </div>

                
                <div class="lg:hidden text-center mb-6">
                    <img src="{{ asset('logo.png') }}" alt="Serean Tobacco" class="h-12 w-auto mx-auto mb-2.5 object-contain">
                    <h2 class="font-serif font-bold text-xl text-brand-espresso">Masuk ke Akun Anda</h2>
                    <p class="text-xs text-brand-muted mt-0.5">Masukkan email dan kata sandi Anda</p>
                </div>

                
                <div class="hidden lg:block mb-8">
                    <h2 class="font-serif font-extrabold text-2xl lg:text-3xl text-brand-espresso tracking-tight">
                        Masuk ke Akun Anda
                    </h2>
                    <p class="text-brand-muted text-xs sm:text-sm mt-1.5">
                        Silakan masukkan email dan kata sandi untuk mengakses akun.
                    </p>
                </div>

                
                <form action="{{ route('login') }}" method="POST" class="space-y-4">
                    @csrf

                    
                    <div>
                        <label for="email" class="block text-xs font-bold text-brand-espresso mb-1.5">
                            Email <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-brand-muted">
                                <i class="fa-regular fa-envelope text-sm"></i>
                            </div>
                            <input 
                                type="email" 
                                id="email" 
                                name="email" 
                                required 
                                autofocus
                                placeholder="nama@email.com" 
                                class="w-full pl-10 pr-4 py-3 text-sm rounded-xl border border-brand-border bg-white text-brand-dark placeholder:text-stone-400 focus:outline-none focus:ring-2 focus:ring-brand-gold/40 focus:border-brand-gold transition-all shadow-sm"
                            >
                        </div>
                    </div>

                    
                    <div>
                        <div class="flex items-center justify-between mb-1.5">
                            <label for="password" class="block text-xs font-bold text-brand-espresso">
                                Kata Sandi <span class="text-red-500">*</span>
                            </label>
                            <a href="{{ route('password.request') }}" class="text-xs font-semibold text-brand-gold hover:text-brand-goldHover hover:underline transition-colors">
                                Lupa sandi?
                            </a>
                        </div>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-brand-muted">
                                <i class="fa-solid fa-lock text-sm"></i>
                            </div>
                            <input 
                                type="password" 
                                id="password" 
                                name="password" 
                                required 
                                placeholder="••••••••" 
                                class="w-full pl-10 pr-11 py-3 text-sm rounded-xl border border-brand-border bg-white text-brand-dark placeholder:text-stone-400 focus:outline-none focus:ring-2 focus:ring-brand-gold/40 focus:border-brand-gold transition-all shadow-sm"
                            >
                            <button 
                                type="button" 
                                onclick="togglePasswordVisibility('password', this)"
                                class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-brand-muted hover:text-brand-espresso focus:outline-none"
                                title="Lihat kata sandi"
                            >
                                <i class="fa-regular fa-eye text-sm"></i>
                            </button>
                        </div>
                    </div>

                    
                    <div class="flex items-center justify-between pt-0.5">
                        <label class="flex items-center gap-2 cursor-pointer select-none">
                            <input type="checkbox" name="remember" class="w-4 h-4 rounded border-brand-border text-brand-gold focus:ring-brand-gold/30">
                            <span class="text-xs text-brand-muted">Ingat saya</span>
                        </label>
                    </div>

                    
                    <div class="pt-2">
                        <button 
                            type="submit" 
                            class="w-full py-3.5 px-6 rounded-xl bg-brand-espresso text-white font-serif font-bold text-sm sm:text-base hover:bg-brand-dark active:scale-[0.99] transition-all duration-200 shadow-md shadow-brand-espresso/20 flex items-center justify-center cursor-pointer"
                        >
                            Masuk Sekarang
                        </button>
                    </div>

                    
                    
                    <div class="pt-4 text-center">
                        <p class="text-xs sm:text-sm text-brand-muted">
                            Apakah anda belum punya akun? 
                            <a href="{{ route('register') }}" class="font-bold text-brand-gold hover:text-brand-goldHover hover:underline transition-colors ml-1">
                                Daftar sekarang
                            </a>
                        </p>
                    </div>

                </form>

            </div>
        </div>

    </div>

    
    <script>
        function togglePasswordVisibility(inputId, btn) {
            const input = document.getElementById(inputId);
            const icon = btn.querySelector('i');
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>
</body>
</html>
