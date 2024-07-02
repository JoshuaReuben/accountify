<div>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('LESSON  ') }}{{ $lesson_position . ' | ' . $passed_lesson->lesson_title }}
        </h2>
    </x-slot>


    <x-slot name="sidebarContent">
        <livewire:layout.resource-sidebar-for-lessons courseID="{{ $courseID }}" moduleID="{{ $moduleID }}" />
    </x-slot>



    <div class="py-6">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div id="lesson-show-container" class="p-6 text-gray-900 dark:text-gray-100">

                    this is lessons show view

                    {{-- Finally Working --}}
                    <figure class="media">
                        <oembed url="https://www.youtube.com/watch?v=KhY0cSoww2Q">
                        </oembed>
                    </figure>
                    {{-- Working --}}
                    {{-- <figure class="media">
                        <iframe class="mx-auto" width="560" height="315"
                            src="https://www.youtube.com/embed/KhY0cSoww2Q" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen></iframe>
                    </figure> --}}
                </div>
            </div>
        </div>
    </div>


    <div class="py-6">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{-- {!! $passed_lesson->lesson_content !!} --}}

                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Wait for the DOM to be fully loaded
            var lessonShowContainer = document.getElementById('lesson-show-container');

            // Check if the div exists
            if (lessonShowContainer) {
                // Find all figure elements with the class 'media'
                var mediaFigures = lessonShowContainer.querySelectorAll('figure.media');

                // Iterate over each figure element
                mediaFigures.forEach(function(mediaFigure) {
                    // Find the oembed element within the current figure
                    var oembedElement = mediaFigure.querySelector('oembed');

                    // If the oembed element is found
                    if (oembedElement) {
                        // Extract the YouTube URL from the oembed element's attribute
                        var youtubeUrl = oembedElement.getAttribute('url');

                        // Replace 'watch?v=' with 'embed/' in the URL
                        var embedUrl = youtubeUrl.replace(/watch\?v=/, 'embed/');

                        // Remove the oembed element
                        // oembedElement.remove();

                        // Create a new iframe element
                        var iframe = document.createElement('iframe');
                        iframe.className = 'mx-auto';
                        iframe.width = '560';
                        iframe.height = '315';
                        iframe.src = embedUrl; // Use the dynamically obtained URL
                        iframe.frameborder = '0';
                        iframe.allow =
                            'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture';
                        iframe.allowFullscreen = true;

                        // Insert the iframe into the parent of the removed oembed element
                        oembedElement.parentNode.insertBefore(iframe, oembedElement);
                    }
                });
            }
        });
    </script>

</div>
