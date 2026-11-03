<x-admin-layout>
       <!-- Main Content Start -->

            <main class="flex-1 overflow-y-auto p-6">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-2xl font-bold text-gray-800">Edit Category</h1>
                    <a href="{{ route('admin.categories') }}" class="border border-gray-300 bg-white hover:bg-gray-50 text-gray-700 px-5 py-2.5 rounded-lg text-sm font-medium transition flex items-center gap-2">
                        <i class="fa-solid fa-arrow-left"></i> Back to Categories
                    </a>
                </div>
                <div class="max-w-3xl mx-auto">
                    <form method="POST" action="{{ route('admin.category.update',['id'=>$category->id]) }}" enctype="multipart/form-data" class="bg-white rounded-xl shadow-sm border border-gray-100 p-8 space-y-6">
                      @csrf    
                      @method('PUT') 
                      
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                         <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Category Name *</label>
                                <input type="text" id="name" name="name" placeholder="e.g. Samsung" class="w-full border px-4 py-2 rounded-lg outline-none focus:ring-1 focus:ring-primary" value="{{$category->name}}" required>
                                @error('name')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Category Slug</label>
                                <input type="text" id="slug" name="slug" placeholder="samsung" class="w-full border px-4 py-2 rounded-lg bg-gray-50 outline-none" value="{{ $category->slug }}" readonly>
                                @error('slug')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>                           
                        </div>

                         <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Parent Category *</label>
                            <select name="parent_id" class="w-full border px-4 py-2 rounded-lg outline-none focus:ring-1 focus:ring-primary">
                                <option value="">-- Select Parent Category --</option>
                                @foreach ($parentCategories as $pcategory)
                                    <option value="{{ $pcategory->id }}" {{ $category->parent_id == $pcategory->id ? 'selected' : '' }}>{{ $pcategory->name }}</option>
                                @endforeach
                            </select>
                            @error('parent_id')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                       
                             <div class="flex flex-col md:flex-row gap-8 items-start pt-4">
                                @if($category->image)
                             <div class="w-full md:w-1/3">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Current Logo</label>
                                    <div class="h-40 w-full border rounded-lg bg-white flex items-center justify-center p-4">
                                        <img src="{{asset('uploads/categories/thumbnails')}}/{{ $category->image}}" class="max-h-full max-w-full object-contain" alt="{{$category->name}}">
                                    </div>
                             </div>
                              @endif  
                                <div class="w-full md:w-2/3">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Change Category Logo</label>
                                    
                                    <div class="relative w-full h-40">
                                        <label for="category-image" class="relative flex flex-col items-center justify-center w-full h-full border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 transition overflow-hidden">
                                            
                                            <div id="upload-content" class="text-center z-10">
                                                <i class="fa-solid fa-image text-3xl text-gray-300 mb-2"></i>
                                                <p class="text-sm text-gray-500">Upload new logo</p>
                                            </div>

                                            <img id="image-preview" class="hidden absolute inset-0 w-full h-full object-contain p-2 z-20 bg-white" src="" alt="New Logo Preview">

                                            <input type="file" id="category-image" name="image" class="hidden" accept="image/png, image/jpeg, image/jpg, image/webp" />
                                        </label>

                                        <button type="button" id="remove-logo-btn" class="hidden absolute top-2 right-2 z-30 bg-white text-red-500 hover:text-white hover:bg-red-500 rounded-full w-8 h-8 flex items-center justify-center shadow-md border border-gray-200 transition-colors focus:outline-none" title="Remove new image">
                                            <i class="fa-solid fa-xmark"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                        <div class="flex items-center gap-2">
                            <input type="checkbox" id="status" name="status" class="w-4 h-4 text-primary rounded border-gray-300 focus:ring-primary" value="1" {{ $category->status ? 'checked':'' }}>
                            <label for="status" class="text-sm text-gray-700">Set as Active Category</label>
                        </div>

                        <div class="flex justify-end gap-3 pt-4 border-t">
                            <a href="{{ route('admin.categories') }}" class="px-6 py-2 border rounded-lg hover:bg-gray-50 transition text-sm">Cancel</a> 
                            <button type="submit" class="px-6 py-2 bg-primary text-white rounded-lg hover:bg-blue-600 transition text-sm font-medium shadow-sm">Update Category</button>
                        </div>
                    </form>
                </div>
            </main>

            <!-- Main Content End -->

            <script>
            document.addEventListener('DOMContentLoaded', function () {
                const nameInput     = document.getElementById('name');
                const slugInput     = document.getElementById('slug');
                const imageInput    = document.getElementById('category-image');
                const imagePreview  = document.getElementById('image-preview');
                const uploadContent = document.getElementById('upload-content');
                const removeBtn     = document.getElementById('remove-logo-btn');

                // ===== 1) الـ slug التلقائي (لو الحقول موجودة في الصفحة) =====
                if (nameInput && slugInput) {
                    function makeSlug(text) {
                        return text
                            .toString()
                            .trim()
                            .toLowerCase()
                            .replace(/[^\p{L}\p{N}\s-]/gu, '')
                            .replace(/\s+/g, '-')
                            .replace(/-+/g, '-')
                            .replace(/^-+|-+$/g, '');
                    }

                    nameInput.addEventListener('input', function () {
                        slugInput.value = makeSlug(nameInput.value);
                    });
                }

                // ===== 2) معاينة الصورة =====
                if (imageInput) {
                    imageInput.addEventListener('change', function () {
                        const file = this.files[0];
                        if (!file) return;

                        const reader = new FileReader();
                        reader.onload = function (e) {
                            imagePreview.src = e.target.result;
                            imagePreview.classList.remove('hidden');
                            uploadContent.classList.add('hidden');
                            removeBtn.classList.remove('hidden');
                        };
                        reader.readAsDataURL(file);
                    });

                    // ===== 3) زرار إزالة الصورة =====
                    removeBtn.addEventListener('click', function (e) {
                        e.preventDefault();
                        imageInput.value = '';
                        imagePreview.src = '';
                        imagePreview.classList.add('hidden');
                        uploadContent.classList.remove('hidden');
                        removeBtn.classList.add('hidden');
                    });
                }
            });
            </script>

</x-admin-layout>    