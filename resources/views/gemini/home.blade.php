<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Gemini Chat - AI Conversations</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-900 dark:to-gray-800 min-h-screen flex flex-col">
        <header class="bg-white dark:bg-gray-900 shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 flex justify-between items-center">
                <div class="flex items-center">
                    <!-- Logo -->
                    <div class="text-3xl font-bold bg-gradient-to-r from-indigo-600 to-purple-500 text-transparent bg-clip-text">
                        Gemini Chat
                    </div>
                </div>
                
                <!-- Navigation -->
                <nav class="flex space-x-4">
                    <!-- We're removing auth checks for now -->
                    <a href="{{ url('/gemini') }}" class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-300 bg-indigo-50 dark:bg-indigo-900/30 px-3 py-2 rounded-md text-sm font-medium">
                        Start Chatting
                    </a>
                </nav>
            </div>
        </header>

        <main class="flex-grow">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                <!-- Hero Section -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center mb-20">
                    <div>
                        <h1 class="text-4xl sm:text-5xl font-bold text-gray-900 dark:text-white mb-6 leading-tight">
                            Unlock the Power of <span class="bg-gradient-to-r from-indigo-600 to-purple-500 text-transparent bg-clip-text">Google Gemini AI</span>
                        </h1>
                        <p class="text-xl text-gray-700 dark:text-gray-300 mb-8">
                            Engage in intelligent conversations, solve complex problems, and spark your creativity with advanced AI technology.
                        </p>
                        <a href="{{ url('/gemini') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition">
                            Try Gemini Chat
                            <svg class="ml-2 -mr-1 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    </div>
                    <div class="relative">
                        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-xl p-6 relative z-10 transform transition hover:-translate-y-1 hover:shadow-2xl">
                            <div class="flex items-start space-x-4 mb-4">
                                <div class="flex-shrink-0 bg-indigo-500 rounded-full p-2">
                                    <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                    </svg>
                                </div>
                                <div class="ml-3 bg-gray-100 dark:bg-gray-700 rounded-lg p-4 max-w-[80%] shadow-sm">
                                    <p class="text-sm text-gray-900 dark:text-gray-100">
                                        Hello! I'm Google Gemini. How can I help you today?
                                    </p>
                                </div>
                            </div>
                            <div class="flex items-start space-x-4 mb-4 justify-end">
                                <div class="mr-3 bg-indigo-100 dark:bg-indigo-900 rounded-lg p-4 max-w-[80%] shadow-sm">
                                    <p class="text-sm text-gray-900 dark:text-gray-100">
                                        Can you explain how machine learning works?
                                    </p>
                                </div>
                                <div class="flex-shrink-0 bg-green-500 rounded-full p-2">
                                    <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="flex items-start space-x-4">
                                <div class="flex-shrink-0 bg-indigo-500 rounded-full p-2">
                                    <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                    </svg>
                                </div>
                                <div class="ml-3 bg-gray-100 dark:bg-gray-700 rounded-lg p-4 max-w-[80%] shadow-sm">
                                    <p class="text-sm text-gray-900 dark:text-gray-100">
                                        Machine learning is a subset of AI where systems learn from data without explicit programming. It involves training algorithms on datasets to identify patterns and make predictions. Key approaches include supervised learning, unsupervised learning, and reinforcement learning.
                                    </p>
                                </div>
                            </div>
                            
                            <!-- Chat Input Animation -->
                            <div class="mt-6 relative">
                                <div class="bg-gray-100 dark:bg-gray-700 rounded-full p-3 flex items-center">
                                    <input type="text" disabled placeholder="Type your message..." class="bg-transparent border-none w-full focus:outline-none text-gray-600 dark:text-gray-300 placeholder-gray-500 dark:placeholder-gray-400">
                                    <button disabled class="ml-2 flex-shrink-0 bg-indigo-500 text-white p-2 rounded-full">
                                        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11h2v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Decorative elements -->
                        <div class="absolute -bottom-6 -right-6 w-64 h-64 bg-gradient-to-r from-purple-200 to-indigo-200 dark:from-purple-900/30 dark:to-indigo-900/30 rounded-full filter blur-3xl opacity-30 animate-pulse"></div>
                        <div class="absolute -top-6 -left-6 w-64 h-64 bg-gradient-to-r from-indigo-200 to-purple-200 dark:from-indigo-900/30 dark:to-purple-900/30 rounded-full filter blur-3xl opacity-30 animate-pulse" style="animation-delay: 1s;"></div>
                    </div>
                </div>

                <!-- Features Section -->
                <div class="mb-20">
                    <h2 class="text-3xl font-bold text-center text-gray-900 dark:text-white mb-12">
                        What You Can Do With Gemini AI
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-6 transform transition hover:-translate-y-1 hover:shadow-lg">
                            <div class="w-12 h-12 bg-indigo-100 dark:bg-indigo-900/50 rounded-full flex items-center justify-center mb-4">
                                <svg class="h-6 w-6 text-indigo-600 dark:text-indigo-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Generate Creative Content</h3>
                            <p class="text-gray-600 dark:text-gray-400">
                                Get help writing stories, poems, marketing copy, and more with advanced AI-powered content generation.
                            </p>
                        </div>
                        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-6 transform transition hover:-translate-y-1 hover:shadow-lg">
                            <div class="w-12 h-12 bg-indigo-100 dark:bg-indigo-900/50 rounded-full flex items-center justify-center mb-4">
                                <svg class="h-6 w-6 text-indigo-600 dark:text-indigo-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l3 3-3 3m5 0h3M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Code Assistance</h3>
                            <p class="text-gray-600 dark:text-gray-400">
                                Get programming help, debug code, understand algorithms, and learn new programming concepts.
                            </p>
                        </div>
                        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-6 transform transition hover:-translate-y-1 hover:shadow-lg">
                            <div class="w-12 h-12 bg-indigo-100 dark:bg-indigo-900/50 rounded-full flex items-center justify-center mb-4">
                                <svg class="h-6 w-6 text-indigo-600 dark:text-indigo-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Research & Learning</h3>
                            <p class="text-gray-600 dark:text-gray-400">
                                Explore topics, get explanations on complex subjects, and enhance your learning experience.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Call to Action -->
                {{-- <div class="bg-gradient-to-r from-indigo-600 to-purple-600 rounded-2xl shadow-xl p-8 mb-20">
                    <div class="max-w-3xl mx-auto text-center">
                        <h2 class="text-3xl font-bold text-white mb-4">Ready to Experience Gemini AI?</h2>
                        <p class="text-indigo-100 mb-8">
                            Start a conversation with one of the most advanced AI systems available today.
                        </p>
                        @auth
                            <a href="{{ route('gemini.conversation') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-indigo-600 bg-white hover:bg-indigo-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition">
                                Start Now
                                <svg class="ml-2 -mr-1 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </a>
                        @else
                            <a href="{{ route('register') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-indigo-600 bg-white hover:bg-indigo-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition">
                                Create Account
                                <svg class="ml-2 -mr-1 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </a>
                        @endauth
                    </div>
                </div> --}}
            </div>
        </main>

        <footer class="bg-white dark:bg-gray-900 border-t border-gray-200 dark:border-gray-800">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                <div class="text-center text-gray-500 dark:text-gray-400 text-sm">
                    <p>© {{ date('Y') }} Gemini Chat. Powered by Google Gemini API.</p>
                    <p class="mt-2">A Laravel Azure Workshop Project</p>
                </div>
            </div>
        </footer>
    </body>
</html>