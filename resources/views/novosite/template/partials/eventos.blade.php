 <!-- Próximos Eventos -->
 <div class="container mx-auto w-full max-w-screen-xl px-4 lg:px-8 py-16">
     <!-- Título da Seção -->
     <h2 class="text-4xl font-bold text-gray-900 mb-8 text-center">Eventos</h2>

     <!-- Grid de Eventos -->
     <div class="grid md:grid-cols-3 gap-8">
         @foreach ($events as $event)
             <div
                 class="bg-white rounded-xl overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300 border border-gray-100">
                 <!-- Imagem do Evento (opcional) -->
                 <div class="h-48 bg-gray-200 overflow-hidden">
                     <img src="{{ $event->image_url ?? 'https://placehold.co/400x200' }}" alt="{{ $event->title }}"
                         class="w-full h-full object-cover">
                 </div>

                 <!-- Conteúdo do Evento -->
                 <div class="p-4">
                     <!-- Título do Evento -->
                     <h3 class="text-base font-semibold text-gray-900 mb-2">{{ substr($event->title, 0, 80) . '...' }}
                     </h3>

                     <!-- Botão "Saiba Mais" -->
                     <a href="{{ route('novosite.post.show', $event->slug) }}"
                         class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium transition-colors duration-200">
                         Saiba mais
                         <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                             xmlns="http://www.w3.org/2000/svg">
                             <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                             </path>
                         </svg>
                     </a>
                 </div>
             </div>
         @endforeach
     </div>

     <!-- Botão "Ver Todos os Eventos" (opcional) -->
     <div class="text-center mt-12">
         <a href="{{ route('novosite.post.list') }}"
             class="inline-block px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition-colors duration-200">
             Ver Todos os Eventos
         </a>
     </div>
 </div>
