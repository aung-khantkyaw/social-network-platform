{{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
<div class="flex flex-col items-center">
    <div class="w-3/4 max-w-md bg-gray-100 rounded-lg shadow-xs dark:bg-gray-800 p-6 mt-2">
        <h2 class="mb-2 text-center text-2xl font-bold text-gray-700 dark:text-gray-200">Create Your Own Squad</h2>
        <form class="flex flex-col" method="post" action="{{ route('create-squad') }}" enctype="multipart/form-data">
            @csrf
            <div class="flex items-center justify-between w-full mb-4 gap-6">
                <label for="dropzone-file"
                    class="drop_area flex flex-col items-center justify-center w-1/4 h-56 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                    <div class="img_view flex flex-col items-center justify-center pt-5 pb-6 h-64 w-full">
                        <svg class="hide w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                        </svg>
                        <p class=" mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click
                                to
                                upload</span> or drag and drop</p>
                        <p class="text-center text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF</p>
                    </div>
                    <input id="dropzone-file" type="file" class="hidden" name="icon" />
                </label>
                {{-- error --}}
                @error('icon')
                    <span class="text-red-500 text-xs mt-2">{{ $message }}</span>
                @enderror
                <label for="dropzone-thumbnail"
                    class="drop_thumbnail flex flex-col items-center justify-center w-3/4 h-56 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                    <div class="thumbnail_view flex flex-col items-center justify-center pt-5 pb-6 h-64 w-full">
                        <svg class="hide w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                        </svg>
                        <p class=" hide mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click
                                to
                                upload</span> or drag and drop</p>
                        <p class="hide text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF
                            (MAX. 800x400px)</p>
                    </div>
                    <input id="dropzone-thumbnail" type="file" class="hidden" name="thumbnail" />
                </label>
                {{-- error --}}
                @error('thumbnail')
                    <span class="text-red-500 text-xs mt-2">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex justify-between gap-6">
                <label class="w-full text-sm mt-2">
                    <div class="relative text-gray-500 focus-within:text-purple-600">
                        <input type="text" name="name" id="name"
                            class="block w-full pl-10 mt-1 text-sm text-black dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input"
                            placeholder="Squad Name" />
                        <div class="absolute inset-y-0 flex items-center ml-3 pointer-events-none" id="title-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                            </svg>
                        </div>
                    </div>
                </label>
                {{-- error --}}
                @error('name')
                    <span class="text-red-500 text-xs mt-2">{{ $message }}</span>
                @enderror
                <label class="w-full text-sm mt-2">
                    <div class="relative text-gray-500 focus-within:text-purple-600">
                        <input type="text" name="type" id="type"
                            class="block w-full pl-10 mt-1 text-sm text-black dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input"
                            placeholder="Squad Type" />
                        <div class="absolute inset-y-0 flex items-center ml-3 pointer-events-none" id="title-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 0 0 5.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 0 0 9.568 3Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6Z" />
                            </svg>

                        </div>
                    </div>
                </label>
                {{-- error --}}
                @error('type')
                    <span class="text-red-500 text-xs mt-2">{{ $message }}</span>
                @enderror
                <label class="w-full text-sm mt-2">
                    <div class="relative text-gray-500 focus-within:text-purple-600">
                        <input type="text" name="location" id="location"
                            class="block w-full pl-10 mt-1 text-sm text-black dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input"
                            placeholder="Squad Location" />
                        <div class="absolute inset-y-0 flex items-center ml-3 pointer-events-none" id="title-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 6.75V15m6-6v8.25m.503 3.498 4.875-2.437c.381-.19.622-.58.622-1.006V4.82c0-.836-.88-1.38-1.628-1.006l-3.869 1.934c-.317.159-.69.159-1.006 0L9.503 3.252a1.125 1.125 0 0 0-1.006 0L3.622 5.689C3.24 5.88 3 6.27 3 6.695V19.18c0 .836.88 1.38 1.628 1.006l3.869-1.934c.317-.159.69-.159 1.006 0l4.994 2.497c.317.158.69.158 1.006 0Z" />
                            </svg>
                        </div>
                    </div>
                </label>
                {{-- error --}}
                @error('location')
                    <span class="text-red-500 text-xs mt-2">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex justify-between gap-6">
                <label class="w-full text-sm mt-2">
                    <div class="relative text-gray-500 focus-within:text-purple-600">
                        <input type="text" name="description" id="description"
                            class="block w-full pl-10 mt-1 text-sm text-black dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input"
                            placeholder="Squad Description" />
                        <div class="absolute inset-y-0 flex items-center ml-3 pointer-events-none" id="title-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M5.25 8.25h15m-16.5 7.5h15m-1.8-13.5-3.9 19.5m-2.1-19.5-3.9 19.5" />
                            </svg>
                        </div>
                    </div>
                </label>
                {{-- error --}}
                @error('description')
                    <span class="text-red-500 text-xs mt-2">{{ $message }}</span>
                @enderror
            </div>
            <button class="bg-blue-500 text-white font-bold py-2 px-4 rounded-md mt-4" type="submit">Create
                Squad</button>
        </form>
    </div>
</div>
<script>
    let dropArea = document.querySelector('.drop_area');
    let dropFile = document.querySelector('#dropzone-file');
    let imgView = document.querySelector('.img_view');

    dropFile.addEventListener("change", uploadImage);

    function uploadImage() {
        imgView.removeAttribute('style');
        let imgLink = URL.createObjectURL(dropFile.files[0]);
        dropArea.style.backgroundImage = `url(${imgLink})`;
        dropArea.style.backgroundSize = `cover`;
        dropArea.style.backgroundRepeat = `no-repeat`;
        dropArea.style.backgroundPosition = `center`;
    }

    let dropAreaThumbnail = document.querySelector('.drop_thumbnail');
    let dropFileThumbnail = document.querySelector('#dropzone-thumbnail');
    let thumbnailView = document.querySelector('.thumbnail_view');

    dropFileThumbnail.addEventListener("change", uploadThumbnail);

    function uploadThumbnail() {
        thumbnailView.removeAttribute('style');
        let thumbnailLink = URL.createObjectURL(dropFileThumbnail.files[0]);
        dropAreaThumbnail.style.backgroundImage = `url(${thumbnailLink})`;
        dropAreaThumbnail.style.backgroundSize = `cover`;
        dropAreaThumbnail.style.backgroundRepeat = `no-repeat`;
        dropAreaThumbnail.style.backgroundPosition = `center`;
    }
</script>
