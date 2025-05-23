@extends('backends.pos.create.posmaster')

@section('content')
    <style>
        .scrollable-container {
            max-height: 350px;
            overflow-y: auto;
        }

        .info-box {
            background-color: white;
            color: black;
            padding: 20px;
            cursor: pointer;
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: flex-start;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
            transition: background-color 0.3s ease;
            overflow: hidden;
            font-size: 18px;
        }

        .info-box:hover {
            background-color: #88d3f5;
        }

        .box-content {
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: flex-start;
            width: 100%;
        }

        .image-container {
            width: 50%;
            /* Container takes 50% of the button width */
            height: 50px;
            /* Fixed height for the container */
            background-color: #f1f1f1;
            /* Placeholder background color */
            margin-right: 10px;
            /* Space between image and text */
            overflow: hidden;
            /* Hide any part of the image that exceeds the container */
        }

        .image-container img {
            width: 100%;
            /* Ensure image takes full width of container */
            height: 100%;
            /* Ensure image takes full height of container */
            object-fit: cover;
            /* Scale image to cover the container without stretching */
        }

        .text-container {
            width: 50%;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .box-title {
            font-size: 12px;
            font-weight: 600;
            margin: 0;
            white-space: normal;
            overflow: visible;
            word-wrap: break-word;
        }

        .box-price {
            font-size: 11px;
            font-weight: bold;
            margin: 5px 0 0;
            text-overflow: ellipsis;
            overflow: hidden;
            white-space: nowrap;
        }

        .box-discount {
            font-size: 11px;
            font-weight: bold;
            margin: 5px 0;
            padding: 5px 10px;
            text-overflow: ellipsis;
            overflow: hidden;
            white-space: nowrap;
            background-color: #28a745;
            border: 2px solid #28a745;
            border-radius: 5px;
            color: white;
            text-align: center;
        }
    </style>
    <div class="container-fluid">
        <div class="row">
            <div class="col-5">
                <div class=" mt-2" style="min-height: 330px;">
                    <div style="max-height: 300px; overflow-y: auto;">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Product</th>
                                    <th scope="col">Qty</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Subtotal</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody id="selected_product_table">
                                <!-- Selected products will appear here -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-7">
                <div class="card p-3 mt-2">
                    <div class="row">
                        <div class="form-group col-4">
                            <select name="customer_id"
                                class="form-control select2 @error('customer_id') is-invalid @enderror"
                                id="searchableSelect" style="width: 100%;">
                                <option value="">{{ __('Select Customer') }}</option>
                                @foreach ($customers as $customer)
                                    <option value="{{ $customer->id }}"
                                        {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
                                        {{ $customer->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('customer_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-8">
                            <input type="text" id="product_search" class="form-control" placeholder="Search Products..."
                                onkeyup="searchProduct()">
                            <ul id="search_results"
                                class="hidden border border-t-0 max-h-40 overflow-auto list-none pl-0 bg-white list-group"
                                style="z-index: 1000; position: absolute; width: 97%;">
                                <!-- Search results will be appended here -->
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card mt-2" style="min-height: 420px">
                    <div>
                        <ul class="nav nav-tabs" id="category-tab" role="tablist">
                            @foreach ($categories as $category)
                                <li class="nav-item">
                                    <a class="nav-link text-capitalize {{ $loop->first ? 'active' : '' }}"
                                        id="cat_{{ $category->id }}-tab" data-toggle="tab" href="#cat_{{ $category->id }}"
                                        role="tab" aria-controls="cat_{{ $category->id }}"
                                        aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                                        {{ $category->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>

                        <div class="tab-content m-3" id="category-tabContent">
                            @foreach ($categories as $category)
                                <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
                                    id="cat_{{ $category->id }}" role="tabpanel"
                                    aria-labelledby="cat_{{ $category->id }}-tab">
                                    <div class="scrollable-container">
                                        <div class="row">
                                            @foreach ($category->products as $product)
                                                <div class="col-lg-3 col-md-4 col-6 mb-2">
                                                    <button class="info-box"
                                                        style="border: none; width: 100%; padding: 15px 3px; cursor: pointer;"
                                                        onclick="selectProduct({{ $product->id }}, '{{ $product->name }}', {{ $product->unit_price }},
                                                     {{ $product->discount }}, {{ $product->inventory }})">
                                                        <div class="box-content">
                                                            <div class="image-container">
                                                                <img src="{{ $product->image ? asset('upload/products/' . $product->image) : asset('upload/image/default_image.png') }}"
                                                                    alt="Product Image">

                                                            </div>
                                                            <div class="text-container">
                                                                <p class="box-title">{{ $product->name }}</p>
                                                                <p class="box-price">${{ $product->unit_price }}</p>
                                                                <p class="box-discount">
                                                                    ${{ $product->discount }}</p>
                                                            </div>
                                                        </div>
                                                    </button>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        const exchangeRate = parseFloat('{{ $exchangeRate }}') || 1;
        console.log('Exchange Rate:', exchangeRate);

        function filterOptions() {
            const search = document.getElementById('search').value.toLowerCase();
            const select = document.getElementById('searchSelect');
            const options = select.options;

            for (let i = 1; i < options.length; i++) {
                const option = options[i];
                const text = option.text.toLowerCase();
                option.style.display = text.includes(search) ? '' : 'none';
            }
        }

        function searchProduct() {
            const searchQuery = document.getElementById('product_search').value;
            const searchResults = document.getElementById('search_results');

            // If search length is less than 1, don't show results
            if (searchQuery.length < 1) {
                searchResults.innerHTML = '';
                searchResults.classList.add('hidden');
                return;
            }

            // Make AJAX call to get filtered results
            $.ajax({
                url: '{{ route('admin.pos.search') }}', // Update with your route
                type: 'GET',
                data: {
                    search_query: searchQuery
                },
                success: function(response) {
                    console.log(response); // Log the response to verify inventory data
                    let options = '';
                    response.forEach(product => {
                        // If product qty <= 0, display a "Out of Stock" message
                        let qtyDisplay = product.inventory <= 0 ? 'Out of Stock' :
                            `${product.inventory}`;

                        options += `
                    <li class="cursor-pointer p-3 hover:bg-gray-100 hover:text-blue-600 transition-all ease-in-out duration-200 border-b border-gray-200 list-group-item"
    style="font-size: 0.70rem;"
    onclick="selectProduct(${product.id}, '${product.name}', ${product.unit_price}, ${product.discount}, ${product.inventory})">
    <div class="flex items-left space-x-4">
        <span>Product Name:</span>
        <span class="me-3">${product.name}</span>
        <span>Price:</span>
        <span class="me-3">$${product.unit_price}</span>
        <span> Price Discount:</span>
        <span class="me-3">$${product.discount}</span>
        <span>Inventory:</span>
        <span class="me-3">${qtyDisplay}</span>
    </div>
</li>
`;
                    });
                    searchResults.innerHTML = options;
                    searchResults.classList.remove('hidden');
                    searchResults.classList.remove('d-none');
                }
            });
        }


        function selectProduct(productId, productName, productPrice, productDiscount, productInventory) {
            if (productInventory <= 0) {
                toastr.error(`${productName} is out of stock!`);
                return;
            }


            const priceAfterDiscount = productPrice - productDiscount;

            const tableBody = document.getElementById('selected_product_table');
            const existingRow = Array.from(tableBody.rows).find(row => row.getAttribute('data-id') == productId);
            const inputElement = document.getElementById('product_search');

            inputElement.value = '';
            const searchResults = document.getElementById('search_results');
            searchResults.classList.add('d-none');

            if (existingRow) {
                const qtyInput = existingRow.querySelector('.qty-input');
                qtyInput.value = parseInt(qtyInput.value) + 1;
                updateSubtotal(qtyInput, priceAfterDiscount);
            } else {
                const rowCount = tableBody.rows.length + 1;
                const row = tableBody.insertRow();
                row.setAttribute('data-id', productId);

                row.innerHTML = `
            <td>${rowCount}</td>
            <td>${productName}</td>
            <td><input type="number" value="1" class="qty-input" onchange="updateSubtotal(this, ${priceAfterDiscount})"></td>
            <td class="price">${priceAfterDiscount.toFixed(2)}</td>
            <td class="subtotal">${priceAfterDiscount.toFixed(2)}</td>
            <td>
                <button type="button" class="btn btn-danger btn-sm" onclick="removeProduct(this)">
                    <i class="fa fa-times"></i>
                </button>
            </td>
        `;

                calculateTotalSubtotal();
            }
        }



        function calculateTotalSubtotal() {
            const subtotals = document.querySelectorAll('.subtotal');
            const qtyInputs = document.querySelectorAll('.qty-input');
            let total = 0;
            let totalQty = 0;

            subtotals.forEach(subtotal => {
                total += parseFloat(subtotal.textContent) || 0;
            });

            qtyInputs.forEach(input => {
                totalQty += parseInt(input.value) || 0; // Sum up the quantities
            });

            // Ensure the input fields get updated before submission
            document.getElementById('total_subtotal').textContent = total.toFixed(2);
            document.getElementById('totalusd').textContent = total.toFixed(2);
            document.getElementById('sub_total').value = total.toFixed(2); // ✅ Fix: update input value
            document.getElementById('total').textContent = total.toFixed(2);
            document.getElementById('total_qty').textContent = totalQty; // ✅ Ensure total quantity is updated
            const totalKhr = total * exchangeRate;
            document.getElementById('total_khr').textContent = totalKhr.toFixed(2);
            document.getElementById('totalriel').textContent = totalKhr.toFixed(2);
            if (parseFloat(document.getElementById('total_discount').textContent) === 0) {
                document.getElementById('total').textContent = total.toFixed(2);
            }
            document.getElementById('total_discount').textContent = "0.00";
            document.getElementById('total').textContent = document.getElementById('total_subtotal').textContent;

        }


        function updateSubtotal(inputElement, price) {
            const row = inputElement.closest('tr');
            let qty = parseInt(inputElement.value);

            if (qty <= 1) {
                qty = 1;
                inputElement.value = 1;
            }

            const subtotal = (qty * price).toFixed(2);
            row.querySelector('.subtotal').textContent = subtotal;

            calculateTotalSubtotal();

        }

        function removeProduct(button) {
            const row = button.closest('tr');
            row.remove();
            calculateTotalSubtotal(); // Recalculate after removal
            document.getElementById('total_discount').textContent = "0.00";
            document.getElementById('total').textContent = document.getElementById('total_subtotal').textContent;
        }

        function getSelectedProducts() {
            // Correctly pass the inventory field, not qty, in the selected products object
            const products = [];
            document.querySelectorAll("#selected_product_table tr").forEach(row => {
                const productId = row.getAttribute("data-id");
                const qtyInput = row.querySelector(".qty-input");
                const priceElement = row.querySelector(".price");
                const subtotalElement = row.querySelector(".subtotal");

                if (productId && qtyInput && priceElement && subtotalElement) {
                    const qty = parseInt(qtyInput.value) || 0; // Make sure this is inventory if needed
                    const price = parseFloat(priceElement.textContent) || 0;
                    const subtotal = parseFloat(subtotalElement.textContent) || 0;

                    if (qty > 0) {
                        products.push({
                            id: productId,
                            inventory: qty, // This should correspond to your database field name (inventory or qty)
                            price: price,
                            subtotal: subtotal
                        });
                    }
                }
            });

            return products;
        }

        function getPaymentData() {
            const payments = [];

            document.querySelectorAll('#paymentTableBody tr').forEach(row => {
                // Get paymentType from the first cell
                const paymentType = row.cells[0].textContent;

                // Get paymentTypeId from the data-id attribute
                const paymentTypeId = row.cells[0].getAttribute('data-id');

                // Get the amount from the second cell
                const amount = parseFloat(row.cells[1].textContent) || 0;

                console.log('Payment Type ID:', paymentTypeId); // Debugging log
                console.log('Amount:', amount); // Debugging log

                // Check if paymentTypeId and amount are valid before adding to the array

                payments.push({
                    name: paymentType,
                    amount,
                    payment_type_id: paymentTypeId // Include payment_type_id here
                });

            });

            return payments;
        }


        function storeSale() {
            calculateTotalSubtotal();

            const customerId = document.getElementById("searchableSelect").value;
            const totalQty = parseInt(document.getElementById("total_qty").textContent) || 0;
            const subTotal = parseFloat(document.getElementById("sub_total").value) || 0;
            const grandTotal = parseFloat(document.getElementById("total").textContent) || 0;
            const totalKhr = parseFloat(document.getElementById('total_khr').textContent) || 0;
            const products = getSelectedProducts();
            const discountVal = $('#discount_value').val() || 0;
            const payments = getPaymentData() || 0;

            if (!customerId) {
                toastr.error("Please select a customer.");
                return;
            }

            if (products.length === 0) {
                toastr.error("No products selected.");
                return;
            }

            if (totalQty < 1) {
                toastr.error("Total quantity must be at least 1.");
                return;
            }

            $.ajax({
                url: "{{ route('admin.pos.store') }}",
                type: "POST",
                contentType: "application/json",
                data: JSON.stringify({
                    customer_id: customerId,
                    total_quantity: totalQty,
                    sub_total: subTotal,
                    grand_total: grandTotal,
                    total_khr: totalKhr,
                    discount: discountVal,
                    products: products,
                    payments: payments,
                    _token: "{{ csrf_token() }}"
                }),
                success: function(response) {
                    if (response.status == 1) {
                        toastr.success(response.msg);
                        setTimeout(() => location.reload(), 1500);
                    } else {
                        toastr.error(response.msg);
                    }
                },
                error: function(xhr) {
                    if (xhr.responseJSON && xhr.responseJSON.error) {
                        toastr.error("Error: " + xhr.responseJSON.error);
                    } else if (xhr.responseJSON && xhr.responseJSON.errors) {
                        let errorMessages = '';
                        for (const field in xhr.responseJSON.errors) {
                            errorMessages += xhr.responseJSON.errors[field].join('\n') + '\n';
                        }
                        toastr.error("Validation Errors:\n" + errorMessages);
                    } else {
                        toastr.error("Something went wrong!");
                    }
                }
            });
        }
    </script>
@endpush
