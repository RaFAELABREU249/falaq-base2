<button {{ $attributes->merge([
    'type' => 'submit',
    'class' => 'inline-flex items-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white transition-colors hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 focus:ring-offset-gray-900',
]) }}>
    {{ $slot }}
</button>