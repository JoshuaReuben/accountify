  @props(['message' => 'Create', 'icon' => 'fa-solid fa-plus', 'space' => '&nbsp;'])

  <button type="button"
      {{ $attributes->merge(['class' => 'focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800 disabled:cursor-not-allowed disabled:opacity-50']) }}>
      {{ $message }}

      @if ($icon != 'none')
          {!! $space !!}
          <i class="{{ $icon }}"></i>
      @endif

  </button>
