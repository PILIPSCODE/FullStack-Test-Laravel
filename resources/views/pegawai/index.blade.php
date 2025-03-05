<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Daftar Pegawai</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.1.5/css/fileinput.min.css"
        rel="stylesheet">

    <!-- script -->
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


<body class="container mt-5">
    <h1 class="mb-4 text-center">Daftar Pegawai</h1>

    <!-- Action Section -->
    <div class="container text-center my-3 ">
        <div class="row">
            <!-- Kolom Pencarian -->
            <div class="col-12 col-xl-7">
                <div class="input-group flex-nowrap">
                    <span class="input-group-text" id="addon-wrapping"><i class="bi bi-search"></i></span>
                    <input type="text" id="customSearch" class="form-control" placeholder="Cari Pegawai"
                        aria-label="Cari Pegawai" aria-describedby="addon-wrapping">
                </div>
            </div>

            <!-- Filter & Controls -->
            <div class="col-12 col-xl-5">
                <div class="d-flex justify-content-between flex-column flex-sm-row align-items-center w-100">
                    <!-- Dropdown Jabatan -->
                    <div class="d-flex align-items-center flex-column flex-sm-row w-100 w-md-auto my-md-0 my-2 mx-2">
                        <select id="jabatanFilter" class="form-select w-100 w-sm-auto">
                            <option value="">Semua Jabatan</option>
                            <option value="Manager">Manager</option>
                            <option value="HR">HR</option>
                            <option value="IT">IT</option>
                        </select>
                    </div>

                    <!-- Tombol Tambah Pegawai -->
                    <button class="btn btn-primary w-100 w-sm-auto" data-bs-toggle="modal"
                        data-bs-target="#modalTambah">
                        + Tambah Pegawai
                    </button>
                </div>
            </div>
        </div>
    </div>




    <!-- Tabel Pegawai -->
    <table id="pegawaiTable" class="table  table-striped table-light nowrap" style="width:100%">
        <thead class="table-dark">
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Jabatan</th>
                <th>Tanggal Lahir</th>
                <th>Foto</th>
            </tr>
        </thead>
    </table>

    <div class="modal fade" id="modalTambah" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Pegawai</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="formTambah">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Nama</label>
                            <input type="text" class="form-control" name="nama" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jabatan</label>
                            <select class="form-select select2" name="jabatan" required>
                                <option value="Manager">Manager</option>
                                <option value="HR">HR</option>
                                <option value="IT">IT</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tanggal Lahir</label>
                            <input type="date" class="form-control" name="tanggal_lahir" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Foto</label>
                            <input id="file-upload" name="foto" type="file" class="file"
                                data-show-upload="false" data-show-caption="true">
                        </div>
                        <button type="submit" class="btn btn-success w-100">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript DataTables & AJAX -->
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
                ajax: {
                    url: "{{ route('pegawai.data') }}",
                    data: function(d) {
                        d.search.value = $('#customSearch').val();
                        d.jabatan = $('#jabatanFilter').val();
                    }
                },
                columns: [{
                        data: 'nama',
                        name: 'nama',
                        responsivePriority: 1
                    },
                    {
                        data: 'email',
                        name: 'email',
                        responsivePriority: 2
                    },
                    {
                        data: 'jabatan',
                        name: 'jabatan',
                        responsivePriority: 3
                    },
                    {
                        data: 'tanggal_lahir',
                        name: 'tanggal_lahir',
                        responsivePriority: 4
                    },
                    {
                        data: 'foto',
                        name: 'foto',
                        orderable: false,
                        searchable: false,
                        responsivePriority: 5,
                        render: function(data) {
                            return data ? `<img src="/storage/${data}" width="50">` : 'No Image';
                        }
                    }
                ],
                responsive: true
            });


            $('#customSearch, #jabatanFilter').on('keyup change', function() {
                $('#pegawaiTable').DataTable().ajax.reload();
            });

            $('#jabatanFilter').select2();

            $("#formTambah").validate({
                rules: {
                    nama: {
                        required: true,
                        minlength: 3
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    jabatan: {
                        required: true
                    },
                    tanggal_lahir: {
                        required: true,
                        dateISO: true
                    },
                    foto: {
                        required: true,
                        extension: "jpg|jpeg|png"
                    }
                },
                messages: {
                    nama: {
                        required: "Nama wajib diisi",
                        minlength: "Nama minimal 3 karakter"
                    },
                    email: {
                        required: "Email wajib diisi",
                        email: "Masukkan email yang valid"
                    },
                    jabatan: {
                        required: "Silakan pilih jabatan"
                    },
                    tanggal_lahir: {
                        required: "Tanggal lahir wajib diisi",
                        dateISO: "Format tanggal harus YYYY-MM-DD"
                    },
                    foto: {
                        required: "Harap upload foto",
                        extension: "Format file harus JPG atau PNG"
                    }
                }
            });

            $("#formTambah").on("submit", function(event) {
                event.preventDefault();
                console.log("Submit event berjalan");

                if (!$(this).valid()) {
                    console.log("Form tidak valid, data tidak dikirim.");
                    return false;
                }

                console.log("Form valid, mengirim data...");

                var formData = new FormData(this);
                formData.append('_token', $('meta[name="csrf-token"]').attr('content'));

                $.ajax({
                    url: "{{ route('pegawai.store') }}",
                    type: "POST",
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        console.log("Data berhasil dikirim:", response);
                        $('#modalTambah').modal('hide');
                        $('#formTambah')[0].reset();
                        $('#pegawaiTable').DataTable().ajax.reload();
                        alert('Pegawai berhasil ditambahkan!');
                    },
                    error: function(xhr) {
                        console.error("Error:", xhr);
                        alert("Terjadi kesalahan saat menyimpan data.");
                    }
                });
            });

            $('input[name="tanggal_lahir"]').daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                autoUpdateInput: false,
                locale: {
                    format: 'YYYY-MM-DD'
                }
            });

            $('input[name="tanggal_lahir"]').on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('YYYY-MM-DD'));
            });

            $("#file-upload").fileinput({
                allowedFileExtensions: ["jpg", "jpeg", "png"],
                maxFileSize: 2048,
                showUpload: false,
                dropZoneEnabled: false,
                theme: "fas",
                initialCaption: "Upload Foto Pegawai",
                previewFileType: "image"
            });


        });
    </script>
</body>

</html>
