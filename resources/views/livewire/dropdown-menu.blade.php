<div>
    <div>
        <button id="dropdownDelayButton{{ $id }}" data-dropdown-toggle="dropdownDelay{{ $id }}" data-dropdown-delay="500" data-dropdown-trigger="hover" class="hover:bg-gray-400 focus:ring-4 focus:outline-none focus:ring-green-300 rounded-md px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
            {{ $label }} <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
            </svg>
        </button>
    
        <!-- Dropdown menu -->
        <div id="dropdownDelay{{ $id }}" class="z-40 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDelayButton">
                @foreach ($items as $name => $url)
                    <li>
                        <a href="/{{ $url }}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                            {{ $name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
