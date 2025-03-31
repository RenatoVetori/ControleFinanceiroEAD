function ValidarMeusDados() {
    var nome = document.getElementById("nome").value;
    var email = $("#nome").val();
    alert(nome);

    if (nome.trim() == '') {
        alert("Preencher o campo NOME!");
        $("#nome").focus();
        return false;
    }
    if(email.trim()==''){
        alert("Preencher o campo EMAIL!");
        return false;
    }
    
}
function ValidarCategoria(){

    if($("#nomecategoria").val().trim() == '' ){
        alert("Preencher o campo NOME DA CATEGORIA!");
        $("#nomecategoria").focus();
        return false;
    }
}
   
function ValidarEmpresa(){
        if($("#nomeempresa").val().trim() == '') {
            alert("Preencher o campo nome da empresa!");
            $("#nomeempresa").focus();
            return false;
        }
}

function ValidarConta(){
    if($("#banco").val().trim() == ''){
        alert("Preencher o nome do BANCO");
        $("#banco").focus();
        return false;
    } 
    if($("#agencia").val().trim()==''){
        alert('Preencher o campo AGENCIA');
        $("#agencia").focus();
        return false;
    }
    if($("#numero").val().trim()==''){
        alert('Preencher o campo NUMERO');
        $("#numero").focus();
        return false;
    }
    if($("#saldo").val().trim()==''){
        alert('Preencher o campo SALDO');
        $("#saldo").focus();
        return false;
    }

}
function ValidarMovimento(){
    if($("#tipo").val() == ''){
        alert('Selecione o TIPO');
        $("#tipo").focus();
        return false;
    }
    if($("#data").val()==''){
        alert('Preencher o campo DATA');
        $("#data").focus();
        return false;
    }
    if($("#valor").val()==''){
        alert('Preencher o campo VALOR');
        $("#valor").focus();
        return false;
    }
    if($("#categoria").val()==''){
        alert('Selecionar campo CATEGORIA');
        $("#categoria").focus();
        return false;
    }
    if($("#empresa").val()== ''){
        alert('Selecionar campo EMPRESA');
        $("#empresa").focus();
        return false;
    }
    if($("#conta").val()== ''){
        alert('Selecionar campo CONTA');
        $("#conta").focus();
        return false;
    }
}
function ValidarConsultaPeriodo(){
    if($("#datainicial").val().trim()==''){
        alert('Selecionar DATA INICIAL');
        $("#datainicial").focus();
        return false;
    }
    if($("#datafinal").val().trim()==''){
        alert('Selecionar DATA FINAL');
        $("#datafinal").focus();
        return false;
    }
}
function ValidarLogin(){
    if($("#email").val().trim()==''){
        alert('Preencher campo EMAIL');
        $("#email").focus();
        return false;
    }
    if($("#senha").val().trim()==''){
        alert('Preencher campo SENHA');
        $("#senha").focus();
        return false;
    }
}
function ValidarCadastro(){
    if($("#nome").val().trim()==''){
        alert('Preencher o campo NOME');
        $("#nome").focus();
        return false;
    }
    if($("#email").val().trim()==''){
        alert('Preencher o campo EMAIL');
        $("#email").focus();
        return false;
    }
    if($("#senha").val().trim()==''){
        alert('Preencher o campo SENHA');
        $("#senha").focus();
        return false;
    }
    if($("#senha").val().trim().length < 6 ){
        alert('A senha devera ter no MINIMO 6 caracteres');
        $("#senha").focus();
        return false;
    }
    if($("#senha").val().trim() != $("#confsenha").val().trim()){
        alert('o campo SENHA e REPETIR SENHA deverao ser iguais');
        $("#confsenha").focus();
        return false;
    }
}