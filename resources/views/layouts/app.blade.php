<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GTW Blogs | Share Your Story</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" href="{{ asset('images/logo1.png') }}" type="image/png">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: { sans: ['Inter', 'sans-serif'] },
                }
            }
        };
    </script>

   <style>
    /* CKEditor Dark Mode Support */
    .dark .ck.ck-editor__main > .ck-editor__editable {
        background: #111827 !important; /* gray-900 */
        color: #f3f4f6 !important;    /* gray-100 */
        border-color: #374151 !important; /* gray-700 */
    }

    .dark .ck.ck-toolbar {
        background: #1f2937 !important; /* gray-800 */
        border-color: #374151 !important; /* gray-700 */
    }

    /* Toolbar icons color fix for dark mode */
    .dark .ck.ck-toolbar .ck-button {
        color: #e5e7eb !important;
    }

    .dark .ck.ck-toolbar .ck-button:hover {
        background: #374151 !important;
    }

    /* Input placeholder fix */
    .dark .ck.ck-placeholder::before {
        color: #9ca3af !important;
    }
    
    /* Remove default glow/border from editor */
    .ck-focused {
        border-color: #3b82f6 !important; /* blue-500 */
    }
</style>
</head>

<body class="bg-[#f8fafc] dark:bg-gray-950 text-gray-900 dark:text-gray-100 font-sans antialiased selection:bg-blue-500 selection:text-white transition-colors duration-300">

    <nav class="sticky top-0 z-50 w-full bg-white/80 dark:bg-gray-900/80 backdrop-blur-md border-b border-gray-100 dark:border-gray-800 transition-all">
        <div class="container mx-auto px-4 md:px-6">
            <div class="flex h-16 items-center justify-between">
                
                <a href="{{ route('blogs.index') }}" class="flex items-center gap-2 group">
                    <div class="bg-blue-600 p-1.5 rounded-lg shadow-lg shadow-blue-500/30 group-hover:rotate-12 transition-transform">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                    </div>
                    <span class="text-xl font-extrabold tracking-tighter bg-clip-text text-transparent bg-gradient-to-r from-gray-900 to-gray-500 dark:from-white dark:to-gray-400">
                        GTW BLOGS
                    </span>
                </a>

                <div class="flex items-center gap-2 md:gap-4">
                    
                    <button id="theme-toggle" class="p-2 text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 rounded-xl transition-colors">
                        <span id="theme-toggle-icon" class="text-xl">🌙</span>
                    </button>

                    <div class="h-6 w-[1px] bg-gray-200 dark:bg-gray-800 mx-1 hidden sm:block"></div>

                    @auth
                    <div class="flex items-center gap-3">
                        <span class="hidden lg:block text-sm font-semibold text-gray-600 dark:text-gray-400">
                            {{ auth()->user()->name }}
                        </span>
                        <form action="/logout" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="text-sm font-bold text-red-500 hover:bg-red-50 dark:hover:bg-red-950/30 px-4 py-2 rounded-xl transition-all">
                                Logout
                            </button>
                        </form>
                    </div>
                    @else
                    <div class="flex items-center gap-1 md:gap-3">
                        <a href="/login" class="text-sm font-bold text-gray-600 dark:text-gray-300 px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-800 rounded-xl transition-all">
                            Login
                        </a>
                        <a href="/register" class="text-sm font-bold bg-gray-900 dark:bg-blue-600 text-white px-5 py-2.5 rounded-xl hover:shadow-xl hover:shadow-blue-500/20 active:scale-95 transition-all">
                            Join Now
                        </a>
                    </div>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <main class="container mx-auto px-4 md:px-6 py-10 min-h-[calc(100vh-180px)]">
        @yield('content')
    </main>

    <footer class="border-t border-gray-100 dark:border-gray-900 py-10 bg-white dark:bg-gray-950">
        <div class="container mx-auto px-4 text-center">
            <p class="text-sm text-gray-500 dark:text-gray-500 font-medium">
                © {{ date('Y') }} GTW Blog System. 
            </p>
        </div>
    </footer>

    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
    <script>
        // Dark Mode Logic
        const toggleBtn = document.getElementById('theme-toggle');
        const icon = document.getElementById('theme-toggle-icon');
        const htmlElement = document.documentElement;

        if (localStorage.getItem('theme') === 'dark') {
            htmlElement.classList.add('dark');
            icon.innerText = '☀️';
        }

        toggleBtn.addEventListener('click', () => {
            htmlElement.classList.toggle('dark');
            const isDark = htmlElement.classList.contains('dark');
            localStorage.setItem('theme', isDark ? 'dark' : 'light');
            icon.innerText = isDark ? '☀️' : '🌙';
        });

        // Initialize CKEditor
        const editorElement = document.querySelector('textarea[name="content"]');
        if (editorElement) {
            ClassicEditor.create(editorElement).catch(e => console.error(e));
        }
    </script>
</body>
</html>