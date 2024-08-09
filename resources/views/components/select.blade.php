<div>

    <div>

        <div>
            <label for="{{ $id }}" class="block text-sm font-medium leading-6 text-gray-900">{{$label}}</label>
            <div class="
                mt-2"  >
                <select
                  id="{{ $id }}"
                 name="{{$name .($multiple ? '[]' : '') }}"

             @class([
               'form-textarea block w-full rounded-md border-0 py-1.5
             ring-1 ring-inset sm:max-w-xs  focus:ring-2 focus:ring-inset  sm:text-sm sm:leading-6',

             'pr-10 text-red-300  focus:ring-red-300  ' =>$errors->has($name),

             'text-gray-900 ring-gray-300 focus:ring-indigo-600'=> ! $errors->has($name),

             'form-select' => ! $multiple,
             'form-multiselect' => ! $multiple,
             ])

             @if ($multiple) multiple @endif

          >

          @foreach ($list as $item)

          <option value="{{ $item->$optionsValues }}"

            @selected($valueIsCollection ? $value->contains($item->$optionsValues) :$item->optionsValues == $value ) >

            {{ $item->$optionsTexts }}

          </option>



          @endforeach



            @error($name)

            <p class="mt-2 text-sm text-red-600"> {{  $message }}</p>

            @enderror

            @if ($help)
         <p class=" mt-4 text-sm text-gray-500">{{$help}} </p>
            @endif


                </select>
        </div>


    </div>



</div>
