<?php $__env->startSection('content'); ?>
<section id="list">
  <div class="container">
    <h1>WhizCycle</h1>
    <?php if(count($data_order) > 0): ?>
      <h4 class="" style="color: #7C7C7C; margin-left: 100px; margin-top: 30px">Hi, Nazwa</h4>
      <h2 class="font-bold" style="margin-left: 100px; margin-top: 5px;">Riwayat Setoran Sampah</h2>
      <div class="table">
        <table class="table" style="margin-left: 100px;">
          <thead>
            <tr class="" style="color: red;">
              <th class="" style="color: #276561;">Urutan</th>
              <th style="color: #276561;">ID</th>
              <th style="color: #276561;">Tanggal Pemesanan</th>
              <th style="color: #276561;">Waktu Pemesanan</th>
              <th style="color: #276561;">Jenis</th>
              <th style="color: #276561;">Berat</th>
              <th style="color: #276561;">Catatan</th>
              <th style="color: #276561;">Bukti Pembayaran</th>
              <th style="color: #276561;">Status</th>
              <th style="color: #276561;">Action</th>
            </tr>
          </thead>
          <tbody>
              @foreach ($data_order as $order)
                  <tr>
                      <td>{{ $order->schedule_id }}</td>
                      <td>{{ $order->user_id }}</td>
                      <td>{{ $order->pickup_date }}</td>
                      <td>{{ $order->pickup_time }}</td>
                      <td>{{ $order->category_trash }}</td>
                      <td>{{ $order->amount }}</td>
                      <td>{{ $order->notes }}</td>
                      <td>{{ $order->file_payment }}</td>
                      <td>{{ $order->status }}</td>
                      <td>
                      <form action="{{ route('history.delete', ['id' => $order->schedule_id]) }}" method="POST">
                      @csrf
                      @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus</button>
                  </form>
                </td>
              </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </tbody>
        </table>
      </div>
    <?php else: ?>
      <p>Tidak ada order di sini.</p>
    <?php endif; ?>
  </div>
</section>
<style>
  .body {
    font-family: roboto;
  }
  .tr {
    color: #276561;
    background-color: #276561;
  }
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
