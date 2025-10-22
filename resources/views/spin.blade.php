<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Vòng quay may mắn</title>
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('AdminLTE-3.1.0/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ asset('AdminLTE-3.1.0/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('AdminLTE-3.1.0/dist/css/adminlte.min.css') }}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset('AdminLTE-3.1.0/plugins/daterangepicker/daterangepicker.css') }}">
  <!-- DataTable -->
  <link rel="stylesheet" href="{{ asset('AdminLTE-3.1.0/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('AdminLTE-3.1.0/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('AdminLTE-3.1.0/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
  <!-- Toastr -->
  <link rel="stylesheet" href="{{ asset('AdminLTE-3.1.0/plugins/toastr/toastr.min.css') }}">

  <link rel="stylesheet" href="{{ asset('css/spin.css') }}">
  <style>
    #btn-spin{
        position: absolute;
        top: 35%;
        left: 49%;
        transform: translate(-50%, 50%);
        z-index: 10;
        background-color: #ffffff12;
        text-transform: uppercase;
        border: 8px solid #ffffff12;
        font-weight: bold;
        font-size: 25px;
        color: rgb(211, 46, 46);
        border-radius: 50%;
        width: 80px;
        height: 80px;
        cursor: pointer;
        outline: none;
        letter-spacing: 1px
    }
  </style>
</head>
<body class="hold-transition" style="background-image: url('AdminLTE-3.1.0/dist/img/bg7.jpg')">
    <div class="wrapper">
        <section class="content">
            <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-6">
                    <center>
                        <div id="wheel" class="fortune__wheel">
                            <svg viewBox="0 0 800 800">
                                <g class="chartholder" transform="translate(400,400)">
                                    <g id="spin">
                                        <image xlink:href="{{ asset('images/wheel.webp') }}" width="800" height="800" x="-400" y="-400"></image>
                                        <g><text x="-110" y="5" class="wheelText" text-anchor="middle" text-rendering="optimizeLegibility" transform="rotate(-78)translate(290)">{{ isset($spin_name[0]) ? $spin_name[0] : '+ 0đ' }}<path fill-opacity="0.0" fill="#1f77b4" d="M1.8369701987210297e-14,-300A300,300 0 0,1 122.02099292274006,-274.06363729278024L0,0Z">
                                                </path>
                                            </text></g>
                                        <g><text x="-110" y="5" class="wheelText" text-anchor="middle" text-rendering="optimizeLegibility" transform="rotate(-54)translate(290)">{{ isset($spin_name[1]) ? $spin_name[1] : '+ 0đ' }}<path fill-opacity="0.0" fill="#aec7e8" d="M122.02099292274006,-274.06363729278024A300,300 0 0,1 222.94344764321826,-200.73918190765747L0,0Z">
                                                </path></text></g>
                                        <g><text x="-110" y="5" class="wheelText" text-anchor="middle" text-rendering="optimizeLegibility" transform="rotate(-30.000000000000007)translate(290)">{{ isset($spin_name[2]) ? $spin_name[2] : '+ 0đ' }}<path fill-opacity="0.0" fill="#ff7f0e" d="M222.94344764321826,-200.73918190765747A300,300 0 0,1 285.31695488854604,-92.70509831248422L0,0Z">
                                                </path>
                                            </text></g>
                                        <g><text x="-110" y="5" class="wheelText" text-anchor="middle" text-rendering="optimizeLegibility" transform="rotate(-6.000000000000014)translate(290)">{{ isset($spin_name[3]) ? $spin_name[3] : '+ 0đ' }}<path fill-opacity="0.0" fill="#ffbb78" d="M285.31695488854604,-92.70509831248422A300,300 0 0,1 298.356568610482,31.358538980296018L0,0Z">
                                                </path></text></g>
                                        <g><text x="-110" y="5" class="wheelText" text-anchor="middle" text-rendering="optimizeLegibility" transform="rotate(18)translate(290)">{{ isset($spin_name[4]) ? $spin_name[4] : '+ 0đ' }}<path fill-opacity="0.0" fill="#2ca02c" d="M298.356568610482,31.358538980296018A300,300 0 0,1 259.8076211353316,149.99999999999994L0,0Z">
                                                </path></text></g>
                                        <g><text x="-110" y="5" class="wheelText" text-anchor="middle" text-rendering="optimizeLegibility" transform="rotate(42)translate(290)">{{ isset($spin_name[5]) ? $spin_name[5] : '+ 0đ' }}<path fill-opacity="0.0" fill="#98df8a" d="M259.8076211353316,149.99999999999994A300,300 0 0,1 176.33557568774194,242.70509831248424L0,0Z">
                                                </path></text></g>
                                        <g><text x="-110" y="5" class="wheelText" text-anchor="middle" text-rendering="optimizeLegibility" transform="rotate(66)translate(290)">{{ isset($spin_name[6]) ? $spin_name[6] : '+ 0đ' }}<path fill-opacity="0.0" fill="#d62728" d="M176.33557568774194,242.70509831248424A300,300 0 0,1 62.37350724532777,293.4442802201417L0,0Z">
                                                </path></text></g>
                                        <g><text x="-110" y="5" class="wheelText" text-anchor="middle" text-rendering="optimizeLegibility" transform="rotate(90)translate(290)">{{ isset($spin_name[7]) ? $spin_name[7] : '+ 0đ' }}<path fill-opacity="0.0" fill="#ff9896" d="M62.37350724532777,293.4442802201417A300,300 0 0,1 -62.37350724532787,293.44428022014165L0,0Z">
                                                </path></text></g>
                                        <g><text x="-110" y="5" class="wheelText" text-anchor="middle" text-rendering="optimizeLegibility" transform="rotate(114.00000000000003)translate(290)">{{ isset($spin_name[8]) ? $spin_name[8] : '+ 0đ' }}<path fill-opacity="0.0" fill="#9467bd" d="M-62.37350724532787,293.44428022014165A300,300 0 0,1 -176.335575687742,242.70509831248418L0,0Z">
                                                </path></text></g>
                                        <g><text x="-110" y="5" class="wheelText" text-anchor="middle" text-rendering="optimizeLegibility" transform="rotate(138.00000000000003)translate(290)">{{ isset($spin_name[9]) ? $spin_name[9] : '+ 0đ' }}<path fill-opacity="0.0" fill="#c5b0d5" d="M-176.335575687742,242.70509831248418A300,300 0 0,1 -259.80762113533166,149.99999999999986L0,0Z">
                                                </path></text></g>
                                        <g><text x="-110" y="5" class="wheelText" text-anchor="middle" text-rendering="optimizeLegibility" transform="rotate(162)translate(290)">{{ isset($spin_name[10]) ? $spin_name[10] : '+ 0đ' }}<path fill-opacity="0.0" fill="#8c564b" d="M-259.80762113533166,149.99999999999986A300,300 0 0,1 -298.35656861048204,31.358538980295986L0,0Z">
                                                </path></text></g>
                                        <g><text x="-110" y="5" class="wheelText" text-anchor="middle" text-rendering="optimizeLegibility" transform="rotate(186.00000000000006)translate(290)">{{ isset($spin_name[11]) ? $spin_name[11] : '+ 0đ' }}<path fill-opacity="0.0" fill="#c49c94" d="M-298.35656861048204,31.358538980295986A300,300 0 0,1 -285.3169548885461,-92.70509831248418L0,0Z">
                                                </path>
                                            </text></g>
                                        <g><text x="-110" y="5" class="wheelText" text-anchor="middle" text-rendering="optimizeLegibility" transform="rotate(209.99999999999994)translate(290)">{{ isset($spin_name[12]) ? $spin_name[12] : '+ 0đ' }}<path fill-opacity="0.0" fill="#e377c2" d="M-285.3169548885461,-92.70509831248418A300,300 0 0,1 -222.94344764321835,-200.73918190765738L0,0Z">
                                                </path>
                                            </text></g>
                                        <g><text x="-110" y="5" class="wheelText" text-anchor="middle" text-rendering="optimizeLegibility" transform="rotate(234)translate(290)">{{ isset($spin_name[13]) ? $spin_name[13] : '+ 0đ' }}<path fill-opacity="0.0" fill="#f7b6d2" d="M-222.94344764321835,-200.73918190765738A300,300 0 0,1 -122.02099292274028,-274.0636372927802L0,0Z">
                                                </path></text></g>
                                        <g><text x="-110" y="5" class="wheelText" text-anchor="middle" text-rendering="optimizeLegibility" transform="rotate(257.9999999999999)translate(290)">{{ isset($spin_name[14]) ? $spin_name[14] : '+ 0đ' }}<path fill-opacity="0.0" fill="#7f7f7f" d="M-122.02099292274028,-274.0636372927802A300,300 0 0,1 -3.2156263187166844e-13,-300L0,0Z">
                                                </path></text></g>

                                    </g>
                                </g>
                                <image xlink:href="{{ asset('images/outwheel.webp') }}" width="800" height="800"></image>
                            </svg>
                        </div>
                        {{-- <button type="button" id="btn-spin">QUAY</button> --}}
                        <button type="button" class="btn btn-danger btn-block" id="btnSpin" style="width: 30%"><i class="fas fa-play mr-1"></i>QUAY NGAY</button>
                        <p class="form-error"></p>
                    </center>

                </div>
                <div class="col-lg-6" style="margin-top: 50px">
                    <div class="row">
                        <div class="col-12">
                            <div class="group-btn text-right">
                                <a href="{{ route('manager-spins.index') }}" class="btn btn-primary"><i class="fas fa-cog"></i> Cài đặt vòng quay</a>
                            </div>
                            <div class="card">
                                <div class="card-header d-flex justify-content-between">
                                    <div class="header-title">
                                        <h5 class="card-title">Lịch sử quay</h5>
                                    </div>
                                </div>
                            <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="row">
                                        <div class="input-group col-lg-12">
                                            <div class="col-lg-2">
                                                <div class="form-inline">
                                                    <div class="input-group" data-widget="sidebar-search">
                                                    <input class="form-control" type="text" placeholder="Tìm kiếm..." id="search-btn" class=" aria-label="Search">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="input-group date" id="daterangepicker"
                                                style="margin-left: 0px; padding-left: 0px;padding-right: 2px; margin-bottom: 3px">
                                                <input class="form-control" name="date" id="date" data-date-format="yyyy-mm-dd" type="text"
                                                value="{{ date('d/m/Y', strtotime($first_day)) . ' - ' . date('d/m/Y', strtotime($last_day)) }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <table id="spin_history_table" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>Giải thưởng</th>
                                                <th>Thời gian</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
    </div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{ asset('AdminLTE-3.1.0/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('AdminLTE-3.1.0/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('AdminLTE-3.1.0/dist/js/adminlte.min.js') }}"></script>
<!-- daterangepicker -->
<script src="{{ asset('AdminLTE-3.1.0/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('AdminLTE-3.1.0/plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- DataTable -->
<script src="{{ asset('AdminLTE-3.1.0/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('AdminLTE-3.1.0/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('AdminLTE-3.1.0/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('AdminLTE-3.1.0/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('AdminLTE-3.1.0/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('AdminLTE-3.1.0/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('AdminLTE-3.1.0/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('AdminLTE-3.1.0/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('AdminLTE-3.1.0/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<!-- Toastr -->
<script src="{{ asset('AdminLTE-3.1.0/plugins/toastr/toastr.min.js')}}"></script>
<script src="{{ asset('js/spin.js') }}"></script>
<script>
     $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

     $('input[name="date"]').daterangepicker({
        locale: {
            format: 'DD/MM/YYYY'
        },
    });

    $(document).on('change', '#date', function(){
        spin_history_table.ajax.reload();
    })

    var debounceTripDetail = null;
    $('#search-btn').on('input', function(){
        clearTimeout(debounceTripDetail);
        debounceTripDetail = setTimeout(() => {
            spin_history_table.search($(this).val()).draw();
        }, 500);
    });
    var spin_history_table =$('#spin_history_table').DataTable({
        "destroy": true,
        "lengthChange": false,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
        "pageLength": 10,
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
            url: "{{ route('spin') }}",
            data: function(d) {
                var start = '';
                var end = '';
                if ($('#date').val()) {
                    start = $('#date')
                        .data('daterangepicker')
                        .startDate.format('YYYY-MM-DD');
                    end = $('#date')
                        .data('daterangepicker')
                        .endDate.format('YYYY-MM-DD');
                }
                d.start_date = start;
                d.end_date = end;
            }
        },
        order: [],
        "columns":[
            {"data": "reward" },
            {"data": "created_at", class: 'text-center' },
        ]
    });

    $("#btnSpin").click(function() {
        StartSpin();
    });

    var quayCount = $(".wheelText").length;
    var vp = 360 / quayCount;

    function StartSpin() {
        $('#btnSpin').html('<i class="fa fa-spinner fa-spin"></i> Chờ kết quả...').prop('disabled',true);
        $.ajax({
            url: "{{ route('post.spin') }}",
            method: "POST",
            dataType: 'json',
            success: function(response) {
                if (response.status == 'error') {
                    toastr.error(response.msg);
                    $('#btnSpin').html('<i class="fas fa-play mr-1"></i>QUAY NGAY').prop('disabled', false);
                    return false;
                }
                var audio = new Audio("{{ asset('audio/roulette.mp3') }}");
                var audio1 = new Audio("{{ asset('audio/congratulation.mp3') }}");
                var out = response.location;
                var countLoop = 0;
                var x = 0;
                var loop = setInterval(() => {
                    audio.play();
                    document.getElementById("spin").style.transform = "rotate(" + (360 - x) + "deg)";
                    if (x >= vp * out - vp / 2 && countLoop == 2) {
                        clearInterval(loop);
                        quayStatus = true;
                        audio.pause();
                        audio1.play();
                        confetti();
                        toastr.success(response.msg);
                        setTimeout(() => {
                            $('#btnSpin').html('<i class="fas fa-play mr-1"></i>QUAY NGAY').prop('disabled', false);
                            spin_history_table.ajax.reload();
                        }, 4000);
                    } else {
                        if (x >= 360) {
                            countLoop = countLoop + 1;
                            x = 0;
                        }
                    }
                    x = x + 1;
                }, 1);
            }
        });
    }
</script>
</body>
</html>
