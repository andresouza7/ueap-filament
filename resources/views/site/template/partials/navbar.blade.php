{{-- resources/views/partials/navbar.blade.php --}}
<nav class="bg-white shadow-md p-4">
    <div class="container mx-auto flex justify-between items-center">
        <a href="#" class="text-blue-600 font-bold text-xl">Universidade</a>
        <button id="menu-toggle" class="lg:hidden">☰</button>
        <ul id="menu" class="hidden lg:flex space-x-4">
            <li><a href="/" class="hover:text-blue-600">Home</a></li>
            <li><a href="/noticias" class="hover:text-blue-600">Notícias</a></li>
            <li><a href="/eventos" class="hover:text-blue-600">Eventos</a></li>
            <li><a href="/contato" class="hover:text-blue-600">Contato</a></li>
        </ul>
    </div>
</nav>
