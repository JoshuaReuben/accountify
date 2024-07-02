// import "./bootstrap";
// CKEditor
import {
    DecoupledEditor,
    AccessibilityHelp,
    Alignment,
    AutoLink,
    Autosave,
    BalloonToolbar,
    Base64UploadAdapter,
    BlockQuote,
    // BlockToolbar,
    Bold,
    Code,
    CodeBlock,
    Essentials,
    FindAndReplace,
    FontBackgroundColor,
    FontColor,
    FontFamily,
    FontSize,
    Highlight,
    HorizontalLine,
    ImageBlock,
    ImageCaption,
    // ImageInline,
    ImageInsert,
    ImageInsertViaUrl,
    // ImageResize,
    ImageStyle,
    ImageToolbar,
    ImageUpload,
    Indent,
    IndentBlock,
    Italic,
    Link,
    LinkImage,
    List,
    MediaEmbed,
    Paragraph,
    RemoveFormat,
    SelectAll,
    SpecialCharacters,
    SpecialCharactersArrows,
    SpecialCharactersCurrency,
    SpecialCharactersEssentials,
    SpecialCharactersLatin,
    SpecialCharactersMathematical,
    SpecialCharactersText,
    Strikethrough,
    Subscript,
    Superscript,
    Table,
    TableCaption,
    TableCellProperties,
    TableColumnResize,
    TableProperties,
    TableToolbar,
    Underline,
    Undo,
} from "ckeditor5";

import "ckeditor5/ckeditor5.css";

// On page load or when changing themes, best to add inline in `head` to avoid FOUC
if (
    localStorage.theme === "dark" ||
    (!("theme" in localStorage) &&
        window.matchMedia("(prefers-color-scheme: dark)").matches)
) {
    //localstorage is black OR no theme set on local storage but OS prefers dark
    document.documentElement.classList.add("dark");
    localStorage.theme = "dark";
} else {
    document.documentElement.classList.remove("dark");
    localStorage.theme = "light";
}

// Reload the Webpage
document.addEventListener("reload-page", () => {
    window.location.reload();
});

// function observeDOMChanges() {
//     const observer = new MutationObserver(() => {
//         // Re-init Flowbite components on DOM changes
//         initFlowbite();
//         alert("code reached here");
//     });

//     observer.observe(document.body, { childList: true, subtree: true });
// }

// observeDOMChanges();

// document.addEventListener("livewire:navigated", () => {
//     alert("code reached here");
//     initFlowbite();
// });

let ckeditor_lessons_content;
let lessonTitle;

document.addEventListener("DOMContentLoaded", function () {
    const editorConfig = {
        toolbar: {
            items: [
                "undo",
                "redo",
                "|",
                "findAndReplace",
                "selectAll",
                "|",
                "|",
                "fontSize",
                "fontFamily",
                "fontColor",
                "fontBackgroundColor",
                "|",
                "bold",
                "italic",
                "underline",
                "strikethrough",
                "subscript",
                "superscript",
                "code",
                "removeFormat",
                "|",
                "specialCharacters",
                "horizontalLine",
                "link",
                "insertImage",
                "insertImageViaUrl",
                "mediaEmbed",
                "insertTable",
                "highlight",
                "blockQuote",
                "codeBlock",
                "|",
                "alignment",
                "|",
                "bulletedList",
                "numberedList",
                "indent",
                "outdent",
                "|",
                "accessibilityHelp",
            ],
            shouldNotGroupWhenFull: true,
        },
        plugins: [
            AccessibilityHelp,
            Alignment,
            AutoLink,
            Autosave,
            BalloonToolbar,
            Base64UploadAdapter,
            BlockQuote,
            // BlockToolbar,
            Bold,
            Code,
            CodeBlock,
            Essentials,
            FindAndReplace,
            FontBackgroundColor,
            FontColor,
            FontFamily,
            FontSize,
            Highlight,
            HorizontalLine,
            ImageBlock,
            ImageCaption,
            // ImageInline,
            ImageInsert,
            ImageInsertViaUrl,
            // ImageResize,
            ImageStyle,
            ImageToolbar,
            ImageUpload,
            Indent,
            IndentBlock,
            Italic,
            Link,
            LinkImage,
            List,
            MediaEmbed,
            Paragraph,
            RemoveFormat,
            SelectAll,
            SpecialCharacters,
            SpecialCharactersArrows,
            SpecialCharactersCurrency,
            SpecialCharactersEssentials,
            SpecialCharactersLatin,
            SpecialCharactersMathematical,
            SpecialCharactersText,
            Strikethrough,
            Subscript,
            Superscript,
            Table,
            TableCaption,
            TableCellProperties,
            TableColumnResize,
            TableProperties,
            TableToolbar,
            Underline,
            Undo,
        ],
        balloonToolbar: [
            "bold",
            "italic",
            "|",
            "link",
            "insertImage",
            "|",
            "bulletedList",
            "numberedList",
        ],
        //  blockToolbar: [
        //     "fontSize",
        //     "fontColor",
        //     "fontBackgroundColor",
        //     "|",
        //     "bold",
        //     "italic",
        //     "|",
        //     "link",
        //     "insertImage",
        //     "insertTable",
        //     "|",
        //     "bulletedList",
        //     "numberedList",
        //     "indent",
        //     "outdent",
        // ],
        fontFamily: {
            supportAllValues: true,
        },
        fontSize: {
            options: [10, 12, 14, "default", 18, 20, 22],
            supportAllValues: true,
        },

        image: {
            toolbar: [
                "toggleImageCaption",
                "imageTextAlternative",
                "|",
                "imageStyle:inline",
                "imageStyle:wrapText",
                "imageStyle:breakText",
                "|",
                "resizeImage",
            ],
        },
        initialData: "Lesson Content Goes Here...",
        link: {
            addTargetToExternalLinks: true,
            defaultProtocol: "https://",
            decorators: {
                toggleDownloadable: {
                    mode: "manual",
                    label: "Downloadable",
                    attributes: {
                        download: "file",
                    },
                },
            },
        },
        menuBar: {
            isVisible: true,
        },
        placeholder: "Type or paste your content here!",
        table: {
            contentToolbar: [
                "tableColumn",
                "tableRow",
                "mergeTableCells",
                "tableProperties",
                "tableCellProperties",
            ],
        },
    };

    let editorInstance;

    // This Code Will check First if Editor exists and if not then it will create it
    const ckeditorContainer = document.querySelector(
        "#ckeditor--main-container"
    );

    // Check if the element exists
    if (ckeditorContainer) {
        // Create the editor instance
        DecoupledEditor.create(document.querySelector("#editor"), editorConfig)
            .then((editor) => {
                editorInstance = editor; // Assign the editor instance to the global variable
                document
                    .querySelector("#editor-toolbar")
                    .appendChild(editor.ui.view.toolbar.element);
                document
                    .querySelector("#editor-menu-bar")
                    .appendChild(editor.ui.view.menuBarView.element);
            })
            .catch((error) => {
                console.error(error);
            });
        // End of CKEditor

        // Function Fetching the content of the editor
        document
            .querySelector("#storeNewLesson")
            .addEventListener("click", function () {
                if (
                    editorInstance &&
                    editorInstance.editing &&
                    editorInstance.editing.view &&
                    editorInstance.editing.view.document
                ) {
                    ckeditor_lessons_content = editorInstance.getData(); // Get the current HTML content of the editor

                    // Still Part of the Function - Get Lesson Title
                    lessonTitle = document.getElementById("lesson_title");
                    let errorMessage = document.getElementById(
                        "lesson-title-error-msg"
                    );
                    errorMessage.textContent = "";

                    // Validation of the input field
                    if (lessonTitle.value.trim().length < 3) {
                        // Value is less than 3 characters long
                        errorMessage.textContent =
                            "The input must be at least 3 characters long.";
                        lessonTitle.focus();
                    }

                    if (lessonTitle.value.length > 150) {
                        // Value is less than 3 characters long
                        errorMessage.textContent =
                            "Input should not be greater than 150 characters long.";
                        lessonTitle.focus();
                    }

                    // Check if the input field has a value

                    if (lessonTitle.value.trim() != "") {
                        lessonTitle = lessonTitle.value.trim();
                        // Call AJAX request with the lesson title and the content
                        sendLessonsContent();
                    } else {
                        errorMessage.textContent = "Please Enter Lesson Title.";
                        lessonTitle.focus();
                    }
                } else {
                    console.error(
                        "Editor instance not found or not yet initialized."
                    );
                }
            });
    } else {
        console.log("CK Editor element not on this page.");
    }
}); //End of DOMContentLoad

function sendLessonsContent() {
    $.ajax({
        url: window.location.origin + "/admin/lessons/store",
        type: "POST",
        data: {
            lesson_title: lessonTitle,
            lesson_content: ckeditor_lessons_content,
            courseID: getRouteParams().courseID,
            moduleID: getRouteParams().moduleID,
            _token: $('meta[name="csrf-token"]').attr("content"), // Add CSRF token
        },
        success: function (response) {
            console.log(response.message); // Success message
            window.location.href = response.redirect_url;
        },
        error: function (xhr, status, error) {
            console.error(xhr.responseText);
        },
    });
}

function getRouteParams() {
    // Get the path from the URL
    var pathArray = window.location.pathname.split("/");

    // Extract courseID and moduleID
    var courseID = pathArray[4];
    var moduleID = pathArray[5];

    // Check if courseID and moduleID are valid numbers
    if (!courseID || isNaN(courseID) || !moduleID || isNaN(moduleID)) {
        console.error("Invalid route parameters");
        return;
    }

    // console.log("Course ID:", courseID);
    // console.log("Module ID:", moduleID);

    // Return the parameters if needed
    return { courseID, moduleID };
}

//////////////////////////////////////////////////////////////////////////////////////////////////////
///////// lesson.show displaying the content of the editor such as Video and Images with the elements of figure.media

document.addEventListener("DOMContentLoaded", function () {
    // Wait for the DOM to be fully loaded
    var lessonShowContainer = document.getElementById("lesson-show-container");

    // Check if the div exists
    if (lessonShowContainer) {
        // Find all figure elements with the class 'media'
        var mediaFigures = lessonShowContainer.querySelectorAll("figure.media");
        var imageFigures = lessonShowContainer.querySelectorAll("figure.image");
        var tableFigures = lessonShowContainer.querySelectorAll("figure.table");
        var olLists = lessonShowContainer.querySelectorAll("ol");
        var ulLists = lessonShowContainer.querySelectorAll("ul");
        console.log(olLists);

        // Iterate over each figure media element
        mediaFigures.forEach(function (mediaFigure) {
            // Find the oembed element within the current figure
            var oembedElement = mediaFigure.querySelector("oembed");

            // If the oembed element is found
            if (oembedElement) {
                // Extract the YouTube URL from the oembed element's attribute
                var youtubeUrl = oembedElement.getAttribute("url");

                // Replace 'watch?v=' with 'embed/' in the URL
                // var embedUrl = youtubeUrl.replace(/watch\?v=/, "embed/");
                var parts = youtubeUrl.split("&"); // Split the URL at the ampersand
                var embedUrl = parts[0].replace(/watch\?v=/, "embed/") + "&"; // Reconstruct the URL without the trailing part
                var embedUrl = embedUrl.split("&")[0]; // Clean up the URL

                // Remove the oembed element
                // oembedElement.remove();

                // Create a new iframe element
                var iframe = document.createElement("iframe");
                iframe.className = "mx-auto my-3";
                // iframe.width = '560';
                iframe.width = "840";
                iframe.height = "473";
                // iframe.height = '315';
                iframe.src = embedUrl; // Use the dynamically obtained URL
                iframe.frameborder = "0";
                iframe.allow =
                    "accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture";
                iframe.allowFullscreen = true;

                // Insert the iframe into the parent of the removed oembed element
                oembedElement.parentNode.insertBefore(iframe, oembedElement);
                oembedElement.remove();
            }
        });

        // Iterate over each figure image element
        imageFigures.forEach(function (imageFigure) {
            // add class to the figure element
            imageFigure.classList.add("text-center");

            // Find the oembed element within the current figure
            var imgElement = imageFigure.querySelector("img");

            // If the img element is found
            if (imgElement) {
                // add class to img element
                imgElement.classList.add("mx-auto");
            }
        });

        tableFigures.forEach(function (tableFigure) {
            // add class to the figure element
            tableFigure.classList.add("mx-auto");
        });

        olLists.forEach(function (olList) {
            // add class to the Ordered List element
            olList.classList.add("mx-2", "list-decimal");
        });

        ulLists.forEach(function (ulList) {
            // add class to the Unordered List element
            ulList.classList.add("mx-2", "list-disc");
        });
    }
});

//////////////////////////////////////////////////////////////////////////////////////////////////////
///////// lesson.edit create new instance of ckeditor then display the saved values in the editor
