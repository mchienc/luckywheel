<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Thêm phần thưởng</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="{{ route('manager-spins.store') }}" method="POST" enctype="multipart/form-data" id="reward_add_form">
            @csrf
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label" for="basic-url">Tên phần thưởng</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Tên phần thưởng">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label" for="basic-url">Giải thưởng</label>
                            <input type="text" class="form-control price" name="reward" id="reward" placeholder="Nhập số tiền thưởng">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label" for="basic-url">Tỷ lệ trúng</label>
                            <input type="number" class="form-control" name="rate" id="rate" placeholder="Nhập tỷ lệ quay thưởng, 0 - 100">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="exampleSelectRounded0">Trạng thái</label>
                            <select class="custom-select rounded-0" name="status" id="exampleSelectRounded0">
                              <option value="show">Hiện</option>
                              <option value="hide">Ẩn</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary submit_add">Lưu</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
            </div>
        </form>
    </div>
</div>
<script>
    $('form#reward_add_form').validate({
        rules: {
            "name": {
                required: true,
                maxlength: 190
            },
            "reward": {
                required: true
            },
            "rate": {
                required: true,
                number: true,
                min: 0,
                max: 100
            }
        },
        messages: {
            "name": {
                required: "Vui lòng nhập tên phần thưởng",
                maxlength: "Tên không được quá 190 ký tự"
            },
            "reward": {
                required: "Vui lòng nhập giải thưởng"
            },
            "rate": {
                required: "Vui lòng nhập tỷ lệ",
                number: "Tỷ lệ phải là số",
                min: "Tỷ lệ tối thiểu là 0",
                max: "Tỷ lệ tối đa là 100"
            }
        }
    });

    $('form#reward_add_form').submit(function(e) {
        e.preventDefault();
        if ($('form#reward_add_form').valid() == true) {
            $('.submit_add').attr('disabled', true);
            let data = new FormData($('#reward_add_form')[0]);
            $.ajax({
                method: 'POST',
                url: $(this).attr('action'),
                dataType: 'json',
                data: data,
                contentType: false,
                processData: false,
                success: function(result) {
                    if (result.success == true) {
                        $('.submit_add').removeAttr('disabled');
                        $('div.reward_modal').modal('hide');
                        toastr.success(result.msg);
                        if (typeof($('#reward_table').DataTable()) != 'undefined') {
                            $('#reward_table').DataTable().ajax.reload();
                        }
                    } else {
                        toastr.error(result.msg);
                        $('.submit_add').attr('disabled', false);
                    }
                },
                error: function(err) {
                    if (err.status == 422) {
                        $('.error').html('');
                        $.each(err.responseJSON.errors, function(i, error) {
                            $(document).find('[name="' + i + '"]').after($('<label class="error">' + error + '</label>'));
                        });
                    }
                    $('.submit_add').attr('disabled', false);
                }
            });
        }
    });
</script>
