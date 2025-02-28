<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
    <head>
        <!-- Existing head content -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Gemini Conversation</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
        
        <!-- Make sure highlight.js is loaded before marked.js -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/highlight.js@11.7.0/styles/github-dark.css">
        <script src="https://cdn.jsdelivr.net/npm/highlight.js@11.7.0/lib/highlight.min.js"></script>
        
        <!-- Add Marked.js for Markdown rendering -->
        <script src="https://cdn.jsdelivr.net/npm/marked@4.0.0/marked.min.js"></script>

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
            /* Add this to ensure the page takes full height */
            html, body {
                height: 100%;
                margin: 0;
                padding: 0;
                overflow: hidden;
            }
            
            /* Make the chat area take up available space */
            .chat-layout {
                display: flex;
                flex-direction: column;
                height: 100vh;
            }
            
            .chat-body {
                flex: 1;
                display: flex;
                flex-direction: column;
                overflow: hidden;
            }
            
            .chat-container {
                flex: 1;
                overflow-y: auto;
                padding: 1rem;
            }
            
            .input-container {
                padding: 1rem;
                border-top: 1px solid;
                border-color: #e5e7eb;
            }
            
            .dark .input-container {
                border-color: #374151;
            }
            
            .header-container {
                padding: 1rem;
                border-bottom: 1px solid;
                border-color: #e5e7eb;
            }
            
            .dark .header-container {
                border-color: #374151;
            }
        </style>
    </head>
    <body class="antialiased bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-900 dark:to-gray-800 h-full">
        <div class="chat-layout">
            <!-- Simplified Header -->
            <header class="header-container bg-white dark:bg-gray-900 shadow-sm">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center">
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
                        <button
                            id="clear-chat"
                            class="text-gray-700 dark:text-gray-300 hover:text-red-500 dark:hover:text-red-400 px-3 py-2 rounded-md text-sm font-medium"
                        >
                            Clear Chat
                        </button>
                    </nav>
                </div>
            </header>

            <main class="chat-body">
                <!-- Chat History Container - Now takes full available height -->
                <div id="chat-container" class="chat-container border-gray-200 dark:border-gray-700">
                    <div id="chat-messages" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <!-- Initial welcome message -->
                        <div class="flex items-start space-x-4 mb-4 justify-start">
                            <div class="flex-shrink-0 bg-indigo-500 rounded-full p-2">
                                <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                </svg>
                            </div>
                            <div class="ml-3 bg-gray-100 dark:bg-gray-700 rounded-lg p-4 max-w-[70%] shadow-sm">
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

                <!-- Input form - Fixed at bottom -->
                <div class="input-container bg-white dark:bg-gray-900">
                    <form id="chat-form" class="flex space-x-2 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" >
                        @csrf
                        <input
                            type="text"
                            id="user-input"
                            name="message"
                            class="flex-1 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 px-4 py-3 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-indigo-500"
                            placeholder="Type your message..."
                            required
                        />
                        <button
                            type="button"
                            id="send-button"
                            class="rounded-lg bg-indigo-600 px-4 py-2 text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        >
                            Send
                        </button>
                    </form>
                </div>
            </main>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Check if highlight.js is properly loaded
                if (typeof hljs === 'undefined') {
                    console.error('Highlight.js is not loaded properly!');
                    
                    // Fall back to a simpler highlighting function if hljs is not available
                    marked.setOptions({
                        highlight: function(code, language) {
                            return code;
                        }
                    });
                } else {
                    // Configure Marked.js with hljs
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
                }
                
                // First, define the variables
                const chatForm = document.getElementById('chat-form');
                const userInput = document.getElementById('user-input');
                const sendButton = document.getElementById('send-button');
                const chatMessages = document.getElementById('chat-messages');
                const clearChatButton = document.getElementById('clear-chat');
                
                // Then check if they exist
                console.log('Chat form found:', chatForm !== null);
                console.log('User input found:', userInput !== null);
                
                if (!chatForm || !userInput) {
                    console.error('Critical chat elements not found!');
                    return;
                }
                
                // Create a function to handle sending messages
                function sendMessage() {
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
                        console.log('Response received:', response);
                        console.log('Response status:', response.status);
                        console.log('Response headers:', [...response.headers.entries()]);
                        
                        if (!response.ok) {
                            throw new Error(`Server responded with ${response.status}`);
                        }
                        return response.json().catch(e => {
                            console.error('Error parsing JSON:', e);
                            throw new Error('Invalid JSON response from server');
                        });
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
                }
                
                // Handle form submission via button click
                sendButton.addEventListener('click', sendMessage);
                
                // Handle form submission via Enter key
                userInput.addEventListener('keydown', function(e) {
                    if (e.key === 'Enter' && !e.shiftKey) {
                        e.preventDefault();
                        sendMessage();
                    }
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
                    messageDiv.className = `flex items-start space-x-4 mb-4 ${isUser ? 'justify-end' : 'justify-start'}`;
                    
                    // Prepare the message content - render markdown for AI responses only
                    let messageContent = message;
                    if (!isUser) {
                        try {
                            messageContent = marked.parse(message);
                        } catch (e) {
                            console.error('Markdown parsing error:', e);
                            // Fall back to plain text if markdown parsing fails
                            messageContent = `<p>${message}</p>`;
                        }
                    }
                    
                    if (isUser) {
                        messageDiv.innerHTML = `
                            <div class="bg-indigo-100 dark:bg-indigo-900 rounded-lg p-4 max-w-[70%] shadow-sm ml-auto mr-3">
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
                            <div class="ml-3 bg-gray-100 dark:bg-gray-700 rounded-lg p-5 max-w-[70%] shadow-sm">
                                <div class="text-sm text-gray-900 dark:text-gray-100 markdown-body">
                                    ${messageContent}
                                </div>
                            </div>
                        `;
                    }
                    
                    chatMessages.appendChild(messageDiv);
                    
                    // Apply syntax highlighting with error handling
                    if (!isUser) {
                        try {
                            if (typeof hljs !== 'undefined') {
                                messageDiv.querySelectorAll('pre code').forEach((block) => {
                                    hljs.highlightElement(block);
                                });
                            }
                        } catch (e) {
                            console.error('Syntax highlighting error:', e);
                        }
                    }
                    
                    scrollToBottom();
                }
                
                // Function to add typing indicator
                function addTypingIndicator() {
                    const typingDiv = document.createElement('div');
                    typingDiv.id = 'typing-indicator';
                    typingDiv.className = 'flex items-start space-x-4 mb-4 justify-start';
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
                        sendMessage(); // Call sendMessage directly instead of dispatching an event
                    }
                });

                // Make sure the focus is on the input field when the page loads
                userInput.focus();

                // Handle form submission to prevent default behavior
                chatForm.addEventListener('submit', function(e) {
                    e.preventDefault(); // Stop form from submitting normally
                    sendMessage();
                });

                // Handle button click
                sendButton.addEventListener('click', sendMessage);

                // Add a custom renderer to add copy buttons to code blocks
                const renderer = new marked.Renderer();
                renderer.code = function(code, language) {
                    const validLanguage = language || 'plaintext';
                    const escapedCode = code.replace(/"/g, '&quot;').replace(/'/g, '&#39;');
                    
                    return `<div class="code-container relative">
                        <pre><code class="language-${validLanguage}">${code}</code></pre>
                        <button class="copy-code-btn absolute top-2 right-2 bg-gray-700 hover:bg-gray-600 text-white text-xs font-medium py-1 px-2 rounded focus:outline-none focus:ring-1 focus:ring-blue-500">
                            Copy
                        </button>
                    </div>`;
                };

                // Update marked.js to use the custom renderer
                marked.setOptions({
                    renderer: renderer,
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

                // Function to attach copy button functionality to code blocks
                function attachCopyButtons() {
                    document.querySelectorAll('.copy-code-btn').forEach(button => {
                        if (!button.hasAttribute('data-listener')) {
                            button.setAttribute('data-listener', 'true');
                            button.addEventListener('click', function() {
                                const codeBlock = this.previousElementSibling.querySelector('code');
                                const textToCopy = codeBlock.innerText;
                                
                                navigator.clipboard.writeText(textToCopy).then(() => {
                                    // Change button text temporarily to show success
                                    const originalText = this.textContent;
                                    this.textContent = 'Copied!';
                                    this.classList.remove('bg-gray-700', 'hover:bg-gray-600');
                                    this.classList.add('bg-green-600', 'hover:bg-green-500');
                                    
                                    // Revert button text after a short delay
                                    setTimeout(() => {
                                        this.textContent = originalText;
                                        this.classList.remove('bg-green-600', 'hover:bg-green-500');
                                        this.classList.add('bg-gray-700', 'hover:bg-gray-600');
                                    }, 1500);
                                }).catch(err => {
                                    console.error('Failed to copy text: ', err);
                                    // Show error feedback
                                    const originalText = this.textContent;
                                    this.textContent = 'Error';
                                    this.classList.remove('bg-gray-700', 'hover:bg-gray-600');
                                    this.classList.add('bg-red-600', 'hover:bg-red-500');
                                    
                                    // Revert button text after a short delay
                                    setTimeout(() => {
                                        this.textContent = originalText;
                                        this.classList.remove('bg-red-600', 'hover:bg-red-500');
                                        this.classList.add('bg-gray-700', 'hover:bg-gray-600');
                                    }, 1500);
                                });
                            });
                        }
                    });
                }

                // Add CSS styles for code blocks and copy buttons
                const styleElement = document.createElement('style');
                styleElement.textContent = `
                    .code-container {
                        position: relative;
                        margin-bottom: 1em;
                    }
                    
                    .copy-code-btn {
                        opacity: 0;
                        transition: opacity 0.2s ease-in-out;
                    }
                    
                    .code-container:hover .copy-code-btn {
                        opacity: 1;
                    }
                    
                    pre {
                        position: relative;
                        border-radius: 6px;
                    }
                `;
                document.head.appendChild(styleElement);

                // Update the addMessage function to attach copy buttons
                const originalAddMessage = addMessage;
                addMessage = function(message, isUser) {
                    originalAddMessage(message, isUser);
                    if (!isUser) {
                        setTimeout(() => {
                            attachCopyButtons();
                        }, 100);
                    }
                };

                // Also attach copy buttons to any code blocks that might be in the initial welcome message
                setTimeout(attachCopyButtons, 500);

                console.log('CSRF token:', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
            });
        </script>
    </body>
</html>