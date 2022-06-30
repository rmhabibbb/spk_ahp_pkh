
      <!-- Footer --> 
    </div>
  </div>
  <!-- Argon Scripts -->
  <!-- Core -->
  <script src="<?=base_url('assets/argon/')?>vendor/jquery/dist/jquery.min.js"></script>
  <script src="<?=base_url('assets/argon/')?>vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="<?=base_url('assets/argon/')?>vendor/js-cookie/js.cookie.js"></script>
  <script src="<?=base_url('assets/argon/')?>vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
  <script src="<?=base_url('assets/argon/')?>vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
  <!-- Optional JS -->
  <script src="<?=base_url('assets/argon/')?>vendor/chart.js/dist/Chart.min.js"></script>
  <script src="<?=base_url('assets/argon/')?>vendor/chart.js/dist/Chart.extension.js"></script>
  <!-- Argon JS -->
  
    <!-- Jquery DataTable Plugin Js -->
     
  <script src="<?=base_url('assets/argon/')?>vendor/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="<?=base_url('assets/argon/')?>vendor/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?=base_url('assets/argon/')?>vendor/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
  <script src="<?=base_url('assets/argon/')?>vendor/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
  <script src="<?=base_url('assets/argon/')?>vendor/datatables.net-buttons/js/buttons.html5.min.js"></script>
  <script src="<?=base_url('assets/argon/')?>vendor/datatables.net-buttons/js/buttons.flash.min.js"></script>
  <script src="<?=base_url('assets/argon/')?>vendor/datatables.net-buttons/js/buttons.print.min.js"></script>
  <script src="<?=base_url('assets/argon/')?>vendor/datatables.net-select/js/dataTables.select.min.js"></script>
  <script src="<?=base_url('assets/argon/')?>js/argon.js?v=1.1.0"></script> 


  <script src="<?=base_url('assets/argon/')?>js/demo.min.js"></script>
  <script src="<?=base_url('assets/argon/')?>js/highcharts.js"></script>
  <script src="<?=base_url('assets/argon/')?>js/exporting.js"></script>

  <script type="text/javascript">
    $(document).ready(function(){
      $("#email").keyup(function(){  
        var email = $("#email").val();   
        $cek1 = 0;
          $.ajax({ 
            url:"<?php echo base_url(); ?>superadmin/cekemail",
            method:"post", 
            data:{email:email},
                success:function(data){     
                if (data != ""){ 
                  cek1 = 0 ;
                  $('#pesan1_pgw').html(data); 
                }else {
                  $('#pesan1_pgw').html(data); 
                  cek1 = 1 ;
                }   
              }
          });  
      }); 
 
      $("#formgpw").keyup(function(){  

        $cek1 = 0;
        $cek2 = 0;
        $cek3 = 0;
        var password = $("#passwordold").val();  
          if (password != '') {
            $.ajax({ 
              url:"<?php echo base_url(); ?>superadmin/cekpasslama",
              method:"post", 
              data:{password:password},
                  success:function(data){     
                  if (data != ""){ 
                    cek1 = 0 ;
                    $('#pesan2_pgw').html(data); 
                  }else {
                    $('#pesan2_pgw').html(data); 
                    cek1 = 1 ;
                  }   
                }
            });  
          }else{  
            $('#pesan2_pgw').html('Password is required!');   
          } 

          var password = $("#passwordnew").val();  
          if (password != '') {
            $.ajax({ 
              url:"<?php echo base_url(); ?>superadmin/cekpass",
              method:"post", 
              data:{password:password},
                  success:function(data){     
                  if (data != ""){ 
                    cek2 = 0 ;
                    $('#pesan3_pgw').html(data); 
                  }else {
                    $('#pesan3_pgw').html(data); 
                    cek2 = 1 ;
                  }  
                  if (cek1 == 0 || cek2 == 0 || cek3 == 0  ) {
                     $(':input[name="gpw"]').prop('disabled', true);
                  } else {
                     $(':input[name="gpw"]').prop('disabled', false);
                  }  
                }
            });  
          } 

          var password2 = $("#passwordnew2").val();   
            $.ajax({ 
              url:"<?php echo base_url(); ?>superadmin/cekpass2",
              method:"post", 
              data:{password:password, password2:password2},
                  success:function(data){     
                  if (data != ""){ 
                    cek3 = 0 ;
                    $('#pesan4_pgw').html(data); 
                  }else {
                    $('#pesan4_pgw').html(data); 
                    cek3 = 1 ;
                  }  
                   
                }
            }); 

          if (cek1 == 0 || cek2 == 0 || cek3 == 0  ) {
             $(':input[name="gpw"]').prop('disabled', true);
          } else {
             $(':input[name="gpw"]').prop('disabled', false);
          }   
      }); 

      
    });
  </script>
  <script>

  <?php if ($index == 6) { ?> 
  var chart1; // globally available
  $(document).ready(function() {
        chart1 = new Highcharts.Chart({
           chart: {
              renderTo: 'container2',
              type: 'column'
           },  
           title: {
              text: 'Grafik Perangkingan '
           },
           xAxis: {
              categories: ['Alternatif']
           },
           yAxis: {
              title: {
                 text: 'Jumlah Nilai'
              }
           },
                series:            
              [
              <?php
              foreach ($rank as $row4){
                    ?>
                   //data yang diambil dari database dimasukan ke variable nama dan data
                   //
                    {
                        name: '<?php echo $row4['nama_alternatif'] ?>',
                        data: [<?php echo $row4['nilai_akhir'] ?>]
                    },
                    <?php } ?>
              ]
        });
     }); 
<?php } ?>
     </script>
</body>

</html>