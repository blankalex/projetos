/*Cadastro 3 etapas*/

$(function () {
    var atual_fs, next_fs, prev_fs;

    $('.next').click(function () {
        atual_fs = $(this).parent();
        next_fs = $(this).parent().next();

        $('#progress li').eq($('fieldset').index(next_fs)).addClass('ativo');
        atual_fs.hide(800);
        next_fs.show(800);
    });

    $('.prev').click(function () {
        atual_fs = $(this).parent();
        prev_fs = $(this).parent().prev();

        $('#progress li').eq($('fieldset').index(atual_fs)).removeClass('ativo');
        atual_fs.hide(800);
        prev_fs.show(800);
    });

  
    $('#formulario input[type=button]').click(function () {
        return false;
    });
});
/*sair do modal com esc Dúvidas*/

function modalfecharduvidas() {
    if (location.hash == '#modalduvidaslink') {
        location.hash = '';
    }
}

// ESC key code 27)
document.addEventListener('keyup', function(e) {
    if (e.keyCode == 27) {
        modalfecharduvidas();
    }
});

var modal = document.querySelector('#modalduvidaslink');

/*sair do modal com esc Login*/

function modalfecharlogin() {
    if (location.hash == '#modalloginlink') {
        location.hash = '';
    }
}

// ESC key code 27)
document.addEventListener('keyup', function(e) {
    if (e.keyCode == 27) {
        modalfecharlogin();
    }
});

var modal = document.querySelector('#modalloginlink');

/*sair do modal com esc Cadastro*/

function modalfecharcadastro() {
    if (location.hash == '#modalcadastrolink') {
        location.hash = '';
    }
}

// ESC key code 27)
document.addEventListener('keyup', function(e) {
    if (e.keyCode == 27) {
        modalfecharcadastro();
    }
});

var modal = document.querySelector('#modalcadastrolink');

/*Menu*/

$(window).scroll(function() { 
    var scroll = $(window).scrollTop();

    if (scroll > 15) {
        $('#menu').css('opacity','0.5');
        $('#menu').css('border-bottom','none');
    }else {
        $('#menu').css('background-color','#222');
        $('#menu').css('opacity','0.9');
        $('#menu').css('border-bottom','2px solid #faa61a');
        
    }
})

/*FIM MENU*/

/*Alert para escolher o jogo!*/

function funcao1()
            {
            alert("Antes de se cadastrar escolha um jogo!");
            }
            
            
//Slider

$(document).ready(function(){
    
    setInterval(trocaSlide, 4000);
    
   function trocaSlide() {
       var slideAtivo = $('.slide.active'),
       proximo = slideAtivo.next();
       
       if(proximo.length == 0){
           proximo = $('.slide:first');
       }
       
       slideAtivo.removeClass('active');
       proximo.addClass('active');
   }
});

/*Evento de clicar*/
/*
 $('a[href^="#"]').on('click', function(event) {
	    var target = $(this.getAttribute('href'));
	    if( target.length ) {
	        event.preventDefault();
	        $('html, body').stop().animate({
	            scrollTop: target.offset().top
	        }, 1100);
	    }
	}); 
 */