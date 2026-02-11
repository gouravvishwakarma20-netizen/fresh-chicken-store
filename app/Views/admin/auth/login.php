<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Fresh Chicken</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        maroon: { DEFAULT: '#8B0000', light: '#A52A2A', dark: '#5C0000' },
                        gold: { DEFAULT: '#D4AF37', light: '#E5C76B', dark: '#B8960C' },
                    },
                    fontFamily: { sans: ['Inter', 'sans-serif'] },
                    keyframes: {
                        float: { '0%, 100%': { transform: 'translateY(0px)' }, '50%': { transform: 'translateY(-20px)' } },
                        bounceIn: { '0%': { transform: 'scale(0.3)', opacity: '0' }, '50%': { transform: 'scale(1.05)' }, '70%': { transform: 'scale(0.9)' }, '100%': { transform: 'scale(1)', opacity: '1' } },
                    },
                    animation: {
                        'float': 'float 3s ease-in-out infinite',
                        'bounce-in': 'bounceIn 0.6s ease-out',
                    },
                }
            }
        }
    </script>
</head>
<body class="bg-gradient-to-br from-maroon to-maroon-dark min-h-screen flex items-center justify-center font-sans p-4 relative overflow-hidden">
    <!-- Floating Background Shapes -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-20 left-10 w-64 h-64 bg-white/5 rounded-full animate-float"></div>
        <div class="absolute bottom-20 right-10 w-48 h-48 bg-gold/10 rounded-full animate-float" style="animation-delay: 1s;"></div>
        <div class="absolute top-1/2 left-1/2 w-32 h-32 bg-white/5 rounded-full animate-float" style="animation-delay: 2s;"></div>
    </div>

    <div class="w-full max-w-md relative z-10">
        <!-- Logo -->
        <div class="text-center mb-8 animate-bounce-in">
            <div class="w-16 h-16 bg-gold rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg shadow-gold/30">
                <i class="fas fa-drumstick-bite text-maroon-dark text-2xl"></i>
            </div>
            <h1 class="text-2xl font-bold text-white">Fresh Chicken</h1>
            <p class="text-white/60 text-sm">Admin Panel Login</p>
        </div>

        <!-- Login Card -->
        <div class="bg-white rounded-2xl p-8 shadow-2xl border border-white/20">
            <?php if (session()->getFlashdata('error')): ?>
                <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl mb-6 text-sm">
                    <i class="fas fa-exclamation-circle mr-2"></i> <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>

            <form action="<?= base_url('admin/login') ?>" method="POST" id="loginForm">
                <?= csrf_field() ?>

                <div class="mb-5">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Username</label>
                    <div class="relative">
                        <input type="text" name="username" value="<?= old('username') ?>" required autofocus
                               class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:border-maroon focus:ring-3 focus:ring-maroon/20 text-sm transition-all duration-200"
                               placeholder="Enter username">
                        <i class="fas fa-user absolute left-3.5 top-3.5 text-gray-400"></i>
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                    <div class="relative">
                        <input type="password" name="password" required
                               class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:border-maroon focus:ring-3 focus:ring-maroon/20 text-sm transition-all duration-200"
                               placeholder="Enter password">
                        <i class="fas fa-lock absolute left-3.5 top-3.5 text-gray-400"></i>
                    </div>
                </div>

                <button type="submit" id="loginBtn"
                        class="w-full bg-gradient-to-r from-maroon to-maroon-dark text-white py-3 rounded-xl font-bold text-sm hover:shadow-lg transition-all flex items-center justify-center min-h-[44px]">
                    <i class="fas fa-sign-in-alt mr-2"></i> <span id="loginText">Login</span>
                </button>
            </form>
        </div>

        <p class="text-center text-white/40 text-xs mt-6">
            &copy; <?= date('Y') ?> Fresh Chicken Store
        </p>
    </div>

    <script>
    document.getElementById('loginForm').addEventListener('submit', function() {
        const btn = document.getElementById('loginBtn');
        const text = document.getElementById('loginText');
        btn.disabled = true;
        btn.classList.add('opacity-70');
        text.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Logging in...';
    });
    </script>
</body>
</html>
