{{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}
@php
    $path = parse_url(url()->current())['path'];
    $uuid = substr($path, strrpos($path, '/') + 1);
    $squad = \App\Models\Group::where('uuid', $uuid)->first();
@endphp
<div class="flex flex-col items-center">

    <div class="w-3/4 max-w-md bg-gray-100 rounded-lg shadow-xs dark:bg-gray-800 p-6 mt-2">

        @foreach ($errors->all() as $error)
            <div class="text-red-600" role="alert">
                {{ $error }}
            </div>
        @endforeach

        <form class="flex flex-col" method="POST" action="{{ route('squad.createpost', $uuid) }}"
            enctype="multipart/form-data">
            @csrf
            <input type="text" name="group_id" id="" value="{{ $squad->id }}" hidden>
            <div class="flex flex-col items-center justify-center w-full  mb-4">
                <label for="dropzone-file"
                    class="drop_area flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                    <div class="img_view flex flex-col items-center justify-center pt-5 pb-6">
                        <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                        </svg>
                        <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to
                                upload</span> or drag and drop</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF
                            (MAX. 5MB)</p>
                    </div>
                    <input id="dropzone-file" type="file" class="hidden" name="thumbnail" required />
                </label>

                <label class="w-full text-sm mt-4">
                    <div class="relative text-gray-500 focus-within:text-purple-600">
                        <input type="text" name="title" id="title"
                            class="block w-full pl-10 mt-1 text-sm text-black dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input"
                            placeholder="Your Post's Title" />
                        <div class="absolute inset-y-0 flex items-center ml-3 pointer-events-none" id="title-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M5.25 8.25h15m-16.5 7.5h15m-1.8-13.5-3.9 19.5m-2.1-19.5-3.9 19.5" />
                            </svg>
                        </div>
                    </div>
                </label>

            </div>
            <div class="flex flex-col  w-full  mb-4">
                <div class="flex items-center justify-evenly mb-2">
                    <button
                        class="img_btn flex items-center justify-center w-full px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-blue-600 border border-transparent rounded-lg active:bg-blue-600 hover:bg-blue-700 focus:outline-none focus:shadow-outline-purple"
                        type="button">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                        </svg>
                        <span class="ml-6">Upload Images</span>
                    </button>
                </div>

                <style>
                    .imageThumb {
                        max-height: 100px;
                        border: 2px solid;
                        padding: 1px;
                        cursor: pointer;
                        margin: 0 auto
                    }

                    .pip {
                        display: inline-block;
                        margin: 0 5px;
                    }

                    .remove {
                        display: block;
                        background: #444;
                        border: 1px solid black;
                        color: white;
                        text-align: center;
                        cursor: pointer;
                    }

                    .remove:hover {
                        background: white;
                        color: black;
                    }
                </style>
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

                <label for="files"
                    class="hidden imgs_upload flex flex-row items-center justify-center w-full h-48 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                    <div class="img_view flex flex-col items-center justify-center pt-5 pb-6">
                        <div class="bg flex flex-col items-center justify-center">
                            <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                            </svg>
                            <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click
                                    to
                                    upload</span> or drag and drop</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF
                                (MAX. 5MB)</p>
                        </div>
                    </div>
                    <input type="file" id="files" class="hidden" name="images[]" multiple />
                </label>



            </div>
            <script>
                tinymce.init({
                    selector: 'textarea',
                    plugins: 'anchor autolink charmap codesample emoticons link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage advtemplate ai mentions tinycomments tableofcontents footnotes mergetags autocorrect typography inlinecss ',
                    toolbar: 'undo redo | fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat ',
                    tinycomments_mode: 'embedded',
                    tinycomments_author: 'Author name',
                    mergetags_list: [{
                            value: 'First.Name',
                            title: 'First Name'
                        },
                        {
                            value: 'Email',
                            title: 'Email'
                        },
                    ],
                    ai_request: (request, respondWith) => respondWith.string(() => Promise.reject(
                        "See docs to implement AI Assistant")),
                });
            </script>
            <textarea placeholder="Cover Letter" id="content" name="content"></textarea>


            <button class="bg-blue-500 text-white font-bold py-2 px-4 rounded-md mt-4" type="submit">Post</button>
        </form>
    </div>
</div>


<script>
    $(document).ready(function() {
        if (window.File && window.FileList && window.FileReader) {
            $("#files").on("change", function(e) {
                var files = e.target.files,
                    filesLength = files.length;
                for (var i = 0; i < filesLength; i++) {
                    var f = files[i]
                    var fileReader = new FileReader();
                    fileReader.onload = (function(e) {
                        var file = e.target;
                        $(".bg").remove();
                        $("<span class=\"pip\">" +
                            "<img class=\"imageThumb\" src=\"" + e.target.result +
                            "\" title=\"" + file.name + "\"/>" +
                            "<br/><span class=\"remove\">Remove image</span>" +
                            "</span>").insertAfter("#files");
                        $(".remove").click(
                            function() {
                                $(this).parent(".pip").remove();
                            });

                        // Old code here
                        /*$("<img></img>", {
                          class: "imageThumb",
                          src: e.target.result,
                          title: file.name + " | Click to remove"
                        }).insertAfter("#files").click(function(){$(this).remove();});*/

                    });
                    fileReader.readAsDataURL(f);
                }
                console.log(files);
            });
        } else {
            alert("Your browser doesn't support to File API")
        }
    });

    let img_btn = document.querySelector('.img_btn');
    img_btn.addEventListener('click', function() {
        document.querySelector('.imgs_upload').classList.toggle('hidden');
    });

    let dropArea = document.querySelector('.drop_area');
    let dropFile = document.querySelector('#dropzone-file');
    let imgView = document.querySelector('.img_view');

    dropFile.addEventListener("change", uploadImage);

    function uploadImage() {
        let imgLink = URL.createObjectURL(dropFile.files[0]);
        dropArea.style.backgroundImage = `url(${imgLink})`;
        dropArea.style.backgroundSize = `cover`;
    }
</script>
