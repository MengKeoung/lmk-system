    @include('backends.setting.currency.table')

    <div class="modal fade" id="createCurrencyModal" tabindex="-1" role="dialog"
        aria-labelledby="createCurrencyModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('admin.currencies.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="createCurrencyModalLabel">{{ __('Add New Currency') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="{{ __('Close') }}">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">{{ __('Name') }}</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>

                        <div class="form-group">
                            <label for="symbol">{{ __('Symbol') }}</label>
                            <textarea class="form-control" name="symbol"></textarea>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">{{ __('Cancel') }}</button>
                        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    <!-- Edit Currency Modal -->
    <div class="modal fade" id="editCurrencyModal" tabindex="-1" role="dialog"
        aria-labelledby="editCurrencyModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="editCurrencyForm" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="modal-header">
                        <h5 class="modal-title" id="editCurrencyModalLabel">{{ __('Edit Currency') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="{{ __('Close') }}">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <input type="hidden" name="id" id="edit_currency_id">

                        <div class="form-group">
                            <label for="edit_name">{{ __('Name') }}</label>
                            <input type="text" class="form-control" name="name" id="edit_name" required>
                        </div>

                        <div class="form-group">
                            <label for="edit_symbol">{{ __('Symbol') }}</label>
                            <textarea class="form-control" name="symbol" id="edit_symbol"></textarea>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">{{ __('Cancel') }}</button>
                        <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @push('js')
        <script>
            $('.btn_add').click(function(e) {
                var tbody = $('.tbody');
                var numRows = tbody.find("tr").length;
                $.ajax({
                    type: "get",
                    url: window.location.href,
                    data: {
                        "key": numRows
                    },
                    dataType: "json",
                    success: function(response) {
                        $(tbody).append(response.tr);
                    }
                });
            });

            $('.custom-file-input').change(function(e) {
                var reader = new FileReader();
                var preview = $(this).closest('.form-group').find('.preview img');
                console.log(preview);
                reader.onload = function(e) {
                    preview.attr('src', e.target.result).show();
                }
                reader.readAsDataURL(this.files[0]);
            });

            $(document).on('click', '.btn-delete', function(e) {
                e.preventDefault();

                const Confirmation = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn btn-success',
                        cancelButton: 'btn btn-danger'
                    },
                    buttonsStyling: false
                });

                Confirmation.fire({
                    title: '{{ __('Are you sure?') }}',
                    text: @json(__('You won\'t be able to revert this!')),
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: '{{ __('Yes, delete it!') }}',
                    cancelButtonText: '{{ __('No, cancel!') }}',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {

                        console.log(`.form-delete-${$(this).data('id')}`);
                        var data = $(`.form-delete-${$(this).data('id')}`).serialize();
                        // console.log(data);
                        $.ajax({
                            type: "post",
                            url: $(this).data('href'),
                            data: data,
                            // dataType: "json",
                            success: function(response) {
                                console.log(response);
                                if (response.status == 1) {
                                    $('.table-wrapper').replaceWith(response.view);
                                    toastr.success(response.msg);
                                } else {
                                    toastr.error(response.msg)

                                }
                            }
                        });
                    }
                });
            });
            $('#editCurrencyModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget); // Button that triggered the modal
                var id = button.data('id');
                var name = button.data('name');
                var symbol = button.data('symbol');

                var modal = $(this);
                modal.find('#edit_currency_id').val(id);
                modal.find('#edit_name').val(name);
                modal.find('#edit_symbol').val(symbol);

                modal.find('form').attr('action', '/admin/currencies/' + id);
            });
        </script>
    @endpush
