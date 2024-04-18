
const lista = document.getElementById('container-footer');

this.addElement = function (){
    lista.insertAdjacentHTML('beforeend',`<div id="container-footer" class="container">
    <footer id="footer" class="footer">
      <div class="container-span">
        <span class="span-footer">&copy; 2023 Universidad De Ciencias Empresariales, UCEM</span>
      </div>
      <div class="container-span">
      <span class="span-footer">&copy; Autor: Dylan Gerardo Varela Montero</span>
    </div>
  
      <ul>
        <li class="link"><a class="text-muted-footer" href="https://www.facebook.com/UCEMOficial" target="_blank"><i id="face" class="fa-brands fa-facebook"></i></a></li>
        <li class="link"><a class="text-muted-footer" href="https://api.whatsapp.com/send?phone=50683446379&text=" target="_blank"><i id="Whats" class="fa-brands fa-whatsapp" ></i></a></li>
        <li class="link"><a class="text-muted-footer" href="https://www.waze.com/es-419/live-map/directions/ucem-alajuela-centro,-alajuela?to=place.w.180748388.1807352810.12043793" target="_blank"><i id="waze" class="fa-brands fa-waze"></i></a></li>
        
      </ul>
    </footer>
  </div>`)
}
document.body.onload = addElement;