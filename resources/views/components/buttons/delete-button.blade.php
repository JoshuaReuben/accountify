  @props(['message' => 'Delete', 'icon' => 'fa-solid fa-trash-can', 'space' => '&nbsp;'])

  <button type="button"
      {{ $attributes->merge(['class' => 'focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900 disabled:cursor-not-allowed disabled:opacity-50']) }}>
      {{ $message }}

      @if ($icon != 'none')
          {!! $space !!}
          <i class="{{ $icon }}"></i>
      @endif

  </button>
