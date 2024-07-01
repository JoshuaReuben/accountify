import "./bootstrap";

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
    BlockToolbar,
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
    ImageInline,
    ImageInsert,
    ImageInsertViaUrl,
    ImageResize,
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
            BlockToolbar,
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
            ImageInline,
            ImageInsert,
            ImageInsertViaUrl,
            ImageResize,
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
        blockToolbar: [
            "fontSize",
            "fontColor",
            "fontBackgroundColor",
            "|",
            "bold",
            "italic",
            "|",
            "link",
            "insertImage",
            "insertTable",
            "|",
            "bulletedList",
            "numberedList",
            "indent",
            "outdent",
        ],
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
                // Check if the input field has a value
                if (lessonTitle.value.trim() != "") {
                    lessonTitle = lessonTitle.value.trim();
                    // Call AJAX request with the lesson title and the content
                    sendLessonsContent();
                } else {
                    alert("Please Enter Lesson Title");
                    lessonTitle.focus();
                }
            } else {
                console.error(
                    "Editor instance not found or not yet initialized."
                );
            }
        });
}); //End of DOMContentLoad

function sendLessonsContent() {
    $.ajax({
        url: window.location.origin + "/admin/lessons/store",
        type: "POST",
        data: {
            lesson_title: lessonTitle,
            lesson_content: ckeditor_lessons_content,
            _token: $('meta[name="csrf-token"]').attr("content"), // Add CSRF token
        },
        success: function (response) {
            console.log(response.message); // Success message
            // console.log(response.lesson_title); // Greeting received
            // console.log(response.lesson_content); // Lesson Content received
        },
        error: function (xhr, status, error) {
            console.error(xhr.responseText);
        },
    });
}
