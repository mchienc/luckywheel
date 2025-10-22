<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Sửa phần thưởng</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="{{ route('manager-spins.update', $spin->id) }}" method="POST" enctype="multipart/form-data" id="reward_edit_form">
            @method('put')
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label" for="basic-url">Tên phần thưởng</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Tên phần thưởng" value="{{ $spin->name }}">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label" for="basic-url">Giải thưởng</label>
                            <input type="text" class="form-control price" name="reward" id="reward" placeholder="Nhập số tiền thưởng" value="{{ number_format($spin->reward) }}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label" for="basic-url">Tỷ lệ trúng</label>
                            <input type="number" class="form-control" name="rate" id="rate" placeholder="Nhập tỷ lệ quay thưởng, 0 - 100" value="{{ $spin->rate }}">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="exampleSelectRounded0">Trạng thái</label>
                            <select class="custom-select rounded-0" name="status" id="exampleSelectRounded0">
                                @foreach (['show' => 'Hiện ', 'hide' => 'Ẩn'] as $key => $value)
                                    <option  @if($spin->status == $key) selected  @endif value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary submit_edit">{{ __('Update') }}</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
            </div>
        </form>
    </div>
</div>
<script>
    $('form#reward_edit_form').validate({
        rules: {
            "name": {
                required: true,
                maxlength: 190
            },
            "rate": {
                required: true,
                number: true
            }
        },
        messages: {
            "name": {
                required: "{{ __('This field is required') }}",
                maxlength: "{{ __('190 characters limit') }}"
            },
            "rate": {
                required: "{{ __('This field is required') }}",
                number: "{{ __('Only numbers can be entered') }}"
            }
        }
    });

    $('form#reward_edit_form').submit(function(e) {
        e.preventDefault();
        if ($('form#reward_edit_form').valid() == true) {
            $('.submit_edit').attr('disabled', true);
            let data = new FormData($('#reward_edit_form')[0]);
            $.ajax({
                method: 'POST',
                url: $(this).attr('action'),
                dataType: 'json',
                data: data,
                contentType: false,
                processData: false,
                success: function(result) {
                    if (result.success == true) {
                        $('.submit_edit').removeAttr('disabled');
                        $('div.reward_modal').modal('hide');
                        toastr.success(result.msg);
                        if (typeof($('#reward_table').DataTable()) != 'undefined') {
                            $('#reward_table').DataTable().ajax.reload();
                        }
                    } else {
                        toastr.error(result.msg);
                        $('.submit_edit').attr('disabled', false);
                    }
                },
                error: function(err) {
                    if (err.status == 422) {
                        $('.error').html('');
                        $.each(err.responseJSON.errors, function(i, error) {
                            $(document).find('[name="' + i + '"]').after($('<label class="error">' + error + '</label>'));
                        });
                    }
                    $('.submit_edit').attr('disabled', false);
                }
            });
        }
    });
</script>
