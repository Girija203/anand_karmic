@extends('Admin.layouts.app')
@section('content')
    @include('Admin.links.css.datatable.datatable-css')
    @include('Admin.links.css.table.custom-css')
    <div class="content-page">
        <div class="content">
            <!-- Start Content-->
            <div class="container-fluid">
                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box">
                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item">Manage Products</li>
                                    <li class="breadcrumb-item"><a href="{{ route('product.index') }}"> Products </a></li>
                                    <li class="breadcrumb-item active">List</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Products </h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header m-0 p-0">
                                <ul class="nav nav-pills">
                                    <li class="nav-item">
                                        <a class="nav-link active rounded-0 pt-2 pb-2" aria-current="page"
                                            href="#">Products List</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link rounded-0 pt-2 pb-2" href="{{ route('product.create') }}">Create
                                            Product</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body pt-0">
                                <div class="row">
                                    <div class="col-md-12 rightsetup-details">
                                        <div class="card-body data_table_border_style">
                                            <table id="product-table"
                                                class="table table-striped table-bordered dt-responsive nowrap"
                                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Product Name</th>
                                                        <th>Image</th>
                                                        <th>Color Varient</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>

                                                    </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end col-->
                </div>
                <!-- end row-->
            </div>
            <!-- container -->
        </div>
        <!-- content -->
        <!-- Footer Start -->
        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 text-center">
                        <script>
                            document.write(new Date().getFullYear())
                        </script> © Karmic - Theme by <b>Syscorp</b>
                    </div>
                </div>
            </div>
        </footer>
        <!-- end Footer -->
    </div>

    {{-- modal start --}}
    <div class="modal employe-resign-modal-center" id="resignModal" tabindex="-1" role="dialog"
        aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0">Add Product Variant</h5>
                    <button type="button" class="close" onclick="closeResignModals()" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body pb-0">
                    <div class="row">
                        <div class="col-12">
                            <div class="card m-b-30">
                                <div class="card-body py-0">
                                    <form action="{{ route('product.color.update') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <input type="hidden" class="product_id" name="product_id" id="product_id">

                                            <label for="color_id"
                                                class="mandatory col-form-label col-sm-12 col-form-label">Color</label>
                                            <div class="col-sm-12 mb-4">
                                                <select id="color_id" class="form-control" name="color_id"
                                                    value="{{ old('color_id') }}">
                                                    <option value="">Select color</option>
                                                    @foreach ($color as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('color_id')
                                                    <span class="error" style="color: red;">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="col-sm-12 mb-4">
                                                <label>SKU</label>
                                                <input type="text" class="form-control" name="sku"
                                                    value="{{ old('sku') }}">
                                                @error('sku')
                                                    <span class="error" style="color: red;">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="col-sm-12 mb-4">
                                                <label for="price">Price &#40;₹&#41;<span
                                                        class="text text-danger">*</span></label>
                                                <input type="text" class="form-control" name="price" id="price"
                                                    value="{{ old('price') }}">
                                                @error('price')
                                                    <span class="error" style="color: red;">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="col-sm-12 mb-4">
                                                <label for="offer_price">Offer Price &#40;₹&#41;<span
                                                        class="text text-danger">*</span></label>
                                                <input type="text" class="form-control" name="offer_price"
                                                    id="offer_price" value="{{ old('offer_price') }}">
                                                @error('offer_price')
                                                    <span class="error" style="color: red;">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="col-sm-12 mb-4">
                                                <label> Quantity<span class="text text-danger">*</span></label>
                                                <input type="number" min="0" class="form-control" name="qty"
                                                    value="{{ old('qty') }}">
                                                @error('qty')
                                                    <span class="error" style="color: red;">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-sm-12 mb-4">
                                                <label for="main_image">Thumbnail image<span
                                                        class="text text-danger">*</span></label>
                                                <input class="form-control" type="file" name="main_image"
                                                    id="main_image" value="{{ old('image') }}">
                                                @error('main_image')
                                                    <span class="error" style="color: red;">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="col-sm-12 mb-4">
                                                <label for="multiple_images">Select Multiple images<span
                                                        class="text text-danger">*</span></label>
                                                <input class="form-control" type="file" name="multiple_images[]"
                                                    id="multiple_images" multiple value="{{ old('image') }}">
                                                @error('multiple_images')
                                                    <span class="error" style="color: red;">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <div class="d-flex justify-content-evenly">
                                                    <button type="submit" class="btn btn-primary">Create</button>
                                                    <button type="button" class="btn btn-secondary"
                                                        onclick="closeResignModals()">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- modal end --}}

    {{-- edit modal --}}
    <div class="modal employe-resign-modal-center" id="resignModals" tabindex="-1" role="dialog"
        aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0">Edit Product Variant</h5>
                    <button type="button" class="close" onclick="closeResignModal()" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body pb-0">
                    <div class="row">
                        <div class="col-12">
                            <div class="card m-b-30">
                                <div class="card-body py-0">
                                    <form action="{{ route('products.color.update') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" class="product" name="product" id="product">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table table-centered mb-0 table-nowrap"
                                                        id="variant-table">
                                                        <thead>
                                                            <tr>
                                                                <th>ID</th>
                                                                <th>Color</th>
                                                                <th>Sku</th>
                                                                <th>Qty</th>
                                                                <th>Price</th>
                                                                <th>Offer Price</th>
                                                                <th>Single Image</th>
                                                                <th>Multi Image</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <!-- Rows will be appended here by JavaScript -->
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="d-flex justify-content-evenly">
                                    {{-- <button type="submit" class="btn btn-primary">Save</button> --}}
                                    <button type="button" class="btn btn-secondary"
                                        onclick="closeResignModal()">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- edit modal end --}}

    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>


    @include('Admin.links.js.datatable.datatable-js')

    <script>
        var table;


        $(document).ready(function() {

table = $('#product-table').DataTable({
    processing: true,
    serverSide: true,
    ajax: '{{ route('product.data') }}',
    columns: [
        {
            data: null,
            name: 'auto_increment_id',
            render: function(data, type, row, meta) {
                return meta.row + 1;
            }
        },
        {
            data: 'title',
            name: 'title'
        },
        {
            data: 'single_image',
            name: 'single_image',
            render: function(data, type, row) {
                let imagePath = data ? `{{ url('storage') }}/${data}` : '{{ url('assets/admin/images/no_image.png') }}';
                return `<img src="${imagePath}" height="60" width="auto"/>`;
            }
        },
        {
            data: 'colors',
            name: 'colors',
            render: function(data, type, row, meta) {
                let colors = data.split(', ');
                let colorDivs = colors.map(color => {
                   
                }).join('');

                return `${colorDivs}
               
                    <button title="Edit Product" class="btn btn-edit py-0 px-0" onclick="addProduct(${row.id})">
                        <i class="mdi mdi-plus-box text_danger_blue" style="font-size: 22px;"></i>
                    </button> 
                    <button title="Edit Color Varient" class="btn btn-edit py-0 px-0" onclick="editProduct(${row.id})" class="icon-button custom-color">
                        <i class="ri-edit-box-line" style="font-size: 20px;"></i>
                    </button>  
                    `;
            }
        },
        {
            data: null,
            orderable: false,
            searchable: false,
            render: function(data, type, row) {
                return `
                    
               
                    <button title="Edit Product" class="btn btn-edit py-0 px-0" onclick="editUsers(${row.id})">
                        <i class="ri-edit-line" style="font-size: 20px;"></i>
                    </button>
                    <button title="Delete Product" class="btn btn-delete py-0 px-0" onclick="deleteUsers(${row.id})">
                        <i class="mdi mdi-delete-outline" style="font-size: 20px;"></i>
                    </button>`;
            }
        },
    ],
    order: [[0, 'asc']],
    select: true,
    dom: 'lBfrtip',
    buttons: [
        'excel', 'print'
    ],
    pageLength: 8
});



        });

        function addVariantModal(id) {
            $.ajax({
                url: `/products/${id}`,
                method: 'GET',
                success: function(product) {
                    // Populate the modal with product details
                    $('#product_id').val(product.id);
                    $('#color_id').val(product.color_id);
                    $('#price').val(product.price);
                    $('#qty').val(product.qty);
                    $('#sku').val(product.sku);
                    $('#offer_price').val(product.offer_price);

                    $('#main_image').val('');
                    $('#multiple_images').val('');

                    // Show the modal
                    $('#resignModal').modal('show');
                },
                error: function(err) {
                    console.error(err);
                    alert('Failed to fetch product details');
                }
            });
        }

        function closeResignModals() {
            $('#resignModal').modal('hide');
        }



        function editVariantModal(productId) {
            $.ajax({
                url: `/products/colors/${productId}`,
                method: 'GET',
                success: function(productColors) {
                    $('#product').val(productId);
                    $('#variant-table tbody').empty();
                    productColors.forEach(productColor => {
                        console.log('productColor.........', productColor);
                        $('#variant-table tbody').append(`
                    <tr>
                        <td>${productColor.id}</td>
                        <td data-color-id="${productColor.color.id ?? ''}">
                            ${productColor.color.name ?? ''}
                        </td>
                        <td>${productColor.sku ?? ''}</td>
                        <td>${productColor.qty}</td>
                        <td>${productColor.price}</td>
                        <td>${productColor.offer_price}</td>
                        <td>
                            ${productColor.single_image ? `<img src="/storage/${productColor.single_image}" alt="Single Image" width="50">` : 'N/A'}
                        </td>
                        <td>
                            ${productColor.images.map(image => `<img src="/storage/${image.multi_image}" alt="Multi Image" width="50">`).join('')}
                        </td>
                        <td>
                            <button type="button" class="tabledit-edit-button btn btn-primary" style="float: none;" onclick="editRow(this)">
                                <span class="mdi mdi-pencil"></span>
                            </button>
                            <button type="button" class="tabledit-delete-button btn btn-danger" style="float: none;" onclick="deleteRow(this)">
    <span class="mdi mdi-delete"></span>
</button>

                        </td>
                    </tr>
                `);
                    });
                    $('#resignModals').modal('show');
                },
                error: function(err) {
                    console.error(err);
                    alert('Failed to fetch product details');
                }
            });
        }

        function closeResignModal() {
            $('#resignModals').modal('hide');
        }


        function editUsers(id) {
            console.log("inside");

            window.location.href = '/product/edit/' + id;
        }

        function addProduct(id) {
            console.log("inside");

            window.location.href = '/product/add/' + id;
        }

        function editProduct(id) {
            console.log("inside");
            window.location.href = '/product/editproduct/' + id;
        }

        function deleteUsers(id) {

            if (confirm('Are you sure you want to delete this Product?')) {
                $.ajax({
                    url: '/product/delete/' + id,
                    type: 'get',
                    data: {
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(result) {


                        toastr.success(result);

                        table.ajax.reload();
                    }
                });
            }
        }
    </script>


    <script>
        var availableColors = @json($color);

        function editRow(button) {
            var row = button.closest('tr');
            var cells = row.getElementsByTagName('td');
            var id = cells[0].innerText;
            var colorId = cells[1].dataset.colorId;
            var sku = cells[2].innerText;
            var qty = cells[3].innerText;
            var price = cells[4].innerText;
            var offer_price = cells[5].innerText;

            cells[1].innerHTML = `
        <select name="color_id" class="form-control">
            <!-- Populate options dynamically with existing colors -->
            ${availableColors.map(color => `
                    <option value="${color.id}" ${color.id == colorId ? 'selected' : ''}>${color.name}</option>
                `).join('')}
        </select>
    `;

            cells[2].innerHTML = `<input type="text" name="sku" value="${sku}" class="form-control">`;
            cells[3].innerHTML = `<input type="number" name="qty" value="${qty}" class="form-control">`;
            cells[4].innerHTML = `<input type="number" name="price" value="${price}" class="form-control">`;
            cells[5].innerHTML = `<input type="number" name="offer_price" value="${offer_price}" class="form-control">`;

            var singleImageHTML = cells[6].innerHTML.trim();
            var multiImagesHTML = cells[7].innerHTML.trim();

            cells[6].innerHTML = singleImageHTML + `<input type="file" name="single_image" class="form-control mt-2">`;
            cells[7].innerHTML = `
        <div class="multi-image-container">
            ${multiImagesHTML.split('\n').map((imgTag, index) => {
                if (imgTag.trim() !== '') {
                    return `
                                                                                                        <div class="multi-image-item" data-index="${index}">
                                                                                                            ${imgTag}
                                                                                                            <button type="button" class="btn btn-danger btn-sm mt-2" onclick="removeMultiImage(this)">
                                                                                                                <span class="mdi mdi-delete"></span>
                                                                                                            </button>
                                                                                                        </div>
                                                                                                    `;
                }
                return '';
            }).join('')}
        </div>
        <input type="file" name="multi_images[]" class="form-control mt-2" multiple>

    `;

            button.innerHTML = `<span class="mdi mdi-content-save"></span>`;
            button.onclick = function() {
                saveRow(this);
            };
        }

        function saveRow(button) {
            var row = button.closest('tr');
            var cells = row.getElementsByTagName('td');
            var id = cells[0].innerText;
            var colorId = cells[1].querySelector('select[name="color_id"]').value;
            var sku = cells[2].querySelector('input[name="sku"]').value;
            var qty = cells[3].querySelector('input[name="qty"]').value;
            var price = cells[4].querySelector('input[name="price"]').value;
            var offer_price = cells[5].querySelector('input[name="offer_price"]').value;
            var singleImageInput = cells[6].querySelector('input[name="single_image"]');
            var multiImagesInput = cells[7].querySelector('input[name="multi_images[]"]');
            var product_id = $('#product').val();
            var formData = new FormData();
            formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
            formData.append('id', id);
            formData.append('color_id', colorId);
            formData.append('sku', sku);
            formData.append('qty', qty);
            formData.append('price', price);
            formData.append('offer_price', offer_price);
            formData.append('product_id', product_id);
            if (singleImageInput.files[0]) {
                formData.append('single_image', singleImageInput.files[0]);
            }
            for (var file of multiImagesInput.files) {
                formData.append('multi_images[]', file);
            }

            $.ajax({
                url: '/products/update', // Your update route here
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {

                    window.location.href = '';
                },
                error: function(err) {
                    console.error(err);
                    alert('Failed to update product');
                }
            });
        }

        function deleteRow(button) {
            var row = button.closest('tr');
            var cells = row.getElementsByTagName('td');
            var id = cells[0].innerText; // Assuming the ID is in the first cell

            // Ask for confirmation
            if (confirm('Are you sure you want to delete this product color?')) {
                var formData = new FormData();
                formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
                formData.append('id', id);

                $.ajax({
                    url: '/products/delete', // Your delete route here
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        // Remove the row from the table
                        row.parentNode.removeChild(row);
                        // alert('Product color deleted successfully');
                        toastr.success(result);
                    },
                    error: function(err) {
                        console.error(err);
                        alert('Failed to delete product color');
                    }
                });
            } else {
                // Do nothing if the user cancels the deletion
                return false;
            }
        }

        function removeMultiImage(button) {
            var imageItem = button.closest('.multi-image-item');
            imageItem.parentNode.removeChild(imageItem);
        }
    </script>
@endsection
