console.log('Cargando hamburger.icon...');
(function() {
  const MAIN_OBJ={
      init:function(){
          this.eventHandlers()

      },
      eventHandlers: function(){
          document.querySelector('navbar-toggler').addEventListener('click',function(){
              document.querySelector('navbar-toggler-icon').classList.toggle('menu-open');
          });
    
       }
  }
   MAIN_OBJ.init();
})();
