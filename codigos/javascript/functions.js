function desenhaCirculo(x, y, raio, cor,valor){

    var tela = document.getElementById('graficoAnimacao');
    var pincel = tela.getContext('2d');

    pincel.fillStyle = "rgba(255, 255, 255, 0.0)";
    pincel.fillRect(0, 0, 600, 400);

		pincel.fillStyle = cor;
        pincel.lineWidth = 5;
        pincel.beginPath();
        pincel.arc(x, y, raio, 0, porcentagem(valor) * Math.PI);
        pincel.lineTo(x,y)
        pincel.lineTo(x+raio+2,y)
        pincel.fill();

}
function porcentagem(valor){
        return (valor*2)/100
}
function animacaoGrafico(x, y, raio, cor ,porcentagem) {
        var valor = 1 ;
        function animacao(){

            if(valor<=porcentagem){
                desenhaCirculo(x , y , raio, cor, valor);
                valor++;
            }/*else{
                //repete
                limpaTela();
                valor=0;
            }*/


    }

        function iniciaAnimacao(animacao, velocidade){
            setInterval(animacao, velocidade);
            //velocidade: quanto menor, mais rapida.
         }

    iniciaAnimacao(animacao, 20);
}

jQuery(document).ready(function($){
    $('.links .login').click(function() {
  if ( $('#login').hasClass('aberto') ) {
    $('#login').removeClass('aberto');
  } else {
    $('#login').addClass('aberto');    
}
});
}); 

jQuery(document).ready(function($){
    $('#cadastrometa').click(function() {
    if ( $('.edicao-meta').hasClass('aberto') ) {
        $('.edicao-meta').removeClass('aberto');
    } else {
        $('.edicao-meta').addClass('aberto');    
  }
  });
  }); 


