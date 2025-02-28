<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <!-- Existing head content -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Gemini Conversation</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
        
        <!-- Add Marked.js for Markdown rendering -->
        <script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
        
        <!-- Optional: Add highlight.js for code syntax highlighting -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/highlight.js@11.7.0/styles/github-dark.css">
        <script src="https://cdn.jsdelivr.net/npm/highlight.js@11.7.0/lib/highlight.min.js"></script>

        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <!-- Additional styles for markdown content -->
        <style>
            .markdown-body {
                font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Helvetica, Arial, sans-serif;
                line-height: 1.6;
                font-size: 1rem; /* Slightly larger font */
            }
            .markdown-body p {
                margin-bottom: 1em;
            }
            .markdown-body h1, .markdown-body h2, .markdown-body h3, 
            .markdown-body h4, .markdown-body h5, .markdown-body h6 {
                margin-top: 1.5em;
                margin-bottom: 0.5em;
                font-weight: 600;
                line-height: 1.25;
            }
            .markdown-body h1 { font-size: 1.75em; }
            .markdown-body h2 { font-size: 1.5em; }
            .markdown-body h3 { font-size: 1.3em; }
            .markdown-body ul, .markdown-body ol {
                padding-left: 2em;
                margin-bottom: 1em;
            }
            .markdown-body ul { list-style-type: disc; }
            .markdown-body ol { list-style-type: decimal; }
            .markdown-body li { margin-bottom: 0.5em; }
            .markdown-body img {
                max-width: 100%;
                height: auto;
                margin: 1em 0;
                border-radius: 4px;
            }
            .markdown-body code {
                font-family: SFMono-Regular, Consolas, Liberation Mono, Menlo, monospace;
                padding: 0.2em 0.4em;
                margin: 0;
                font-size: 90%;
                background-color: rgba(175, 184, 193, 0.2);
                border-radius: 6px;
            }
            .markdown-body pre {
                padding: 16px;
                overflow: auto;
                font-size: 90%;
                line-height: 1.45;
                background-color: #2d333b;
                border-radius: 6px;
                margin-bottom: 1em;
                max-width: 100%;
                overflow-x: auto;
            }
            .markdown-body pre code {
                background-color: transparent;
                padding: 0;
                display: block;
                overflow-x: auto;
                max-width: 100%;
            }
            .markdown-body blockquote {
                padding: 0.5em 1em;
                color: #57606a;
                border-left: 0.25em solid #d0d7de;
                margin: 1em 0;
                background-color: rgba(175, 184, 193, 0.1);
                border-radius: 0 6px 6px 0;
            }
            .markdown-body table {
                border-spacing: 0;
                border-collapse: collapse;
                margin: 1em 0;
                width: 100%;
                overflow: auto;
                display: block;
            }
            .markdown-body table th, .markdown-body table td {
                padding: 8px 13px;
                border: 1px solid #d0d7de;
            }
            .markdown-body table th {
                font-weight: 600;
                background-color: rgba(175, 184, 193, 0.1);
            }
            .dark .markdown-body code {
                background-color: rgba(110, 118, 129, 0.4);
            }
            .dark .markdown-body blockquote {
                color: #8b949e;
                border-left-color: #30363d;
                background-color: rgba(110, 118, 129, 0.1);
            }
            .dark .markdown-body table th {
                background-color: rgba(56, 58, 61, 0.5);
            }
            .dark .markdown-body table th, .dark .markdown-body table td {
                border-color: #30363d;
            }
        </style>
    </head>
    <body class="antialiased bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-900 dark:to-gray-800 min-h-screen flex flex-col">
        <header class="bg-white dark:bg-gray-900 shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 flex justify-between items-center">
                <a href="/" class="flex items-center">
                    <div class="text-3xl font-bold bg-gradient-to-r from-indigo-600 to-purple-500 text-transparent bg-clip-text">
                        Gemini Chat
                    </div>
                </a>
                
                <!-- Navigation -->
                <nav class="flex space-x-4">
                    <a href="/" class="text-gray-700 dark:text-gray-300 hover:text-indigo-500 dark:hover:text-indigo-400 px-3 py-2 rounded-md text-sm font-medium">
                        Home
                    </a>
                </nav>
            </div>
        </header>

        <main class="flex-grow">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-xl p-6 max-w-5xl mx-auto">
                    <div class="mb-6">
                        <h1 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">Chat with Gemini AI</h1>
                        <p class="text-gray-600 dark:text-gray-400">Ask any question and get intelligent responses powered by Google's Gemini language model.</p>
                    </div>

                    <!-- Chat History Container -->
                    <div id="chat-container" class="mb-4 h-[32rem] overflow-y-auto p-4 border border-gray-200 dark:border-gray-700 rounded-lg">
                        <div id="chat-messages">
                            <!-- Messages will be inserted here by JavaScript -->
                            <div class="flex items-start space-x-4 mb-4">
                                <div class="flex-shrink-0 bg-indigo-500 rounded-full p-2">
                                    <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                    </svg>
                                </div>
                                <div class="ml-3 bg-gray-100 dark:bg-gray-700 rounded-lg p-4 max-w-[80%] shadow-sm">
                                    <div class="text-sm text-gray-900 dark:text-gray-100 markdown-body">
                                        <p>Hello! I'm <strong>Google Gemini</strong>. How can I help you today?</p>
                                        <p>I can assist with:</p>
                                        <ul>
                                            <li>Answering questions</li>
                                            <li>Providing explanations</li>
                                            <li>Writing content</li>
                                            <li>And much more!</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Input form -->
                    <form id="chat-form" class="flex space-x-2">
                        @csrf
                        <input
                            type="text"
                            id="user-input"
                            name="message"
                            class="flex-1 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 px-4 py-2 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-indigo-500"
                            placeholder="Type your message..."
                            required
                        />
                        <button
                            type="submit"
                            class="rounded-lg bg-indigo-600 px-4 py-2 text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        >
                            Send
                        </button>
                        <button
                            type="button"
                            id="clear-chat"
                            class="rounded-lg bg-gray-200 dark:bg-gray-600 px-4 py-2 text-gray-700 dark:text-gray-200 hover:bg-gray-300 dark:hover:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-500"
                        >
                            Clear
                        </button>
                    </form>
                </div>
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

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Configure Marked.js for security and features
                marked.setOptions({
                    renderer: new marked.Renderer(),
                    highlight: function(code, language) {
                        if (language && hljs.getLanguage(language)) {
                            return hljs.highlight(code, { language }).value;
                        }
                        return hljs.highlightAuto(code).value;
                    },
                    langPrefix: 'hljs language-',
                    pedantic: false,
                    gfm: true,
                    breaks: true,
                    sanitize: false,
                    smartypants: true,
                    xhtml: false
                });
                
                // First, define the variables
                const chatForm = document.getElementById('chat-form');
                const userInput = document.getElementById('user-input');
                const chatMessages = document.getElementById('chat-messages');
                const clearChatButton = document.getElementById('clear-chat');
                
                // Then check if they exist
                console.log('Chat form found:', chatForm !== null);
                console.log('User input found:', userInput !== null);
                
                if (!chatForm || !userInput) {
                    console.error('Critical chat elements not found!');
                    return;
                }
                
                // Rest of the code...
                
                // Improve the fetch error handling
                chatForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    console.log('Form submitted');
                    
                    const message = userInput.value;
                    if (!message.trim()) {
                        console.log('Empty message, not sending');
                        return;
                    }
                    
                    console.log('Sending message:', message);
                    
                    // Add user message to chat
                    addMessage(message, true);
                    
                    // Clear input
                    userInput.value = '';
                    
                    // Show typing indicator
                    addTypingIndicator();
                    
                    // Send message to server with better debugging
                    fetch('{{ route("gemini.chat") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({
                            message: message
                        })
                    })
                    .then(response => {
                        console.log('Response status:', response.status);
                        if (!response.ok) {
                            throw new Error(`Server responded with ${response.status}`);
                        }
                        return response.json();
                    })
                    .then(data => {
                        console.log('Response data received:', data);
                        removeTypingIndicator();
                        
                        if (data.response) {
                            addMessage(data.response, false);
                        } else if (data.error) {
                            addMessage('Error: ' + data.error, false);
                        } else {
                            addMessage('Received an empty response from the server', false);
                        }
                        
                        scrollToBottom();
                    })
                    .catch(error => {
                        console.error('Fetch error:', error);
                        removeTypingIndicator();
                        addMessage('Sorry, I encountered an error: ' + error.message, false);
                        scrollToBottom();
                    });
                });
                
                // Clear chat history
                clearChatButton.addEventListener('click', function() {
                    fetch('{{ route("gemini.clear") }}', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        chatMessages.innerHTML = '';
                        // Add welcome message with enhanced markdown
                        const welcomeMessage = `
# Welcome to Gemini Chat!

I'm **Google Gemini**, an AI language model that can help you with a variety of tasks.

## What I can do:

- Answer questions and provide explanations
- Generate creative content like stories or poems
- Help with coding problems
- Summarize information
- And much more!

Feel free to ask me anything, and I'll do my best to assist you.

> **Tip**: Try asking me to format information in tables or create code examples for a nice demonstration of markdown capabilities!
`;
                        addMessage(welcomeMessage, false);
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
                });
                
                // Function to add message to chat
                function addMessage(message, isUser) {
                    const messageDiv = document.createElement('div');
                    messageDiv.className = `flex items-start space-x-4 mb-4 ${isUser ? 'justify-end' : ''}`;
                    
                    // Prepare the message content - render markdown for AI responses only
                    const messageContent = isUser 
                        ? message 
                        : marked.parse(message); // Parse markdown for AI responses
                    
                    if (isUser) {
                        messageDiv.innerHTML = `
                            <div class="mr-3 bg-indigo-100 dark:bg-indigo-900 rounded-lg p-4 max-w-[80%] shadow-sm">
                                <p class="text-sm text-gray-900 dark:text-gray-100">
                                    ${message}
                                </p>
                            </div>
                            <div class="flex-shrink-0 bg-green-500 rounded-full p-2">
                                <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                        `;
                    } else {
                        messageDiv.innerHTML = `
                            <div class="flex-shrink-0 bg-indigo-500 rounded-full p-2">
                                <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                </svg>
                            </div>
                            <div class="ml-3 bg-gray-100 dark:bg-gray-700 rounded-lg p-5 max-w-[85%] shadow-sm">
                                <div class="text-sm text-gray-900 dark:text-gray-100 markdown-body">
                                    ${messageContent}
                                </div>
                            </div>
                        `;
                    }
                    
                    chatMessages.appendChild(messageDiv);
                    
                    // Apply syntax highlighting to code blocks
                    if (!isUser) {
                        messageDiv.querySelectorAll('pre code').forEach((block) => {
                            hljs.highlightElement(block);
                        });
                    }
                    
                    scrollToBottom();
                }
                
                // Function to add typing indicator
                function addTypingIndicator() {
                    const typingDiv = document.createElement('div');
                    typingDiv.id = 'typing-indicator';
                    typingDiv.className = 'flex items-start space-x-4 mb-4';
                    typingDiv.innerHTML = `
                        <div class="flex-shrink-0 bg-indigo-500 rounded-full p-2">
                            <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                            </svg>
                        </div>
                        <div class="ml-3 bg-gray-100 dark:bg-gray-700 rounded-lg p-4 shadow-sm">
                            <div class="flex space-x-2">
                                <div class="w-2 h-2 rounded-full bg-gray-500 dark:bg-gray-400 animate-pulse"></div>
                                <div class="w-2 h-2 rounded-full bg-gray-500 dark:bg-gray-400 animate-pulse" style="animation-delay: 0.2s"></div>
                                <div class="w-2 h-2 rounded-full bg-gray-500 dark:bg-gray-400 animate-pulse" style="animation-delay: 0.4s"></div>
                            </div>
                        </div>
                    `;
                    chatMessages.appendChild(typingDiv);
                    scrollToBottom();
                }
                
                // Function to remove typing indicator
                function removeTypingIndicator() {
                    const typingIndicator = document.getElementById('typing-indicator');
                    if (typingIndicator) {
                        typingIndicator.remove();
                    }
                }
                
                // Function to scroll chat to bottom
                function scrollToBottom() {
                    const chatContainer = document.getElementById('chat-container');
                    chatContainer.scrollTop = chatContainer.scrollHeight;
                }
                
                // Allow submitting form with Enter (but Shift+Enter for new line)
                userInput.addEventListener('keydown', function(e) {
                    if (e.key === 'Enter' && !e.shiftKey) {
                        e.preventDefault();
                        chatForm.dispatchEvent(new Event('submit'));
                    }
                });
            });
        </script>
    </body>
</html>