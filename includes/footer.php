  <footer 
    class="mt-auto sticky flex justify-between 
      text-sm p-2 z-50 bg-bgGray
    "
  >
    <div>
      <p class="text-dark/60">
        Copyright &COPY; Est Fes 
        <?php 
          $date = date('Y');
          ?>
            <span><?=$date?></span>
          <?
        ?>
        <span id="Date-copy">
        </span>
      </p>
    </div>
    <div>
      <ul class="flex gap-1 text-blue-600 ">
        <li>
          <a href="#" class="underline">
            Privacy Policy
          </a>
        </li>·
        <li>
          <a href="#" class="underline">
            Terms & Conditions
          </a>
        </li>
      </ul>
    </div>
  </footer>
  </main>
  </div>


  <!-- jQuery Link -->
  <script src="./assets/js/jquery-3.4.1.slim.min.js"></script>
  <!-- jQuery Link -->

  <!-- Summernote Js -->
  <script src="./assets/js/summernote-lite.min.js"></script>
  <!-- Summernote Js -->

  <!-- Datatable Js -->
  <script src="./assets/js/dataTables.min.js"></script>
  <!-- Datatable Js -->

  <!-- Toaster -->
  <script>
    toastr.options = {
      "closeButton": true,
      "debug": false,
      "newestOnTop": false,
      "progressBar": true,
      "positionClass": "toast-top-right",
      "preventDuplicates": false,
      "onclick": null,
      "showDuration": "300",
      "hideDuration": "1000",
      "timeOut": "5000",
      "extendedTimeOut": "1000",
      "showEasing": "swing",
      "hideEasing": "linear",
      "showMethod": "fadeIn",
      "hideMethod": "fadeOut"
    }
  </script>
  <!-- Toaster -->

  </body>

  </html>