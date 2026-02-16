<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Sistem Pendataan Kios & Kontrakan</title>
  @yield('css')
</head>
<body>
  <!-- MAIN -->
  <div class="main">

    <!-- TOPBAR -->
    <h3>Sistem Pendataan Kios & Kontrakan</h3>

    <!-- CONTENT -->
    {{-- <div class="content">

      <!-- CARDS -->
      <div class="cards">
        <div class="card">
          <h4>Total Unit</h4>
          <p>20</p>
        </div>
        <div class="card">
          <h4>Disewa</h4>
          <p>14</p>
        </div>
        <div class="card">
          <h4>Kosong</h4>
          <p>6</p>
        </div>
        <div class="card">
          <h4>Pemasukan Bulan Ini</h4>
          <p>Rp 12 jt</p>
        </div>
      </div>

      <!-- TABLE -->
      <div class="table-box">
        <h4>Data Unit</h4>
        <table>
          <thead>
            <tr>
              <th>Nama Unit</th>
              <th>Tipe</th>
              <th>Harga</th>
              <th>Status</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>A1</td>
              <td>Kios</td>
              <td>Rp 1.500.000</td>
              <td><span class="badge success">Disewa</span></td>
              <td>
                <button class="btn edit">Edit</button>
                <button class="btn delete" onclick="hapus()">Hapus</button>
              </td>
            </tr>
            <tr>
              <td>B2</td>
              <td>Kontrakan</td>
              <td>Rp 1.000.000</td>
              <td><span class="badge secondary">Kosong</span></td>
              <td>
                <button class="btn edit">Edit</button>
                <button class="btn delete" onclick="hapus()">Hapus</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

    </div> --}}
  </div>

  @yield('js')

</body>
</html>
