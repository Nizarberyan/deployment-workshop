<?php
// Add to your navigation component or layout
<x-nav-link :href="route('gemini.conversation')" :active="request()->routeIs('gemini.conversation')">
    {{ __('Gemini AI Chat') }}
</x-nav-link>