
 <x-default-layout :title="$post->exists() ? 'modifier un post' : 'cree un post'">

    <form action="{{ $post->exists() ? route('admin.posts.update', ['post'=>$post]) : route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">

        @csrf
     @if ($post->exists)
     @method('PATCH')


     @endif

        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
                <h1 class="text-base font-semibold leading-7 text-gray-900">
                    {{ $post->exists() ? 'Modifier "'.$post->title.'"' : 'cree un post'   }}

                </h1>
                <p class="mt-1 text-sm leading-6 text-gray-600">revelons au monde nos talent de developeur.</p>

            <div class="mt-10 space-y-8 md:w-2/3">
               <x-input name="title" label="Titre" :value="$post->title" />
               <x-input name="slug" label="slug" :value="$post->slug" help="laisser vide pour un slug auto.
               si une valeur est renseignee, elle sera slugifiee avant d'etre soumis a validation"  />

               {{-- textarea content  --}}
               <x-textarea name="content"  label="contenu du post"> {{ $post->content }} </x-textarea>
               {{-- input file thumbnail  --}}

               <x-input name="thumbnail" type="file" label="vignette" :value="$post->thumbnail"  />

               {{-- select category_id  --}}
               {{-- select multiple tag_ids  --}}
               <x-select name="category_id" label="Categories" :list="$categories" :value="$post->category_id" />
               <x-select name="tag_ids" label="Etiquettes" multiple :list="$tags" :value="$post->tags "/>



            </div>
        </div>

        <div class="mt-6 flex items-center justify-end gap-x-6 " >
            <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">{{ $post->exists ? 'mettre a jour ' : 'cree un post' }}</button>
        </div>
    </form>

</x-default-layout>
