<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SM Game Store Admin - Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'game-primary': '#1a1a2e',
                        'game-secondary': '#16213e',
                        'game-accent': '#0f3460',
                        'game-purple': '#533483',
                        'game-pink': '#e94560'
                    }
                }
            }
        }
    </script>
    <style>
        body {
           background: linear-gradient(135deg, #0d1117 0%, #1a1a2e 50%, #16213e 100%);
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
        }
        
        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .input-glow:focus {
            box-shadow: 0 0 20px rgba(103, 126, 234, 0.3);
        }
        
        .gaming-gradient {
            background: linear-gradient(45deg, #667eea, #764ba2, #f093fb);
            background-size: 300% 300%;
            animation: gradientShift 6s ease infinite;
        }
        
        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        
        .pulse-glow {
            animation: pulseGlow 2s ease-in-out infinite alternate;
        }
        
        @keyframes pulseGlow {
            from { box-shadow: 0 0 20px rgba(103, 126, 234, 0.3); }
            to { box-shadow: 0 0 30px rgba(118, 75, 162, 0.5); }
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4">
    <!-- Gaming particles background effect -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-10 left-10 w-2 h-2 bg-white rounded-full opacity-60 animate-ping"></div>
        <div class="absolute top-32 right-20 w-1 h-1 bg-purple-300 rounded-full opacity-80 animate-pulse"></div>
        <div class="absolute bottom-40 left-32 w-3 h-3 bg-blue-300 rounded-full opacity-40 animate-bounce"></div>
        <div class="absolute bottom-20 right-40 w-1 h-1 bg-pink-300 rounded-full opacity-70 animate-ping" style="animation-delay: 1s;"></div>
        <div class="absolute top-60 left-1/4 w-2 h-2 bg-indigo-300 rounded-full opacity-50 animate-pulse" style="animation-delay: 0.5s;"></div>
    </div>

    <div class="w-full max-w-md">
        <!-- Login Card -->
        <div class="glass-effect rounded-2xl shadow-2xl p-8 pulse-glow">
            <!-- Header with Gaming Theme -->
            <div class="text-center mb-8">
                <!-- Gaming controller icon -->
                <div class="mx-auto w-16 h-16 gaming-gradient rounded-full flex items-center justify-center mb-4">
                    <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M21.58 16.09l-1.09-7.66C20.21 6.46 18.52 5 16.53 5H7.47C5.48 5 3.79 6.46 3.51 8.43l-1.09 7.66C2.2 17.63 3.39 19 4.94 19c.68 0 1.32-.27 1.8-.75L9 16h6l2.26 2.25c.48.48 1.12.75 1.8.75 1.55 0 2.74-1.37 2.52-2.91zM7.5 10.5C7.5 9.67 8.17 9 9 9s1.5.67 1.5 1.5S9.83 12 9 12s-1.5-.67-1.5-1.5zm9 0c0-.83-.67-1.5-1.5-1.5s-1.5.67-1.5 1.5.67 1.5 1.5 1.5 1.5-.67 1.5-1.5z"/>
                    </svg>
                </div>
                
                <h1 class="text-3xl font-bold text-white mb-2">SM</h1>
                <h2 class="text-xl font-semibold text-purple-200 mb-1">GAME STORE</h2>
                <p class="text-sm text-gray-300">Admin Panel</p>
            </div>

            <!-- Session Status -->
            @if(session('status'))
                <div class="mb-4 p-3 bg-green-500/20 border border-green-500/30 rounded-lg text-green-200 text-sm">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <!-- Email Address -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-200 mb-2">
                        Email Address
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                            </svg>
                        </div>
                        <input id="email" 
                               type="email" 
                               name="email" 
                               value="{{ old('email') }}" 
                               required 
                               autofocus
                               class="input-glow w-full pl-10 pr-4 py-3 bg-white/10 border border-white/20 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:border-purple-400 focus:bg-white/20 transition duration-300"
                               placeholder="Enter your email">
                    </div>
                    @if($errors->get('email'))
                        <div class="mt-2 text-sm text-red-400">
                            @foreach($errors->get('email') as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-200 mb-2">
                        Password
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <input id="password" 
                               type="password" 
                               name="password" 
                               required 
                               autocomplete="current-password"
                               class="input-glow w-full pl-10 pr-4 py-3 bg-white/10 border border-white/20 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:border-purple-400 focus:bg-white/20 transition duration-300"
                               placeholder="Enter your password">
                    </div>
                    @if($errors->get('password'))
                        <div class="mt-2 text-sm text-red-400">
                            @foreach($errors->get('password') as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif
                </div>


                <div class="space-y-4">
                    <!-- Login Button -->
                    <button type="submit" 
                            class="w-full gaming-gradient py-3 px-4 rounded-lg text-white font-semibold shadow-lg hover:shadow-xl transform hover:scale-[1.02] transition duration-300 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 focus:ring-offset-transparent">
                        Access Admin Panel
                    </button>

                    <!-- Forgot Password Link -->
                    @if (Route::has('password.request'))
                        <div class="text-center">
                            <a href="{{ route('password.request') }}" 
                               class="text-sm text-purple-200 hover:text-white transition duration-300 underline decoration-purple-300 hover:decoration-white">
                                Forgot your password?
                            </a>
                        </div>
                    @endif
                </div>
            </form>

            <!-- Footer -->
            <div class="mt-8 text-center">
                <p class="text-xs text-gray-400">
                    © 2024 SM Game Store. All rights reserved.
                </p>
            </div>
        </div>

        <!-- Gaming themed decorative elements -->
        <div class="text-center mt-6">
            <div class="flex justify-center space-x-4 opacity-60">
                <div class="w-2 h-2 bg-purple-400 rounded-full animate-pulse"></div>
                <div class="w-2 h-2 bg-blue-400 rounded-full animate-pulse" style="animation-delay: 0.2s;"></div>
                <div class="w-2 h-2 bg-pink-400 rounded-full animate-pulse" style="animation-delay: 0.4s;"></div>
            </div>
        </div>
    </div>
</body>
</html>