</body>
</html>
<script src="../admin/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="../admin/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="../admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="../admin/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="../admin/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="../admin/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="../admin/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="../admin/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="../admin/plugins/moment/moment.min.js"></script>
<script src="../admin/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="../admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="../admin/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="../admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="../admin/dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../admin/dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../admin/dist/js/pages/dashboard.js"></script>


<script src="../admin/dist/js/adminlte.min.js"></script>
<script src="../admin/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../admin/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../admin/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../admin/plugins/jszip/jszip.min.js"></script>
<script src="../admin/plugins/pdfmake/pdfmake.min.js"></script>
<script src="../admin/plugins/pdfmake/vfs_fonts.js"></script>
<script src="../admin/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../admin/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../admin/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
<script>
  $(document).ready(function(){
      $('select[name="provinsi_asal"]').on('change', function(){
          let provinceId = $(this).val();
          if(provinceId){
              $.ajax({
                  url: '/provinsi/'+provinceId+'/kota',
                  type:"GET",
                  dataType:"json",
                  success:function(data){
                    // console.log("jquery iso");
                    $('select[name="kota_asal"]').empty();
                    $.each(data, function(key, value){
                      $('select[name="kota_asal"]').append('<option value="'+key+'">' +value+'</option>');
                    });
                  },
              });
          }else{
                $('select[name="kota_asal"]').empty();
          }
      });

      $('select[name="provinsi_tujuan"]').on('change', function(){
          let provinceId = $(this).val();
          if(provinceId){
              $.ajax({
                  url: '/provinsi/'+provinceId+'/kota',
                  type:"GET",
                  dataType:"json",
                  success:function(data){
                    $('select[name="kota_tujuan"]').empty();
                    $.each(data, function(key, value){
                      $('select[name="kota_tujuan"]').append('<option value="'+key+'">' +value+'</option>');
                    });
                  },
              });
          }else{
            $('select[name="kota_tujuan"]').empty();
          }
      });

  });

  $('#paket').on('change', function(){
  const price = $('#paket option:selected').val();
  const berat = $('[name=berat]').val();
  
  if (berat <= '1000') {
    const n = 1;
    const total = price * n;
  $('#total').val(total);
  }
  else if(berat > '1000' && berat <= '2000'){
    const n = 2;
    const total = price * n;
  $('#total').val(total);
  }else if(berat > '2000' && berat <= '3000'){
    const n = 3;
    const total = price * n;
  $('#total').val(total);
  }else if(berat > '3000' && berat <= '4000'){
    const n = 4;
    const total = price * n;
  $('#total').val(total);
  }

  
});

</script>
