function abrirModalI(){
    $('#myModal').modal('show');
    $("#table").append(` <div class="table-responsive">
    <table class="table table-striped table-sm">
      <thead>
        <tr>
          <th scope="col">Codigo</th>
          <th scope="col">Materia</th>
          <th scope="col">Creditos</th>
          <th scope="col">Requisitos</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>AN-1000</td>
          <td>lalalalalalal</td>
          <td>3</td>
          <td>Admitido en U</td>
        </tr>
        <tr>
          <td>CO-1010</td>
          <td>Contabilidad Básica</td>
          <td>3</td>
          <td>Admitido en U</td>
        </tr>
        <tr>
          <td>MA-1020</td>
          <td>Matemática General</td>
          <td>3</td>
          <td>Admitido en U</td>
        </tr>
        <tr>
          <td>TE-1040</td>
          <td>Técnicas de Estudio</td>
          <td>3</td>
          <td>Admitido en U</td>
        </tr>
        <tr>
          <td>Re-1080</td>
          <td>Desarrollo Centroamericano</td>
          <td>3</td>
          <td>Admitido en U</td>
        </tr>
      </tbody>
    </table>
   </div>`);
    console.log('hola');
}
function cerrarModal(){
    $("#myModal").modal('hide');
    $("#table").empty();
    console.log('cerro');

}



 





