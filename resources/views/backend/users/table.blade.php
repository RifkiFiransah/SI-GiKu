<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SI-GiKu | Export</title>
    <link rel="shortcut icon" type="image/png" href="http://127.0.0.1:8000/assets/images/logos/favicon.png" />
    <link rel="stylesheet" href="http://127.0.0.1:8000/assets/css/styles.min.css" />
</head>

<body>

    {{-- <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed"> --}}
    <div class="body-wrapper">
        <div class="container-fluid">
            {{-- @if (strpos(url()->current(), 'export_excel') == false)
                <h1 class="mt-3 mb-4 text-center text-uppercase fw-bold ">Data Anggota Genbi Uniku</h1>
            @endif --}}
            <table class="table mb-0 align-middle text-nowrap" style="border: 2px solid #4F73D9">
                <thead class="text-dark fs-4 bg-primary">
                    <tr>
                        <th class="border-bottom-0">
                            <h6 class="mb-0 fw-semibold">No</h6>
                        </th>
                        <th class="border-bottom-0">
                            <h6 class="mb-0 fw-semibold">Name</h6>
                        </th>
                        <th class="border-bottom-0">
                            <h6 class="mb-0 fw-semibold">Email</h6>
                        </th>
                        <th class="border-bottom-0">
                            <h6 class="mb-0 fw-semibold">Prodi</h6>
                        </th>
                        <th class="border-bottom-0">
                            <h6 class="mb-0 fw-semibold">Divisi</h6>
                        </th>
                        <th class="border-bottom-0">
                            <h6 class="mb-0 fw-semibold">Jabatan</h6>
                        </th>
                        <th class="border-bottom-0">
                            <h6 class="mb-0 fw-semibold">No Telp</h6>
                        </th>
                        <th class="border-bottom-0">
                            <h6 class="mb-0 fw-semibold">Alamat</h6>
                        </th>
                    </tr>
                </thead>
                {{-- <tbody>
                    @forelse ($users as $user)
                        <tr>
                            <td class="border-bottom-0">
                                <h6 class="mb-0 fw-semibold">{{ $loop->iteration }}</h6>
                            </td>
                            <td class="border-bottom-0">
                                <h6 class="mb-1 fw-semibold">{{ $user->name }}</h6>
                            </td>
                            <td class="border-bottom-0">
                                <p class="mb-0 fw-normal">{{ $user->email }}</p>
                            </td>
                            <td class="border-bottom-0">
                                <p class="mb-0 fw-normal">{{ $user->Prodi->name_prodi ?? '' }}</p>
                            </td>
                            <td class="border-bottom-0">
                                <p class="mb-0 fw-normal">{{ $user->Divisi->name_divisi ?? '' }}</p>
                            </td>
                            <td class="border-bottom-0">
                                <p class="mb-0 fw-normal">{{ $user->role }}</p>
                            </td>
                            <td class="border-bottom-0">
                                <p class="mb-0 fw-normal">{{ $user->no_telp }}</p>
                            </td>
                            <td class="border-bottom-0">
                                <p class="mb-0 fw-normal">{{ $user->address }}</p>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">Data Belum tersedia</td>
                        </tr>
                    @endforelse
                </tbody> --}}
            </table>
        </div>
    </div>
    {{-- </div> --}}

    {{-- footer --}}
    <script src="http://127.0.0.1:8000/assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="http://127.0.0.1:8000/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="http://127.0.0.1:8000/assets/js/sidebarmenu.js"></script>
    <script src="http://127.0.0.1:8000/assets/js/app.min.js"></script>
    <script src="http://127.0.0.1:8000/assets/libs/apexcharts/dist/apexcharts.min.js"></script>
    <script src="http://127.0.0.1:8000/assets/libs/simplebar/dist/simplebar.js"></script>
    <script src="http://127.0.0.1:8000/assets/js/dashboard.js"></script>
    {{-- end footer --}}
</body>

</html>
