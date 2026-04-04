@extends('layouts.app')

@section('content')
<div class="min-h-[85vh] flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-lg w-full space-y-8 bg-white dark:bg-gray-800 p-10 rounded-[2.5rem] shadow-2xl shadow-indigo-500/10 dark:shadow-none border border-gray-100 dark:border-gray-700 transition-all duration-300">
        
        <div class="text-center">
            <h2 class="text-4xl font-black text-gray-900 dark:text-white tracking-tight">Join the Community</h2>
            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400 font-medium">Start sharing your thoughts with the world</p>
        </div>

        <form class="mt-8 space-y-5" action="{{ route('register') }}" method="POST">
            @csrf
            
            <div class="grid grid-cols-1 gap-5">
                <div>
                    <label class="block text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-widest ml-1 mb-1">Full Name</label>
                    <input type="text" name="name" value="{{ old('name') }}" required 
                        class="block w-full px-4 py-3.5 bg-gray-50 dark:bg-gray-900/50 border-none rounded-2xl text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 transition-all" 
                        placeholder="John Doe">
                    @error('name') <span class="text-red-500 text-xs mt-1 ml-1 font-bold">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-widest ml-1 mb-1">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required 
                        class="block w-full px-4 py-3.5 bg-gray-50 dark:bg-gray-900/50 border-none rounded-2xl text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 transition-all" 
                        placeholder="john@example.com">
                    @error('email') <span class="text-red-500 text-xs mt-1 ml-1 font-bold">{{ $message }}</span> @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-widest ml-1 mb-1">Password</label>
                        <input type="password" name="password" required 
                            class="block w-full px-4 py-3.5 bg-gray-50 dark:bg-gray-900/50 border-none rounded-2xl text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 transition-all">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-widest ml-1 mb-1">Confirm</label>
                        <input type="password" name="password_confirmation" required 
                            class="block w-full px-4 py-3.5 bg-gray-50 dark:bg-gray-900/50 border-none rounded-2xl text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 transition-all">
                    </div>
                </div>
            </div>

            <div class="pt-2">
                <button type="submit" class="w-full flex justify-center py-4 px-4 border border-transparent text-sm font-black rounded-2xl text-white bg-indigo-600 hover:bg-indigo-700 shadow-xl shadow-indigo-500/20 active:scale-95 transition-all">
                    Create Account
                </button>
            </div>
        </form>

        <div class="text-center pt-4 border-t border-gray-50 dark:border-gray-700">
            <p class="text-sm text-gray-600 dark:text-gray-400 font-medium">
                Already have an account? 
                <a href="{{ route('login') }}" class="text-indigo-600 dark:text-indigo-400 hover:underline font-bold">Sign in here</a>
            </p>
        </div>
    </div>
</div>
@endsection