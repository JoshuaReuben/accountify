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

// import "./style.css";
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

    // Learning how to fetch data
    document.querySelector("#logButton").addEventListener("click", function () {
        if (
            editorInstance &&
            editorInstance.editing &&
            editorInstance.editing.view &&
            editorInstance.editing.view.document
        ) {
            let data = editorInstance.getData(); // Get the current HTML content of the editor
            // console.log(data); // Log the content for debugging purposes
            logEditorContent();
        } else {
            console.error("Editor instance not found or not yet initialized.");
        }
    });

    function logEditorContent() {
        if (editorInstance) {
            let data = editorInstance.getData(); // Get the current HTML content of the editor
            console.log(typeof data); // Log the content for debugging purposes
        } else {
            console.error("Editor instance not found or not yet initialized.");
        }
    }

    var inputField = document.getElementById("lesson_title");
    document.querySelector("#logButton").addEventListener("click", function () {
        // Check if the input field has a value
        if (inputField.value) {
            console.log(inputField.value); // Log the value of the input field
        } else {
            console.log("Input field is empty."); // Log a message if the input field is empty
        }
    });
}); //End of DOMContentLoad

var myValueToPass = "Hello World";
document.querySelector("#testButton").addEventListener("click", sendEvent);
function sendEvent() {
    // alert("hehe");
    Livewire.dispatch("lesson-added");
}
