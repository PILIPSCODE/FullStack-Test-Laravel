<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Daftar Pegawai</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- CSS Dependencies -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.1.5/css/fileinput.min.css" rel="stylesheet">

    <!-- Custom Modern Styling -->
    <style>
        :root {
            --primary: #4f46e5;
            --primary-hover: #4338ca;
            --surface: #ffffff;
            --background: #f8fafc;
            --text-main: #0f172a;
            --text-muted: #64748b;
            --border-color: #e2e8f0;
            --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
            --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
            --radius-lg: 1rem;
            --radius-md: 0.75rem;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--background);
            color: var(--text-main);
            -webkit-font-smoothing: antialiased;
        }

        /* Animations */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .animate-fade-up {
            animation: fadeUp 0.5s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        /* Main Container Card */
        .glass-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-lg);
            padding: 2rem;
            margin-top: 2rem;
            margin-bottom: 3rem;
        }

        /* Typography */
        .page-title {
            font-weight: 700;
            font-size: 2rem;
            background: linear-gradient(135deg, var(--text-main) 0%, #334155 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            letter-spacing: -0.025em;
        }

        /* Inputs & Controls */
        .custom-control {
            border-radius: var(--radius-md);
            border: 1px solid var(--border-color);
            padding: 0.6rem 1rem;
            transition: all 0.2s ease;
            background-color: #f8fafc;
        }

        .custom-control:focus, .form-control:focus, .form-select:focus {
            background-color: #fff;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
            outline: none;
        }

        .input-group-text {
            background-color: #f8fafc;
            border: 1px solid var(--border-color);
            border-right: none;
            color: var(--text-muted);
            border-top-left-radius: var(--radius-md);
            border-bottom-left-radius: var(--radius-md);
        }

        #customSearch {
            border-top-right-radius: var(--radius-md);
            border-bottom-right-radius: var(--radius-md);
            border-left: none;
            padding-left: 0;
            background-color: #f8fafc;
        }

        /* Buttons */
        .btn-premium {
            background: linear-gradient(135deg, var(--primary) 0%, #6366f1 100%);
            color: white;
            border: none;
            border-radius: 9999px;
            padding: 0.6rem 1.5rem;
            font-weight: 500;
            box-shadow: 0 4px 6px -1px rgba(79, 70, 229, 0.3);
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-premium:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(79, 70, 229, 0.4);
            color: white;
        }

        .btn-premium:active {
            transform: translateY(0);
        }

        /* DataTables Customization */
        table.dataTable {
            border-collapse: separate;
            border-spacing: 0 0.5rem;
            margin-top: 1rem !important;
            border: none;
        }

        table.dataTable thead th {
            border: none;
            background-color: transparent;
            color: var(--text-muted);
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.05em;
            padding-bottom: 1rem;
            border-bottom: 2px solid var(--border-color);
        }

        table.dataTable tbody tr {
            background-color: #fff;
            box-shadow: var(--shadow-sm);
            border-radius: var(--radius-md);
            transition: all 0.2s ease;
        }

        table.dataTable tbody tr:hover {
            box-shadow: var(--shadow-md);
            transform: translateY(-1px);
            background-color: #fafafa;
        }

        table.dataTable tbody td {
            border: none;
            padding: 1rem;
            vertical-align: middle;
            color: var(--text-main);
            font-size: 0.875rem;
        }

        table.dataTable tbody td:first-child {
            border-top-left-radius: var(--radius-md);
            border-bottom-left-radius: var(--radius-md);
            font-weight: 500;
        }

        table.dataTable tbody td:last-child {
            border-top-right-radius: var(--radius-md);
            border-bottom-right-radius: var(--radius-md);
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            border-radius: var(--radius-md);
            border: none;
            background: transparent;
            color: var(--text-muted);
            padding: 0.5rem 1rem;
            margin: 0 0.25rem;
            transition: all 0.2s ease;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current, 
        .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
            background: var(--primary);
            color: white !important;
            border: none;
            box-shadow: var(--shadow-sm);
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover:not(.current) {
            background: #f1f5f9;
            color: var(--text-main) !important;
            border: none;
        }

        /* User Avatar Image */
        .avatar-img {
            width: 40px;
            height: 40px;
            object-fit: cover;
            border-radius: 50%;
            border: 2px solid white;
            box-shadow: var(--shadow-sm);
            transition: transform 0.2s ease;
        }
        
        .avatar-img:hover {
            transform: scale(1.1);
        }

        /* Modal Polish */
        .modal-content {
            border: none;
            border-radius: var(--radius-lg);
            box-shadow: 0 25px 50px -12px rgb(0 0 0 / 0.25);
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(10px);
        }

        .modal-header {
            border-bottom: 1px solid var(--border-color);
            padding: 1.5rem;
        }

        .modal-title {
            font-weight: 600;
            color: var(--text-main);
        }

        .modal-body {
            padding: 1.5rem;
        }

        .form-floating > label {
            color: var(--text-muted);
        }
        
        .form-floating > .form-control:focus ~ label,
        .form-floating > .form-control:not(:placeholder-shown) ~ label {
            color: var(--primary);
            transform: scale(.85) translateY(-.5rem) translateX(.15rem);
        }

        .select2-container--default .select2-selection--single {
            height: calc(3.5rem + 2px);
            padding: 1rem 0.75rem;
            border-radius: var(--radius-md);
            border: 1px solid var(--border-color);
            background-color: #fff;
        }
        
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: calc(3.5rem + 2px);
            right: 0.75rem;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 1.25;
            color: var(--text-main);
        }
        
        /* Select2 Focus state mimicking floating label style */
        .select2-container--focus .select2-selection--single {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
        }
        
        .select-label {
            font-size: 0.85rem;
            color: var(--text-muted);
            margin-bottom: 0.25rem;
            display: block;
        }
    </style>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.1.5/js/fileinput.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
</head>

<body>
    <div class="container animate-fade-up">
        
        <div class="glass-card">
            <!-- Header Section -->
            <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">
                <div>
                    <h1 class="page-title mb-1">Manajemen Pegawai</h1>
                    <p class="text-muted mb-0">Kelola direktori data pegawai perusahaan Anda.</p>
                </div>
                <button class="btn btn-premium" data-bs-toggle="modal" data-bs-target="#modalTambah">
                    <i class="bi bi-plus-circle"></i> Tambah Pegawai
                </button>
            </div>

            <!-- Controls Section -->
            <div class="row g-3 mb-4">
                <!-- Search -->
                <div class="col-12 col-md-6">
                    <div class="input-group">
                        <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
                        <input type="text" id="customSearch" class="form-control custom-control border-start-0 ps-0 bg-white" 
                               placeholder="Cari nama atau email..." aria-label="Cari Pegawai">
                    </div>
                </div>

                <!-- Filter -->
                <div class="col-12 col-md-4 ms-auto">
                    <select id="jabatanFilter" class="form-select custom-control bg-white">
                        <option value="">Semua Jabatan</option>
                        <option value="Manager">Manager</option>
                        <option value="HR">HR</option>
                        <option value="IT">IT</option>
                    </select>
                </div>
            </div>

            <!-- Table Section -->
            <div class="table-responsive">
                <table id="pegawaiTable" class="table dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                            <th>Profil</th>
                            <th>Nama Lengkap</th>
                            <th>Email</th>
                            <th>Jabatan</th>
                            <th>Tanggal Lahir</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Data DataTables -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Pegawai -->
    <div class="modal fade" id="modalTambah" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fs-4">Tambah Pegawai Baru</h5>
                    <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formTambah">
                        @csrf
                        
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control custom-control" id="floatingNama" name="nama" placeholder="Matius" required>
                            <label for="floatingNama">Nama Lengkap</label>
                        </div>
                        
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control custom-control" id="floatingEmail" name="email" placeholder="name@example.com" required>
                            <label for="floatingEmail">Alamat Email</label>
                        </div>
                        
                        <div class="mb-3">
                            <label class="select-label">Pilih Jabatan</label>
                            <select class="form-select select2" name="jabatan" required style="width: 100%;">
                                <option value="Manager">Manager</option>
                                <option value="HR">HR</option>
                                <option value="IT">IT</option>
                            </select>
                        </div>
                        
                        <div class="form-floating mb-3">
                            <input type="date" class="form-control custom-control" id="floatingTglLahir" name="tanggal_lahir" placeholder="YYYY-MM-DD" required>
                            <label for="floatingTglLahir">Tanggal Lahir</label>
                        </div>
                        
                        <div class="mb-4">
                            <label class="select-label mb-2">Unggah Foto Profil</label>
                            <input id="file-upload" name="foto" type="file" class="file" data-show-upload="false" data-show-caption="true">
                        </div>
                        
                        <button type="button" id="btnSimpan" class="btn btn-premium w-100 justify-content-center py-3">
                            <i class="bi bi-check2-circle me-1"></i> Simpan Data Pegawai
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script>
        $(document).ready(function() {
            var table = $('#pegawaiTable').DataTable({
                processing: true,
                searching: false,
                serverSide: true,
                pageLength: 5,
                lengthMenu: [
                    [5, 10, 25, 50],
                    [5, 10, 25, 50]
                ],
                language: {
                    processing: '<div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div>',
                    lengthMenu: "_MENU_ data per halaman",
                    zeroRecords: "Tidak ada data pegawai yang ditemukan.",
                    info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ pegawai",
                    infoEmpty: "Menampilkan 0 sampai 0 dari 0 pegawai",
                    paginate: {
                        first: "Awal",
                        last: "Akhir",
                        next: "Seterusnya",
                        previous: "Sebelumnya"
                    }
                },
                ajax: {
                    url: "{{ route('pegawai.data') }}",
                    data: function(d) {
                        d.search.value = $('#customSearch').val();
                        d.jabatan = $('#jabatanFilter').val();
                    }
                },
                columns: [
                    {
                        data: 'foto',
                        name: 'foto',
                        orderable: false,
                        searchable: false,
                        responsivePriority: 1,
                        render: function(data, type, row) {
                            if(data) {
                                return `<img src="/storage/${data}" class="avatar-img" alt="Foto ${row.nama}">`;
                            }
                            return `<div class="d-flex justify-content-center align-items-center avatar-img bg-light text-secondary border">
                                        <i class="bi bi-person fs-5"></i>
                                    </div>`;
                        }
                    },
                    {
                        data: 'nama',
                        name: 'nama',
                        responsivePriority: 2,
                        render: function(data) {
                            return `<span class="fw-semibold">${data}</span>`;
                        }
                    },
                    {
                        data: 'email',
                        name: 'email',
                        responsivePriority: 3,
                        render: function(data) {
                            return `<a href="mailto:${data}" class="text-decoration-none text-muted"><i class="bi bi-envelope me-1"></i>${data}</a>`;
                        }
                    },
                    {
                        data: 'jabatan',
                        name: 'jabatan',
                        responsivePriority: 4,
                        render: function(data) {
                            let badgeClass = 'bg-secondary';
                            if(data === 'Manager') badgeClass = 'bg-primary';
                            else if(data === 'HR') badgeClass = 'bg-success';
                            else if(data === 'IT') badgeClass = 'bg-info text-dark';
                            
                            return `<span class="badge ${badgeClass} rounded-pill px-3 py-2 fw-normal">${data}</span>`;
                        }
                    },
                    {
                        data: 'tanggal_lahir',
                        name: 'tanggal_lahir',
                        responsivePriority: 5,
                        render: function(data) {
                            return `<span class="text-muted"><i class="bi bi-calendar3 me-1"></i>${data}</span>`;
                        }
                    }
                ],
                responsive: true,
                dom: '<"top"i>rt<"bottom d-flex justify-content-between align-items-center mt-3"lp><"clear">'
            });

            $('#customSearch').on('keyup', function() {
                $('#pegawaiTable').DataTable().ajax.reload();
            });

            $('#jabatanFilter').on('change', function() {
                $('#pegawaiTable').DataTable().ajax.reload();
            });

            // select2
            $('#jabatanFilter').select2({
                minimumResultsForSearch: Infinity,
                width: '100%'
            });
            
            $('.select2[name="jabatan"]').select2({
                dropdownParent: $('#modalTambah'),
                minimumResultsForSearch: Infinity,
                width: '100%'
            });

            $('#btnSimpan').on('click', function() {
                var nama = $.trim($('#floatingNama').val());
                var email = $.trim($('#floatingEmail').val());
                var jabatan = $('select[name="jabatan"]').val();
                var tanggal_lahir = $.trim($('input[name="tanggal_lahir"]').val());

                var errors = [];
                if (!nama || nama.length < 3) errors.push('Nama wajib diisi (minimal 3 karakter)');
                if (!email || !email.includes('@')) errors.push('Email tidak valid');
                if (!jabatan) errors.push('Silakan pilih jabatan');
                if (!tanggal_lahir) errors.push('Tanggal lahir wajib diisi');

                if (errors.length > 0) {
                    alert('Harap lengkapi form:\n\n' + errors.join('\n'));
                    return;
                }

                var formData = new FormData(document.getElementById('formTambah'));
                formData.set('_token', $('meta[name="csrf-token"]').attr('content'));

                let submitBtn = $(this);
                let originalText = submitBtn.html();
                submitBtn.html('<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Menyimpan...').prop('disabled', true);

                $.ajax({
                    url: "{{ route('pegawai.store') }}",
                    type: "POST",
                    data: formData,
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        $('#modalTambah').modal('hide');
                        document.getElementById('formTambah').reset();
                        $('select[name="jabatan"]').val(null).trigger('change');
                        $('#file-upload').fileinput('clear');
                        $('#pegawaiTable').DataTable().ajax.reload();

                        const toastHtml = `
                        <div class="toast align-items-center text-white bg-success border-0 position-fixed bottom-0 end-0 m-4" role="alert" aria-live="assertive" aria-atomic="true" style="z-index: 1060; border-radius: var(--radius-md);">
                          <div class="d-flex">
                            <div class="toast-body d-flex align-items-center">
                              <i class="bi bi-check-circle-fill me-2 fs-5"></i>
                              Pegawai berhasil ditambahkan!
                            </div>
                            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                          </div>
                        </div>`;
                        $('body').append(toastHtml);
                        let toastEl = $('.toast').last();
                        new bootstrap.Toast(toastEl[0], { delay: 3000 }).show();
                        toastEl.on('hidden.bs.toast', function() { $(this).remove(); });
                    },
                    error: function(xhr) {
                        console.error('Error:', xhr);
                        if (xhr.status === 422) {
                            let errs = xhr.responseJSON.errors;
                            let msgs = Object.values(errs).map(e => e[0]);
                            alert('Validasi Gagal:\n\n' + msgs.join('\n'));
                        } else {
                            alert('Terjadi kesalahan sistem. Silakan coba lagi.');
                        }
                    },
                    complete: function() {
                        submitBtn.html(originalText).prop('disabled', false);
                    }
                });
            });


            // Date Picker
            $('input[name="tanggal_lahir"]').daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                autoUpdateInput: false,
                locale: { format: 'YYYY-MM-DD' }
            });

            $('input[name="tanggal_lahir"]').on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('YYYY-MM-DD'));
            });

            //File Input
            $("#file-upload").fileinput({
                allowedFileExtensions: ["jpg", "jpeg", "png"],
                maxFileSize: 2048,
                showUpload: false,
                dropZoneEnabled: false,
                theme: "fas",
                initialCaption: "Pilih Foto Profil (Max 2MB)",
                previewFileType: "image"
            });
        });
    </script>
</body>

</html>
