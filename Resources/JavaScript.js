var theme = 'bootstrap';
var localizationobj = {};
localizationobj.pagergotopagestring = "Ir para pag.:";
localizationobj.pagershowrowsstring = "Registros por p&aacute;gina:";
localizationobj.pagerrangestring = " Total de registros ";
localizationobj.pagernextbuttonstring = "Pr&oacute;ximo";
localizationobj.pagerpreviousbuttonstring = "Anterior";
localizationobj.sortascendingstring = "Ordenar Crescente";
localizationobj.sortdescendingstring = "Ordenar Decrescente";
localizationobj.sortremovestring = "Remover Ordena&ccedil;&atilde;o";
localizationobj.pagershowrowsstring = "Mostrar Registros";
localizationobj.filtershowrowstring = "Filtrar registros por: ";
localizationobj.filterstringcomparisonoperators = ["vazio",
                                                   "N&atilde;o vazio",
                                                   "Cont&eacute;m",
                                                   "Cont&eacute;m(Diferencia Mai&uacute;scula)",
                                                   "N&atilde;o Cont&eacute;m",
                                                   "N&atilde;o Cont&eacute;m (Diferencia Mai&uacute;scula)",
                                                   "Come&ccedil;a com",
                                                   "Come&ccedil;a com (Diferencia Mai&uacute;scula)",
                                                   "Termina com",
                                                   "Termina com (Diferencia Mai&uacute;scula)",
                                                   "Igual",
                                                   "Igual (Diferencia Mai&uacute;scula)",
                                                   "Nulo",
                                                   "N&atilde;o Nulo"
                                               ];
localizationobj.filterbooleancomparisonoperators = ["Igual",
                                                    "N&atilde;o Igual"];
localizationobj.filterandconditionstring = "E";
localizationobj.filterorconditionstring = "Ou";
localizationobj.filterstring = "Filtrar";
localizationobj.filterclearstring = "Limpar";


function Formata(valor, casas, separdor_decimal, separador_milhar){

     var valor_total = parseInt(valor * (Math.pow(10,casas)));
     var inteiros =  parseInt(parseInt(valor * (Math.pow(10,casas))) / parseFloat(Math.pow(10,casas)));
     var centavos = parseInt(parseInt(valor * (Math.pow(10,casas))) % parseFloat(Math.pow(10,casas)));


     if(centavos%10 == 0 && centavos+"".length<2 ){
      centavos = centavos+"0";
     }else if(centavos<10){
      centavos = "0"+centavos;
     }

     var milhares = parseInt(inteiros/1000);
     inteiros = inteiros % 1000;

     var retorno = "";

     if(milhares>0){
      retorno = milhares+""+separador_milhar+""+retorno
      if(inteiros == 0){
       inteiros = "000";
      } else if(inteiros < 10){
       inteiros = "00"+inteiros;
      } else if(inteiros < 100){
       inteiros = "0"+inteiros;
      }
     }
      retorno += inteiros+""+separdor_decimal+""+centavos;


     return retorno;

}

function mascaraData(campoData, teclado){
	//alert(teclado.keyCode);
	event.returnValue = somenteNumeros(event);
	tecla = teclado.keyCode;
	if (
			(
			 (tecla==8)||
			 (tecla==46)
			)||
			(
			 (tecla>=96)&&
			 (tecla<=105)
			)||
			(
			 (tecla>=48)&&
			 (tecla<=57)
			)			
		 ){
							var data = campoData.value;
							
							if (data.length == 2){
								 if ((tecla!=8)&&(tecla!=46)){
									data = data + '/';
								 }
									campoData.value = data;																
			return true;              
							}
							if (data.length == 5){
								 if ((tecla!=8)&&(tecla!=46)){								
									data = data + '/';
								 }
									campoData.value = data;
									return true;
							}
	}else{
		return false;
	}
}
function preencheCampos(Campo1, Valor1){
	Campo1.value=Valor1;
}
function preencheCheck(Campo1, Valor1){
	Campo1.checked=Valor1;
}
function preencheCampos1(Campo1, Valor1){
	cheques.style.display=Valor1;
}
function java(dochtml) {
var left=(window.screen.width/2)-(1000/2);
var top = ((window.screen.height/2)-50)-(700/2);
	if(navigator.appName == "Netscape") {
		var sec = window.open(dochtml,'','scrollbars=yes,toolbars=no,status=no,menubar=no,resizable=yes,height=700,width=1000,top='+top+',left='+left);
		sec.focus();
	}
	else {
		var new_window = window.open(dochtml,'','resizable=yes,width=1000,height=700, left='+ left +', top='+ top +',toolbars=no,menubar=no,status=no,scrollbars=1');
		new_window.focus;
	}
}

function java4(dochtml, largura, altura) {
var left=(window.screen.width/2)-(1000/2);
var top = ((window.screen.height/2)-50)-(700/2);
	if(navigator.appName == "Netscape") {
		var sec = window.open(dochtml,'_blank','scrollbars=yes,toolbars=no,status=no,menubar=no,resizable=yes,height='+altura+',width='+largura+',top='+top+',left='+left);
		sec.focus();
	}
	else {
		var new_window = window.open(dochtml,'_blank','resizable=yes,width='+largura+',height='+altura+', left='+ left +', top='+ top +',toolbars=no,menubar=no,status=no,scrollbars=1');
		new_window.focus;
	}
}

function Mascara_Data(objeto)
		{
			event.returnValue = somenteNumeros(event);
			var tecla = window.event.keyCode;
			var mydata = objeto.value;
			mydata = mydata.replace( ".", "" );
			mydata = mydata.replace( "/", "" );
			mydata = mydata.replace( "/", "" );
			tam = mydata.length + 1;

			if ( tecla != 9 && tecla != 8 && tecla != 16 && tecla != 17 && tecla != 34 && tecla != 35 && tecla != 36 && tecla != 37 && tecla != 38 && tecla != 39 && tecla != 40 && tecla != 45 && tecla != 46)
			{
				if ( tam > 2 && tam < 5 )
					{
						objeto.value = mydata.substr( 0, tam - 2  ) + '/' + mydata.substr( tam - 2, tam );
					}
				if ( tam >= 5 && tam <= 10 )
					{
						objeto.value = mydata.substr( 0, 2 ) + '/' + mydata.substr( 2, 2 ) + '/' + mydata.substr( 4, 4 );
					}
			}

			//Verifica��o da validade da data.
			mydata = objeto.value;
			if (mydata.length == 10)
				{
					dia = (objeto.value.substring(0,2));
					mes = (objeto.value.substring(3,5));
					ano = (objeto.value.substring(6,10));
					situacao = "";

					// verifica o dia valido para cada m�s.
					if ((dia < 01)||(dia < 01 || dia > 30) && (  mes == 04 || mes == 06 || mes == 09 || mes == 11 ) || dia > 31)
						{
							situacao = "falsa";
						}

					// verifica se o m�s e valido.
					if (mes < 01 || mes > 12 )
						{
							situacao = "falsa";
						}

					// verifica se e ano bissexto.
					if (mes == 2 && ( dia < 01 || dia > 29 || ( dia > 28 && (parseInt(ano / 4) != ano / 4))))
						{
							situacao = "falsa";
						}
					if (objeto.value == "")
						{
							situacao = "falsa";
						}
					if (situacao == "falsa")
						{
							alert("Data inv�lida !");
							objeto.value="";
							event.keyCode=0;
                            event.returnValue=false;
							objeto.focus();
						}
				}
		}

function somenteNumeros(event){
  if (((event.keyCode!=8)&&(event.keyCode!=9)&&
       (event.keyCode<48))||
      ((event.keyCode>57)&&
       (event.keyCode<96))||
       (event.keyCode>105)){
	return false;
  }else{
	return true;
  }
}

//M�SCARA DE VALORES

function txtBoxFormat(objeto, sMask, evtKeyPress) {
    var i, nCount, sValue, fldLen, mskLen,bolMask, sCod, nTecla;


if(document.all) { // Internet Explorer
    nTecla = evtKeyPress.keyCode;
} else if(document.layers) { // Nestcape
    nTecla = evtKeyPress.which;
} else {
    nTecla = evtKeyPress.which;
    if (nTecla == 8) {
        return true;
    }
}

    sValue = objeto.value;

    // Limpa todos os caracteres de formata��o que
    // j� estiverem no campo.
    sValue = sValue.toString().replace( "-", "" );
    sValue = sValue.toString().replace( "-", "" );
    sValue = sValue.toString().replace( ".", "" );
    sValue = sValue.toString().replace( ".", "" );
    sValue = sValue.toString().replace( "/", "" );
    sValue = sValue.toString().replace( "/", "" );
    sValue = sValue.toString().replace( ":", "" );
    sValue = sValue.toString().replace( ":", "" );
    sValue = sValue.toString().replace( "(", "" );
    sValue = sValue.toString().replace( "(", "" );
    sValue = sValue.toString().replace( ")", "" );
    sValue = sValue.toString().replace( ")", "" );
    sValue = sValue.toString().replace( " ", "" );
    sValue = sValue.toString().replace( " ", "" );
    fldLen = sValue.length;
    mskLen = sMask.length;

    i = 0;
    nCount = 0;
    sCod = "";
    mskLen = fldLen;

    while (i <= mskLen) {
      bolMask = ((sMask.charAt(i) == "-") || (sMask.charAt(i) == ".") || (sMask.charAt(i) == "/") || (sMask.charAt(i) == ":"))
      bolMask = bolMask || ((sMask.charAt(i) == "(") || (sMask.charAt(i) == ")") || (sMask.charAt(i) == " "))

      if (bolMask) {
        sCod += sMask.charAt(i);
        mskLen++; }
      else {
        sCod += sValue.charAt(nCount);
        nCount++;
      }

      i++;
    }

    objeto.value = sCod;

    if (nTecla != 8) { // backspace
      if (sMask.charAt(i-1) == "9") { // apenas n�meros...
        return ((nTecla > 47) && (nTecla < 58)); }
      else { // qualquer caracter...
        return true;
      }
    }
    else {
      return true;
    }
  }
  
function AdicionarMes(data, meses){
   dia = data.substring(0,2);
   mes = data.substring(3,5);
   ano = data.substring(6,10);
   mes = mes+meses;
  // verifica se e ano bissexto.
   if (dia<1){
     mes=mes-1;
     if ((mes == 1)||
         (mes == 3)||
         (mes == 5)||
         (mes == 7)||
         (mes == 8)||
         (mes == 10)||
         (mes == 12)){
       dia=31;
     }else if ((mes == 4)||
               (mes == 6)||
               (mes == 9)||
               (mes == 11)){
       dia=30;
     }else if (mes == 2){
       if (parseInt(ano / 4) != ano / 4){
        dia=28;
       }else{
        dia=29;
	     }
     }
   }
   if (dia<10){
     dia='0'+dia;
   }
   if (mes<1){
     ano = ano-1;
     mes = 12;
   }else if (mes>12){
     ano = ano+1;
     mes = '01';
   }
  if (mes == 2){
    if  (dia > 28){
      if (parseInt(ano / 4) != ano / 4){
        dia=28;
      }else{
        dia=29;
	  }
	}
  }
   if (mes<10){
     mes='0'+mes;
   }
   tudo = dia+'/'+mes+'/'+ano;
   //alert(tudo);
   return tudo;
}

function montaData (data, hora, qtdDias){
    subtrairDias(data, qtdDias);
    return subtrairDias(data, qtdDias)+' '+hora;
}

function subtrairDias(data, dias){
   dia = data.substring(0,2);
   mes = data.substring(3,5);
   ano = data.substring(6,10);
   dia = dia-dias;
  // verifica se e ano bissexto.
   if (dia<1){
     mes=mes-1;
     if ((mes == 1)||
         (mes == 3)||
         (mes == 5)||
         (mes == 7)||
         (mes == 8)||
         (mes == 10)||
         (mes == 12)){
       dia=31;
     }else if ((mes == 4)||
               (mes == 6)||
               (mes == 9)||
               (mes == 11)){
       dia=30;
     }else if (mes == 2){
       if (parseInt(ano / 4) != ano / 4){
        dia=28;
       }else{
        dia=29;
	     }
     }
   }
   if (dia<10){
     dia='0'+dia;
   }
   if (mes<1){
     ano = ano-1;
     mes = 12;
   }
  if (mes == 2){
    if  (dia > 28){
      if (parseInt(ano / 4) != ano / 4){
        dia=28;
      }else{
        dia=29;
	  }
	}
  }
   //alert(data.length);
   if (data.length<10){
     if (mes<10){
       mes='0'+mes;
     }
   }
   tudo = dia+'/'+mes+'/'+ano;
   if (tudo.length<10){
     if (mes<10){
      // alert('sim');
       mes='0'+mes;
    //   alert(mes);
       tudo = dia+'/'+mes+'/'+ano;
     }
   }
//   alert(tudo.length);
   return tudo;
}
function pegaHora(campo,hora,qtdDias){
  i=0;
  contaVirgula=0;
  palavra='';
  while (i<campo.value.length){
    if(campo.value.substring(i,i+1)==';'){
      if (contaVirgula==1){
        preencheCampos(hora,palavra);
      }else if (contaVirgula==2){
        preencheCampos(qtdDias,palavra);
      }
      contaVirgula=contaVirgula+1;
      palavra='';
      i=i+1;
    }
    if (contaVirgula==1){
      if (palavra==''){
        palavra=campo.value.substring(i,i+1);
      }else{
        palavra=palavra+campo.value.substring(i,i+1);
      }
    }else if (contaVirgula==2){
      if (palavra==''){
        palavra=campo.value.substring(i,i+1);
      }else{
        palavra=palavra+campo.value.substring(i,i+1);
      }
    }
    i=i+1;
  }
}

function comparaDatas(dataAtual, dataCompara){
   ano = dataAtual.substring(0,4);
   mes = dataAtual.substring(5,7);
   dia = dataAtual.substring(8,10);
   hora = dataAtual.substring(11,13);
   min = dataAtual.substring(14,16);
   sec = dataAtual.substring(17,20);
   data1 = ano+''+mes+''+dia+''+hora+''+min+''+sec;
   //alert(data1);
   dia = dataCompara.substring(0,2);
   mes = dataCompara.substring(3,5);
   ano = dataCompara.substring(6,10);
   hora = dataCompara.substring(11,13);
   min = dataCompara.substring(14,16);
   sec = dataCompara.substring(17,20);
   data2 = ano+''+mes+''+dia+''+hora+''+min+''+sec;
   //alert(data2);
   if (parseInt(data1)<parseInt(data2)){
     return true;
   }else{
     return false;
   }
}

function MontarGrid(nomeGrid, listaGrid, campos){
    
    var theme = 'energyblue';
    var linhas = campos.split('|');
    var dados = new Array();
    var dadosColunas = new Array();
    
    
    var dado = new Array();
    for (i=0;i<linhas.length;i++){
        dado = [];
        dado = linhas[i].split('?');
        var data = new Object();
        data.name = dado[1];
        data.type = dado[2];
        dados.push(data);
        if (dado[4]>0){
            var colunas = new Object();
            colunas.text = dado[0];
            colunas.columntype = dado[3];
            colunas.datafield = dado[1];
            colunas.width = dado[4];
            dadosColunas.push(colunas);            
        }        
    }
    var source =
    {
        localdata: listaGrid,
        datatype: "json",
        datafields: dados
    };    
    var dataAdapter = new $.jqx.dataAdapter(source);
    $("#"+nomeGrid).jqxGrid(
    {
        width: $(window).width()-50,
        source: dataAdapter,
        theme: theme,
        selectionmode: 'singlerow',
        sortable: true,
        filterable: true,
        pageable: true,
        columnsresize: true,
        columns: dadosColunas
    });
    // apply localization.
    
    $("#"+nomeGrid).jqxGrid('localizestrings', localizationobj);
    $('#'+nomeGrid).jqxGrid({ pagesizeoptions: ['40', '50', '60']});
}