$(document).ready(function(){
  // Almacenar el estado de la lista cuando se hace clic en un submenú
  $('.treeview-menu').find('a').click(function(){
      var parentLI = $(this).parents('li');
      parentLI.addClass('active');
      localStorage.setItem('active-menu-' + parentLI.parents('.treeview').index() + '-' + parentLI.index(), true);
  });
  
  // Expandir las listas activas al cargar la página
  $('.treeview').each(function(treeviewIndex){
      $(this).find('.treeview-menu').each(function(menuIndex){
          var activeItem = localStorage.getItem('active-menu-' + treeviewIndex + '-' + menuIndex);
          if(activeItem){
              $(this).parent('li').addClass('active');
          }
      });
  });
  

  // Limpiar el estado de la lista activa antes de actualizar el estado de la nueva lista activa
  $('.treeview').on('show.bs.dropdown', function () {
      $('.treeview').each(function(treeviewIndex){
          $(this).find('.treeview-menu').each(function(menuIndex){
              localStorage.removeItem('active-menu-' + treeviewIndex + '-' + menuIndex);
              $(this).parent('li').removeClass('active');
          });
      });
      var parentLI = $(this).find('.treeview-menu').parent('li');
      parentLI.addClass('active');
      localStorage.setItem('active-menu-' + parentLI.parents('.treeview').index() + '-' + parentLI.index(), true);
  });
});