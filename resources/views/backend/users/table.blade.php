<table class="table mb-0 align-middle text-nowrap">
  <thead class="text-dark fs-4">
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
  <tbody>
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
                  <p class="mb-0 fw-normal">{{ $user->Divisi->name_divisi ?? ''}}</p>
                  {{-- <div class="gap-2 d-flex align-items-center">
                  <span class="badge bg-primary rounded-3 fw-semibold">Low</span>
              </div> --}}
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
  </tbody>
</table>