function ShowImagePreview( files, nro )
{
    if( !( window.File && window.FileReader && window.FileList && window.Blob ) )
    {
      alert('The File APIs are not fully supported in this browser.');
      return false;
    }

    if( typeof FileReader === "undefined" )
    {
        alert( "Filereader undefined!" );
        return false;
    }

    var file = files[0];

    if( !( /image/i ).test( file.type ) )
    {
        alert( "El archivo debe ser una imagen." );
        return false;
    }

    reader = new FileReader();
    reader.onload = function(event){
			  var img = new Image;
			  img.nro = nro;
              img.onload = UpdatePreviewCanvas; 
              img.src = event.target.result;  
			}
    reader.readAsDataURL( file );
}

function UpdatePreviewCanvas()
{
    var img = this;
    var canvas = document.getElementById( 'previewcanvas' + img.nro );

    if( typeof canvas === "undefined" || typeof canvas.getContext === "undefined" ){
        return;
	}
	
    var context = canvas.getContext( '2d' );

    var world = new Object();
    world.width = canvas.offsetWidth;
    world.height = canvas.offsetHeight;

    canvas.width = world.width;
    canvas.height = world.height;

    if( typeof img === "undefined" )
        return;

    var WidthDif = img.width - world.width;
    var HeightDif = img.height - world.height;

    var Scale = 0.0;
    if( WidthDif > HeightDif )
    {
        Scale = world.width / img.width;
    }
    else
    {
        Scale = world.height / img.height;
    }
    if( Scale > 1 )
        Scale = 1;

    var UseWidth = Math.floor( img.width * Scale );
    var UseHeight = Math.floor( img.height * Scale );

    var x = Math.floor( ( world.width - UseWidth ) / 2 );
    var y = Math.floor( ( world.height - UseHeight ) / 2 );

    context.drawImage( img, x, y, UseWidth, UseHeight );  
}
function borrarCanvas(nro){
	var input = $("#fileFoto"+nro);
	input.replaceWith(input.val('').clone(true));
	
	var canvas = document.getElementById( 'previewcanvas' + nro );
	var context = canvas.getContext('2d');
	context.clearRect(0, 0, canvas.width, canvas.height);
	
	
}