      <!-- Pie de página -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Derechos de autor &copy; <a href="https://github.com/Prajwal100" target="_blank">Prajwal R.</a> {{date('Y')}}</span>
          </div>
        </div>
      </footer>
      <!-- Fin del Pie de página -->

    </div>
    <!-- Fin del Contenido Principal -->

  </div>
  <!-- Fin del Contenedor de la Página -->

  <!-- Botón de Desplazamiento hacia Arriba -->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Modal de Cierre de Sesión -->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">¿Listo para salir?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Selecciona "Cerrar sesión" a continuación si estás listo para finalizar tu sesión actual.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
          <a class="btn btn-primary" href="login.html">Cerrar sesión</a>
        </div>
      </div>
    </div>
  </div>

  <!-- JavaScript principal de Bootstrap-->
  <script src="{{asset('backend/vendor/jquery/jquery.min.js')}}"></script>
  <script src="{{asset('backend/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

  <!-- JavaScript de complementos principales-->
  <script src="{{asset('backend/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

  <!-- Scripts personalizados para todas las páginas-->
  <script src="{{asset('backend/js/sb-admin-2.min.js')}}"></script>

  <!-- Complementos de nivel de página -->
  <script src="{{asset('backend/vendor/chart.js/Chart.min.js')}}"></script>

  <!-- Scripts personalizados de nivel de página -->
  {{-- <script src="{{asset('backend/js/demo/chart-area-demo.js')}}"></script> --}}
  <script src="{{asset('backend/js/demo/chart-pie-demo.js')}}"></script>

  @stack('scripts')

  <script>
    setTimeout(function(){
      $('.alert').slideUp();
    },4000);
  </script>
