APPLICATION = {
  rootUrl: null,

  common: {
    init: function() {

      APPLICATION.rootUrl = $('body').attr('data-root-url');

    }
  }
};
 
UTIL = {
  exec: function( controller, action ) {
    var ns = APPLICATION,
        action = ( action === undefined ) ? "init" : action;
 
    if ( controller !== "" && ns[controller] && typeof ns[controller][action] == "function" ) {ns[controller][action]();}
  },
 
  init: function() {
    var body = document.body,
        controller = body.getAttribute( "id" ),
        action = body.getAttribute( "class" );
 
    UTIL.exec( "common" );
    UTIL.exec( controller );
    UTIL.exec( controller, action );
  }
};
 
$( document ).ready( UTIL.init );