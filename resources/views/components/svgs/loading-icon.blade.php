@props(['type' => 1])

<div>

    @if ($type == 1)
        <div role="status">
            <svg aria-hidden="true"
                {{ $attributes->merge(['class' => 'w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600 dark:fill-orange-500']) }}
                viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                    fill="currentColor" />
                <path
                    d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                    fill="currentFill" />
            </svg>
            <span class="sr-only">Loading...</span>
        </div>
    @endif

    @if ($type == 2)
        <!-- wider  -->
        <div class="text-blue-500 loader loader--style3 dark:text-orange-500 " title="2">
            <svg version="1.1" id="loader-1" xmlns="http://www.w3.org/2000/svg"
                xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="40px" height="40px"
                viewBox="0 0 50 50" style="enable-background:new 0 0 50 50;" xml:space="preserve">
                <path fill="currentColor"
                    d="M43.935,25.145c0-10.318-8.364-18.683-18.683-18.683c-10.318,0-18.683,8.365-18.683,18.683h4.068c0-8.071,6.543-14.615,14.615-14.615c8.072,0,14.615,6.543,14.615,14.615H43.935z">
                    <animateTransform attributeType="xml" attributeName="transform" type="rotate" from="0 25 25"
                        to="360 25 25" dur="0.6s" repeatCount="indefinite" />
                </path>
            </svg>
        </div>
    @endif

    @if ($type == 3)
        <!-- 8 -->
        <div class="text-blue-500 loader loader--style8 dark:text-orange-500" title="7">
            <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="24px" height="30px"
                viewBox="0 0 24 30" style="enable-background:new 0 0 50 50;" xml:space="preserve">
                <rect x="0" y="10" width="4" height="10" fill="currentColor" opacity="0.2">
                    <animate attributeName="opacity" attributeType="XML" values="0.2; 1; .2" begin="0s"
                        dur="0.6s" repeatCount="indefinite" />
                    <animate attributeName="height" attributeType="XML" values="10; 20; 10" begin="0s"
                        dur="0.6s" repeatCount="indefinite" />
                    <animate attributeName="y" attributeType="XML" values="10; 5; 10" begin="0s" dur="0.6s"
                        repeatCount="indefinite" />
                </rect>
                <rect x="8" y="10" width="4" height="10" fill="currentColor" opacity="0.2">
                    <animate attributeName="opacity" attributeType="XML" values="0.2; 1; .2" begin="0.15s"
                        dur="0.6s" repeatCount="indefinite" />
                    <animate attributeName="height" attributeType="XML" values="10; 20; 10" begin="0.15s"
                        dur="0.6s" repeatCount="indefinite" />
                    <animate attributeName="y" attributeType="XML" values="10; 5; 10" begin="0.15s" dur="0.6s"
                        repeatCount="indefinite" />
                </rect>
                <rect x="16" y="10" width="4" height="10" fill="currentColor" opacity="0.2">
                    <animate attributeName="opacity" attributeType="XML" values="0.2; 1; .2" begin="0.3s"
                        dur="0.6s" repeatCount="indefinite" />
                    <animate attributeName="height" attributeType="XML" values="10; 20; 10" begin="0.3s"
                        dur="0.6s" repeatCount="indefinite" />
                    <animate attributeName="y" attributeType="XML" values="10; 5; 10" begin="0.3s" dur="0.6s"
                        repeatCount="indefinite" />
                </rect>
            </svg>
        </div>
    @endif

</div>
