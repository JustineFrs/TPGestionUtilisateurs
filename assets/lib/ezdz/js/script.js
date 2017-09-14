$(function() {
  //Création du canvas
  var canvas = new fabric.Canvas('c', { isDrawingMode: false});
  //Drag&drop espace de téléchargement
  $('[name="picture"]').ezdz({
    text: '<p>+<p>',

  });
});
