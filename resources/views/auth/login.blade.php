@extends('layouts.app')

@section('content')
<div class="min-h-[80vh] flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8 bg-white dark:bg-gray-800 p-10 rounded-[2.5rem] shadow-2xl shadow-blue-500/10 dark:shadow-none border border-gray-100 dark:border-gray-700 transition-all duration-300">
        
        <div class="text-center">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-blue-600 text-white mb-4 shadow-lg shadow-blue-500/40">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
            </div>
            <h2 class="text-3xl font-black text-gray-900 dark:text-white tracking-tight">Welcome Back</h2>
            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400 font-medium">Log in to manage your stories</p>
        </div>

        <form class="mt-8 space-y-6" action="{{ route('login') }}" method="POST">
            @csrf
            <div class="space-y-4">
                <div>
                    <label class="block text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-widest ml-1 mb-1">Email Address</label>
                    <input type="email" name="email" required 
                        class="block w-full px-4 py-4 bg-gray-50 dark:bg-gray-900/50 border-none rounded-2xl text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 transition-all placeholder-gray-400" 
                        placeholder="name@company.com">
                    @error('email') <span class="text-red-500 text-xs mt-2 ml-1 font-bold">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-widest ml-1 mb-1">Password</label>
                    <input type="password" name="password" required 
                        class="block w-full px-4 py-4 bg-gray-50 dark:bg-gray-900/50 border-none rounded-2xl text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 transition-all placeholder-gray-400" 
                        placeholder="••••••••">
                </div>
            </div>

            <div>
                <button type="submit" class="group relative w-full flex justify-center py-4 px-4 border border-transparent text-sm font-black rounded-2xl text-white bg-gray-900 dark:bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all shadow-xl active:scale-95">
                    Sign In
                </button>
            </div>
        </form>

        <div class="text-center pt-4">
            <p class="text-sm text-gray-600 dark:text-gray-400 font-medium">
                New here? 
                <a href="/register" class="text-blue-600 dark:text-blue-400 hover:underline font-bold transition-all">Create account</a>
            </p>
        </div>
    </div>
</div>
@endsection