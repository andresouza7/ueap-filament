<!-- resources/views/partials/footer.blade.php -->
<footer class="w-full border-t bg-white pb-12">
    <div class="relative w-full flex items-center invisible md:visible md:pb-12">
        <button class="absolute bg-blue-800 hover:bg-blue-700 text-white text-2xl font-bold hover:shadow rounded-full w-16 h-16 ml-12"
                x-on:click="decrement()">&#8592;</button>
        @for ($i = 0; $i < 5; $i++)
            <img class="w-1/6 hover:opacity-75" src="https://picsum.photos/200" />
        @endfor
        <button class="absolute right-0 bg-blue-800 hover:bg-blue-700 text-white text-2xl font-bold hover:shadow rounded-full w-16 h-16 mr-12"
                x-on:click="increment()">&#8594;</button>
    </div>
    <div class="w-full container mx-auto flex flex-col items-center">
        <div class="flex flex-col md:flex-row text-center md:text-left md:justify-between py-6">
            <a href="#" class="uppercase px-3">About Us</a>
            <a href="#" class="uppercase px-3">Privacy Policy</a>
            <a href="#" class="uppercase px-3">Terms & Conditions</a>
            <a href="#" class="uppercase px-3">Contact Us</a>
        </div>
        <div class="uppercase pb-6">&copy; myblog.com</div>
    </div>
</footer>
