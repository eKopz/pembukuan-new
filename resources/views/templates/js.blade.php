<script type="text/javascript">
    var rupiah = document.getElementById('rupiah');
    rupiah.addEventListener('keyup', function(e){
      // tambahkan 'Rp.' pada saat form di ketik
      // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
      rupiah.value = formatRupiah(this.value, 'Rp. ');
    });

    /* Fungsi formatRupiah */
    function formatRupiah(angka, prefix){
      var number_string = angka.replace(/[^,\d]/g, '').toString(),
      split   		= number_string.split(','),
      sisa     		= split[0].length % 3,
      rupiah     		= split[0].substr(0, sisa),
      ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);

      // tambahkan titik jika yang di input sudah menjadi angka ribuan
      if(ribuan){
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
      }

      rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
      return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }
  </script>

  <script type="text/javascript">
      function showHideField(){
          if (document.getElementById('askField').value == "1") {
              document.getElementById('field_spesific').style.display='block';
          }
          else{
              document.getElementById('field_spesific').style.display='none';
          } 
          
      }
  </script>

  <!-- view image before upload -->

  {{-- foto produk 1 --}}
  <script type="text/javascript">
    function preview_image(event) {
      var reader = new FileReader();
      reader.onload = function()
      {
        var output = document.getElementById('output_image');
        output.src = reader.result;
      }
      reader.readAsDataURL(event.target.files[0]);
    }
  </script>

  <!-- foto produk 2 -->
  <script type="text/javascript">
    function preview_image2(event) {
      var reader = new FileReader();
      reader.onload = function()
      {
        var output = document.getElementById('output_image2');
        output.src = reader.result;
      }
      reader.readAsDataURL(event.target.files[0]);
    }
  </script>

  <!-- foto produk 3 -->
  <script type="text/javascript">
    function preview_image3(event) {
      var reader = new FileReader();
      reader.onload = function()
      {
        var output = document.getElementById('output_image3');
        output.src = reader.result;
      }
      reader.readAsDataURL(event.target.files[0]);
    }
  </script>

  <!-- foto produk 4 -->
  <script type="text/javascript">
    function preview_image4(event) {
      var reader = new FileReader();
      reader.onload = function()
      {
        var output = document.getElementById('output_image4');
        output.src = reader.result;
      }
      reader.readAsDataURL(event.target.files[0]);
    }
  </script>

  {{-- date picker --}}
  <script>
    $( function() {
      $( "#date" ).datepicker({
        dateFormat: "yy-mm-dd"
      });
    } );
  </script>