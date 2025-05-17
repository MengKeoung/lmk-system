<div class="bg-secondary text-white p-1">
    <div class="row">
        <div class="col">
           <div class="ml-3">
             <p>POS</p>
           </div>
        </div>
        <div class="col d-flex justify-content-end mr-3">
            <div class="mr-2">
                <a href="{{ route('admin.customers.create') }}" class="btn btn-warning text-white btn-block">
                    <i class="fa fa-plus"></i> Add Customer
                </a>
            </div>

            <div class="mr-2">
                <a href="{{ route('admin.products.create') }}" class="btn btn-info btn-block">
                    <i class="fa fa-plus"></i> Add Product
                </a>
            </div>
           <div class="">
             <a href="/" class="btn btn-light  btn-block">Back to Dashboard</a>
           </div>
        </div>
    </div>
</div>
