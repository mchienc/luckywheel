@extends('layouts.master')
@section('title')
    <title>Vòng quay may mắn</title>
@endsection
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Danh sách vòng quay</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Danh sách vòng quay</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
  <!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-primary card-outline">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-inline">
                                <div class="input-group" data-widget="sidebar-search">
                                <input class="form-control" type="search" placeholder="Tìm kiếm..." id="search-btn">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8 group-btn text-right">
                            <button type="button" class="btn btn-primary add_reward" data-container=".reward_modal"
                            data-href="{{ route('manager-spins.create') }}"><i class="fa fa-plus"></i> Thêm phần thưởng</button>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <p>Tối đa chỉ có thể hiển thị 15 phần thưởng, bạn chỉ có thể chỉnh sửa hoặc xoá chúng và thêm lại.</p>
                    <table id="reward_table" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Tên phần thưởng</th>
                            <th>Giải thưởng</th>
                            <th>Tỷ lệ trúng</th>
                            <th>Trạng thái</th>
                            <th style="width: 15%">Thao tác</th>
                        </tr>
                    </thead>
                    </table>
                </div>
                <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <div class="modal fade reward_modal" id="reward_modal" tabindex="-1" role="dialog"></div>
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection
@section('script')
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var debounceTripDetail = null;
    $('#search-btn').on('input', function(){
        clearTimeout(debounceTripDetail);
        debounceTripDetail = setTimeout(() => {
            reward_table.search($(this).val()).draw();
        }, 500);
    });

    var reward_table = $('#reward_table').DataTable({
        "destroy": true,
        "lengthChange": false,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
        "pageLength": 15,
        aaSorting: [
            [0, 'desc']
        ],
        "pagingType": "full_numbers",
        "language": {
            "info": "Hiển thị _START_ đến _END_ của _TOTAL_ mục",
            "infoEmpty": "Hiển thị 0 đến 0 của 0 mục",
            "infoFiltered": '',
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "Hiển thị _MENU_ mục",
            "loadingRecords": "Đang tải...",
            "processing": "Đang xử lý...",
            "emptyTable": "Không có dữ liệu",
            "zeroRecords": "Không tìm thấy kết quả",
            "search": "Tìm kiếm",
            "paginate": {
                'first': '<i class="fa fa-angle-double-left"></i>',
                'previous': '<i class="fa fa-angle-left" ></i>',
                'next': '<i class="fa fa-angle-right" ></i>',
                'last': '<i class="fa fa-angle-double-right"></i>'
            },
        },
        ajax: {
            url: "{{ route('manager-spins.index') }}",
        },
        order: [],
        "columns":[
            {"data": "name", orderable: false , class: 'text-center'},
            {"data": "reward", class: 'text-center'},
            {"data": "rate", class: 'text-center'},
            {"data": "status", class: 'text-center' },
            {"data": "action", orderable: false}
        ]
    });

    $(document).on('click', '.add_reward', function(e) {
        e.preventDefault();
        $('div.reward_modal').load($(this).attr('data-href'), function() {
            $(this).modal('show');
        });
    });

    $(document).on('click', '.edit_reward', function(e) {
        e.preventDefault();
        $('div.reward_modal').load($(this).attr('data-href'), function() {
            $(this).modal('show');
        });
    });

    $('.reward_modal').on('shown.bs.modal', function (e) {
        function formatNumber(num) {
            var n = Number(num.replace(/,/g, ''));
            return n.toLocaleString("en");
        }
        $('.price').on('keyup', function() {
            var num = $(this).val().replace(/[^0-9]+/i, '');

            if (num != '') {
                let money = formatNumber(num);

                $(this).val(money)
            } else {
                $(this).val(0)
            }
        });
    })

     // delete
     $(document).on('click', '.delete_reward', function(e) {
        let name = $(this).data('name');
        var url = $(this).data('href');
        Swal.fire({
            title: `Bạn có muốn xóa ${name} không?`,
            icon: 'warning',
            showCancelButton: true,
            cancelButtonColor: '#d33',
            confirmButtonColor: '#3085d6',
            cancelButtonText: "Hủy",
            confirmButtonText: "Xóa",
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    method: "DELETE",
                    url: url,
                    dataType: "json",
                    success: function(result) {
                        if (result.success == true) {
                            toastr.success(result.msg);
                        }else{
                            toastr.error(result.msg);
                        }
                        reward_table.ajax.reload(null, false);
                    }
                })
            }
        });
    });
</script>
@endsection
